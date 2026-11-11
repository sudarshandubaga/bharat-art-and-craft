<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('quote_cart', []);
        return view('checkout', compact('cart'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:191',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:30',
            'country' => 'required|string|max:100',
        ]);

        $cart = session()->get('quote_cart', []);

        $fullMessage = "=== CATALOG FURNITURE ENQUIRY ===\n\n";
        $fullMessage .= "Name: " . $request->input('name') . "\n";
        $fullMessage .= "Email: " . $request->input('email') . "\n";
        if ($request->filled('phone')) {
            $fullMessage .= "Phone: " . $request->input('phone') . "\n";
        }
        if ($request->filled('company')) {
            $fullMessage .= "Company Name: " . $request->input('company') . "\n";
        }
        $fullMessage .= "Address: " . $request->input('address') . "\n";
        $fullMessage .= "City: " . $request->input('city') . "\n";
        $fullMessage .= "State: " . $request->input('state') . "\n";
        $fullMessage .= "Pincode / Zipcode: " . $request->input('pincode') . "\n";
        $fullMessage .= "Country: " . $request->input('country') . "\n\n";

        // Cart items recap
        $cartItemsSummary = $request->input('cart_items_summary');
        if (!empty($cart)) {
            $fullMessage .= "--- PRODUCTS IN QUOTE CART ---\n";
            $totalCbm = 0;
            $itemNum = 1;
            foreach ($cart as $item) {
                $qty = (int)($item['quantity'] ?? 1);
                $cbmUnit = (float)($item['cbm'] ?? 0.45);
                $lineCbm = $cbmUnit * $qty;
                $totalCbm += $lineCbm;

                $fullMessage .= "{$itemNum}. " . ($item['title'] ?? 'Furniture Piece');
                if (!empty($item['code'])) {
                    $fullMessage .= " [Code: {$item['code']}]";
                }
                $fullMessage .= " | Qty: {$qty}";
                if (!empty($item['wood'])) {
                    $fullMessage .= " | Wood: {$item['wood']}";
                }
                if (!empty($item['finish'])) {
                    $fullMessage .= " | Finish: {$item['finish']}";
                }
                $fullMessage .= " | CBM: " . round($lineCbm, 2) . "\n";
                $itemNum++;
            }
            $fullMessage .= "Total Estimated CBM: " . round($totalCbm, 2) . " CBM\n";
        } elseif (!empty($cartItemsSummary)) {
            $fullMessage .= "--- PRODUCTS IN QUOTE CART ---\n" . $cartItemsSummary . "\n";
        }

        $order = Order::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone') ?? '',
            'message' => $fullMessage,
        ]);

        // Clear session cart
        session()->forget('quote_cart');

        $orderRef = 'BAC-ENQ-' . str_pad($order->id, 5, '0', STR_PAD_LEFT);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your order inquiry! Our export manager will get in touch with you with pricing and CBM calculations.',
                'order_id' => $order->id,
                'order_ref' => $orderRef,
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for your order inquiry! Our export manager will get in touch with you with pricing and CBM calculations.');
    }
}
