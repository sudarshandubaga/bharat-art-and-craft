<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class QuotationController extends Controller
{
    /**
     * Display a listing of quotations with search and filters.
     */
    public function index(Request $request)
    {
        $quotations = Quotation::with(['user', 'items']);

        if (!empty($request->search_by_keyword)) {
            $keyword = trim($request->search_by_keyword);
            $quotations->where(function ($q) use ($keyword) {
                $q->where('quotation_no', 'like', "%{$keyword}%")
                    ->orWhere('customer_name', 'like', "%{$keyword}%")
                    ->orWhere('customer_email', 'like', "%{$keyword}%")
                    ->orWhere('customer_company', 'like', "%{$keyword}%")
                    ->orWhere('title', 'like', "%{$keyword}%");
            });
        }

        if (!empty($request->status)) {
            $quotations->where('status', $request->status);
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $quotations->onlyTrashed();
        }

        $quotations = $quotations->latest()->paginate(10);

        return view('admin.pages.quotation.index', compact('quotations'));
    }

    /**
     * Show form for creating a new quotation.
     */
    public function create(Request $request)
    {
        $quotationNo = Quotation::generateQuotationNo();
        $users = User::orderBy('name')->get();
        $products = Product::with(['wood', 'finish'])->orderBy('title')->get();
        $site = Site::first();

        $selectedOrder = null;
        $prefilledData = [
            'quotation_no' => $quotationNo,
            'title' => 'Commercial Furniture Quotation',
            'date' => date('Y-m-d'),
            'valid_until' => date('Y-m-d', strtotime('+30 days')),
            'company_name' => $site->title ?? 'Bharat Art & Craft',
            'company_address' => $site->address ?? 'Industrial Area, Jodhpur, Rajasthan, India',
            'company_email' => $site->email ?? 'exports@bharatartandcraft.com',
            'company_phone' => $site->phone ?? '+91-9876543210',
            'customer_name' => '',
            'customer_email' => '',
            'customer_phone' => '',
            'customer_company' => '',
            'customer_address' => '',
            'user_id' => null,
            'order_id' => null,
            'items' => [],
        ];

        // If creating from an order row
        if ($request->filled('order_id')) {
            $order = Order::find($request->order_id);
            if ($order) {
                $selectedOrder = $order;
                $prefilledData['order_id'] = $order->id;
                $prefilledData['customer_name'] = $order->name;
                $prefilledData['customer_email'] = $order->email;
                $prefilledData['customer_phone'] = $order->phone;

                // Match existing user by email if exists
                $existingUser = User::where('email', $order->email)->first();
                if ($existingUser) {
                    $prefilledData['user_id'] = $existingUser->id;
                }

                // Parse message to pre-extract address or company if available
                if (preg_match('/Company Name:\s*([^\n\r]+)/i', $order->message, $matches)) {
                    $prefilledData['customer_company'] = trim($matches[1]);
                }
                if (preg_match('/Address:\s*([^\n\r]+)/i', $order->message, $matches)) {
                    $addr = trim($matches[1]);
                    if (preg_match('/City:\s*([^\n\r]+)/i', $order->message, $cMatches)) {
                        $addr .= ', ' . trim($cMatches[1]);
                    }
                    if (preg_match('/Country:\s*([^\n\r]+)/i', $order->message, $coMatches)) {
                        $addr .= ', ' . trim($coMatches[1]);
                    }
                    $prefilledData['customer_address'] = $addr;
                }

                // Attempt to match products mentioned in the order message
                foreach ($products as $prod) {
                    if (
                        (!empty($prod->code) && stripos($order->message, $prod->code) !== false) ||
                        (!empty($prod->title) && stripos($order->message, $prod->title) !== false)
                    ) {
                        $cbmVal = (float)($prod->cbm ?: 0.45);
                        $loadability = $cbmVal > 0 ? (floor(68 / $cbmVal) . " pcs / 40' HC") : "100 pcs";

                        $prefilledData['items'][] = [
                            'product_id' => $prod->id,
                            'product_name' => $prod->title,
                            'product_code' => $prod->code ?? '',
                            'image' => $prod->image_url,
                            'material' => $prod->wood?->name ?? ($prod->material ?? 'Solid Wood'),
                            'dimension' => $prod->dimension ?? 'Standard',
                            'finish' => $prod->finish?->name ?? 'Natural Polish',
                            'moq' => 5,
                            'price_usd' => (float)($prod->price ?? 0),
                            'cbm' => $cbmVal,
                            'loadability' => $loadability,
                            'notes' => '',
                        ];
                    }
                }
            }
        }

        return view('admin.pages.quotation.create', compact('users', 'products', 'site', 'prefilledData', 'selectedOrder'));
    }

    /**
     * Store newly created quotation.
     */
    public function store(Request $request)
    {
        $request->validate([
            'quotation_no' => 'required|string|max:100|unique:quotations,quotation_no',
            'customer_name' => 'required|string|max:191',
            'customer_email' => 'required|email|max:191',
            'customer_phone' => 'nullable|string|max:50',
            'customer_company' => 'nullable|string|max:191',
            'customer_address' => 'nullable|string',
            'date' => 'required|date',
            'valid_until' => 'nullable|date',
            'title' => 'required|string|max:191',
            'company_name' => 'required|string|max:191',
            'items' => 'required|array|min:1',
            'items.*.product_name' => 'required|string|max:191',
        ]);

        $userId = $request->input('user_id');

        // If admin checked "Create new user account"
        if ($request->boolean('create_new_user') || empty($userId)) {
            $email = $request->input('customer_email');
            $existingUser = User::where('email', $email)->first();

            if (!$existingUser && $request->boolean('create_new_user')) {
                $nameParts = explode(' ', trim($request->input('customer_name')), 2);
                $newUser = User::create([
                    'title' => 'Mr.',
                    'first_name' => $nameParts[0],
                    'last_name' => $nameParts[1] ?? '',
                    'name' => $request->input('customer_name'),
                    'email' => $email,
                    'phone' => $request->input('customer_phone'),
                    'password' => Hash::make(Str::random(12)),
                ]);
                $userId = $newUser->id;
            } elseif ($existingUser) {
                $userId = $existingUser->id;
            }
        }

        $quotation = Quotation::create([
            'quotation_no' => $request->input('quotation_no'),
            'user_id' => $userId,
            'order_id' => $request->input('order_id'),
            'customer_name' => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'customer_phone' => $request->input('customer_phone'),
            'customer_company' => $request->input('customer_company'),
            'customer_address' => $request->input('customer_address'),
            'date' => $request->input('date'),
            'valid_until' => $request->input('valid_until'),
            'title' => $request->input('title'),
            'company_name' => $request->input('company_name'),
            'company_address' => $request->input('company_address'),
            'company_email' => $request->input('company_email'),
            'company_phone' => $request->input('company_phone'),
            'status' => $request->input('status', 'draft'),
            'currency' => $request->input('currency', 'USD'),
            'notes' => $request->input('notes'),
            'terms' => $request->input('terms'),
        ]);

        $totalCbm = 0;
        $totalAmount = 0;
        $items = $request->input('items', []);

        foreach ($items as $idx => $itemData) {
            $moq = max(1, (int)($itemData['moq'] ?? 1));
            $price = (float)($itemData['price_usd'] ?? 0);
            $cbm = (float)($itemData['cbm'] ?? 0);
            $prodId = !empty($itemData['product_id']) ? (int)$itemData['product_id'] : null;

            // Image handling
            $itemImage = $itemData['image'] ?? null;
            if (empty($itemImage) && $prodId) {
                $prod = Product::find($prodId);
                $itemImage = $prod?->image;
            }

            $totalCbm += ($cbm * $moq);
            $totalAmount += ($price * $moq);

            QuotationItem::create([
                'quotation_id' => $quotation->id,
                'product_id' => $prodId,
                'product_name' => $itemData['product_name'],
                'product_code' => $itemData['product_code'] ?? null,
                'image' => $itemImage,
                'material' => $itemData['material'] ?? null,
                'dimension' => $itemData['dimension'] ?? null,
                'finish' => $itemData['finish'] ?? null,
                'moq' => $moq,
                'price_usd' => $price,
                'cbm' => $cbm,
                'loadability' => $itemData['loadability'] ?? null,
                'notes' => $itemData['notes'] ?? null,
                'sort_order' => $idx,
            ]);
        }

        $quotation->update([
            'total_cbm' => $totalCbm,
            'total_amount' => $totalAmount,
        ]);

        return redirect()->route('admin.quotation.show', $quotation->id)
            ->with('success', "Quotation {$quotation->quotation_no} created successfully.");
    }

    /**
     * Display the specified quotation in admin panel.
     */
    public function show(Quotation $quotation)
    {
        $quotation->load(['user', 'order', 'items.product']);
        return view('admin.pages.quotation.show', compact('quotation'));
    }

    /**
     * Show form for editing an existing quotation.
     */
    public function edit(Quotation $quotation)
    {
        $quotation->load(['user', 'order', 'items.product']);
        $users = User::orderBy('name')->get();
        $products = Product::with(['wood', 'finish'])->orderBy('title')->get();
        $site = Site::first();

        return view('admin.pages.quotation.edit', compact('quotation', 'users', 'products', 'site'));
    }

    /**
     * Update existing quotation.
     */
    public function update(Request $request, Quotation $quotation)
    {
        $request->validate([
            'quotation_no' => 'required|string|max:100|unique:quotations,quotation_no,' . $quotation->id,
            'customer_name' => 'required|string|max:191',
            'customer_email' => 'required|email|max:191',
            'customer_phone' => 'nullable|string|max:50',
            'customer_company' => 'nullable|string|max:191',
            'customer_address' => 'nullable|string',
            'date' => 'required|date',
            'valid_until' => 'nullable|date',
            'title' => 'required|string|max:191',
            'company_name' => 'required|string|max:191',
            'items' => 'required|array|min:1',
            'items.*.product_name' => 'required|string|max:191',
        ]);

        $userId = $request->input('user_id');

        $quotation->update([
            'quotation_no' => $request->input('quotation_no'),
            'user_id' => $userId,
            'customer_name' => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'customer_phone' => $request->input('customer_phone'),
            'customer_company' => $request->input('customer_company'),
            'customer_address' => $request->input('customer_address'),
            'date' => $request->input('date'),
            'valid_until' => $request->input('valid_until'),
            'title' => $request->input('title'),
            'company_name' => $request->input('company_name'),
            'company_address' => $request->input('company_address'),
            'company_email' => $request->input('company_email'),
            'company_phone' => $request->input('company_phone'),
            'status' => $request->input('status', 'draft'),
            'currency' => $request->input('currency', 'USD'),
            'notes' => $request->input('notes'),
            'terms' => $request->input('terms'),
        ]);

        // Sync items
        $quotation->items()->delete();

        $totalCbm = 0;
        $totalAmount = 0;
        $items = $request->input('items', []);

        foreach ($items as $idx => $itemData) {
            $moq = max(1, (int)($itemData['moq'] ?? 1));
            $price = (float)($itemData['price_usd'] ?? 0);
            $cbm = (float)($itemData['cbm'] ?? 0);
            $prodId = !empty($itemData['product_id']) ? (int)$itemData['product_id'] : null;

            $itemImage = $itemData['image'] ?? null;
            if (empty($itemImage) && $prodId) {
                $prod = Product::find($prodId);
                $itemImage = $prod?->image;
            }

            $totalCbm += ($cbm * $moq);
            $totalAmount += ($price * $moq);

            QuotationItem::create([
                'quotation_id' => $quotation->id,
                'product_id' => $prodId,
                'product_name' => $itemData['product_name'],
                'product_code' => $itemData['product_code'] ?? null,
                'image' => $itemImage,
                'material' => $itemData['material'] ?? null,
                'dimension' => $itemData['dimension'] ?? null,
                'finish' => $itemData['finish'] ?? null,
                'moq' => $moq,
                'price_usd' => $price,
                'cbm' => $cbm,
                'loadability' => $itemData['loadability'] ?? null,
                'notes' => $itemData['notes'] ?? null,
                'sort_order' => $idx,
            ]);
        }

        $quotation->update([
            'total_cbm' => $totalCbm,
            'total_amount' => $totalAmount,
        ]);

        return redirect()->route('admin.quotation.show', $quotation->id)
            ->with('success', "Quotation {$quotation->quotation_no} updated successfully.");
    }

    /**
     * Delete or restore a quotation.
     */
    public function destroy(Request $request, $id)
    {
        $quotation = Quotation::withTrashed()->findOrFail($id);

        if ($request->action === 'restore') {
            $quotation->restore();
            return redirect()->route('admin.quotation.index')->with('success', 'Quotation restored.');
        } elseif ($request->action === 'permanent-delete') {
            $quotation->forceDelete();
            return redirect()->route('admin.quotation.index')->with('success', 'Quotation permanently deleted.');
        } else {
            $quotation->delete();
            return redirect()->back()->with('success', 'Quotation moved to trash.');
        }
    }

    /**
     * Bulk delete / restore operations.
     */
    public function multiDelete(Request $request)
    {
        if (!empty($request->check)) {
            foreach ($request->check as $id) {
                $quotation = Quotation::withTrashed()->find($id);
                if ($quotation) {
                    if ($request->action === 'permanent-delete') {
                        $quotation->forceDelete();
                    } elseif ($request->action === 'restore') {
                        $quotation->restore();
                    } else {
                        $quotation->delete();
                    }
                }
            }
            return redirect()->back()->with('success', 'Selected quotations updated.');
        }

        return redirect()->back()->with('error', 'No quotations selected.');
    }

    /**
     * Render the Quotation Print View.
     * Page 1: Title & Company
     * Multiple Product Pages (1 page for 1 product):
     *   Left Side: Main Image
     *   Right Side: Product Name, Details in Table
     */
    public function print(Quotation $quotation)
    {
        $quotation->load(['user', 'order', 'items.product']);
        $site = Site::first();

        return view('admin.pages.quotation.print', compact('quotation', 'site'));
    }
}
