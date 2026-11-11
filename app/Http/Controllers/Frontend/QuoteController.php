<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Retrieve all items currently in the Quote Cart.
     */
    public function items(Request $request)
    {
        $cart = session()->get('quote_cart', []);

        $totalItems = array_sum(array_column($cart, 'quantity'));
        $subtotal = array_sum(array_map(function ($item) {
            return (float)($item['price'] ?? 0) * (int)($item['quantity'] ?? 1);
        }, $cart));
        $totalCbm = round(array_sum(array_map(function ($item) {
            return (float)($item['cbm'] ?? 0.45) * (int)($item['quantity'] ?? 1);
        }, $cart)), 2);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'items' => array_values($cart),
            'total_items' => $totalItems,
            'cart_count' => $totalItems,
            'total_cbm' => $totalCbm,
            'formatted_total_cbm' => number_format($totalCbm, 2) . ' CBM',
            'subtotal' => $subtotal,
            'formatted_subtotal' => number_format($totalCbm, 2) . ' CBM',
        ]);
    }

    /**
     * Add a product to the Quote Cart via AJAX.
     */
    public function add(Request $request)
    {
        $id = $request->input('id') ?: $request->input('product_id');
        $qty = max(1, (int)$request->input('quantity', 1));
        $notes = $request->input('notes');
        $finish = $request->input('finish');
        $wood = $request->input('wood');

        $product = null;
        if ($id) {
            $product = Product::with(['category', 'wood', 'finish'])->find($id);
            if (!$product && is_string($id)) {
                $product = Product::with(['category', 'wood', 'finish'])->where('slug', $id)->first();
            }
        }

        $cart = session()->get('quote_cart', []);

        if ($product) {
            $prodId = (int)$product->id;
            $itemFinish = $finish ?: ($product->finish?->name ?? 'Natural Finish');
            $itemWood = $wood ?: ($product->wood?->name ?? ($product->material ?? 'Solid Hardwood'));
            $cbmVal = $product->cbm ?: '0.45';

            if (isset($cart[$prodId])) {
                $cart[$prodId]['quantity'] += $qty;
                if ($notes) {
                    $cart[$prodId]['notes'] = $notes;
                }
                if ($finish) {
                    $cart[$prodId]['finish'] = $itemFinish;
                }
                if ($wood) {
                    $cart[$prodId]['wood'] = $itemWood;
                }
            } else {
                $cart[$prodId] = [
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'price' => (float)$product->price,
                    'cbm' => $cbmVal,
                    'formatted_cbm' => $cbmVal . ' CBM',
                    'image' => $product->image_url,
                    'category' => $product->category ? $product->category->name : 'Furniture',
                    'code' => $product->code,
                    'quantity' => $qty,
                    'notes' => $notes,
                    'finish' => $itemFinish,
                    'wood' => $itemWood,
                ];
            }
            $addedItem = $cart[$prodId];
        } else {
            // Fallback for custom or client-passed item
            $customId = $id ? (string)$id : ('item_' . time());
            $title = $request->input('title', 'Handcrafted Furniture Piece');
            $price = (float)$request->input('price', 0);
            $cbmVal = $request->input('cbm', '0.45');
            $image = $request->input('image', asset('assets/img/fur_chair_boucle.png'));

            if (isset($cart[$customId])) {
                $cart[$customId]['quantity'] += $qty;
            } else {
                $cart[$customId] = [
                    'id' => $customId,
                    'title' => $title,
                    'slug' => $request->input('slug', ''),
                    'price' => $price,
                    'cbm' => $cbmVal,
                    'formatted_cbm' => $cbmVal . ' CBM',
                    'image' => $image,
                    'category' => $request->input('category', 'Furniture'),
                    'quantity' => $qty,
                    'notes' => $notes,
                    'finish' => $finish ?: 'Natural Finish',
                    'wood' => $wood ?: 'Solid Wood',
                ];
            }
            $addedItem = $cart[$customId];
        }

        session()->put('quote_cart', $cart);

        $totalItems = array_sum(array_column($cart, 'quantity'));
        $subtotal = array_sum(array_map(function ($item) {
            return (float)($item['price'] ?? 0) * (int)($item['quantity'] ?? 1);
        }, $cart));
        $totalCbm = round(array_sum(array_map(function ($item) {
            return (float)($item['cbm'] ?? 0.45) * (int)($item['quantity'] ?? 1);
        }, $cart)), 2);

        return response()->json([
            'success' => true,
            'message' => '“' . $addedItem['title'] . '” added to your Quote!',
            'item' => $addedItem,
            'cart' => array_values($cart),
            'items' => array_values($cart),
            'total_items' => $totalItems,
            'cart_count' => $totalItems,
            'total_cbm' => $totalCbm,
            'formatted_total_cbm' => number_format($totalCbm, 2) . ' CBM',
            'subtotal' => $subtotal,
            'formatted_subtotal' => number_format($totalCbm, 2) . ' CBM',
        ]);
    }

    /**
     * Update an item quantity in the Quote Cart.
     */
    public function update(Request $request)
    {
        $id = $request->input('id') ?: $request->input('product_id');
        $qty = (int)$request->input('quantity', 1);

        $cart = session()->get('quote_cart', []);

        if (isset($cart[$id])) {
            if ($qty <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $qty;
            }
            session()->put('quote_cart', $cart);
        }

        $totalItems = array_sum(array_column($cart, 'quantity'));
        $subtotal = array_sum(array_map(function ($item) {
            return (float)($item['price'] ?? 0) * (int)($item['quantity'] ?? 1);
        }, $cart));
        $totalCbm = round(array_sum(array_map(function ($item) {
            return (float)($item['cbm'] ?? 0.45) * (int)($item['quantity'] ?? 1);
        }, $cart)), 2);

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'items' => array_values($cart),
            'total_items' => $totalItems,
            'cart_count' => $totalItems,
            'total_cbm' => $totalCbm,
            'formatted_total_cbm' => number_format($totalCbm, 2) . ' CBM',
            'subtotal' => $subtotal,
            'formatted_subtotal' => number_format($totalCbm, 2) . ' CBM',
        ]);
    }

    /**
     * Remove an item from the Quote Cart.
     */
    public function remove(Request $request)
    {
        $id = $request->input('id') ?: $request->input('product_id');
        $cart = session()->get('quote_cart', []);

        if (isset($cart[$id])) {
            $removedTitle = $cart[$id]['title'] ?? 'Item';
            unset($cart[$id]);
            session()->put('quote_cart', $cart);
        } else {
            $removedTitle = 'Item';
        }

        $totalItems = array_sum(array_column($cart, 'quantity'));
        $subtotal = array_sum(array_map(function ($item) {
            return (float)($item['price'] ?? 0) * (int)($item['quantity'] ?? 1);
        }, $cart));
        $totalCbm = round(array_sum(array_map(function ($item) {
            return (float)($item['cbm'] ?? 0.45) * (int)($item['quantity'] ?? 1);
        }, $cart)), 2);

        return response()->json([
            'success' => true,
            'message' => $removedTitle . ' removed from your Quote.',
            'cart' => array_values($cart),
            'items' => array_values($cart),
            'total_items' => $totalItems,
            'cart_count' => $totalItems,
            'total_cbm' => $totalCbm,
            'formatted_total_cbm' => number_format($totalCbm, 2) . ' CBM',
            'subtotal' => $subtotal,
            'formatted_subtotal' => number_format($totalCbm, 2) . ' CBM',
        ]);
    }

    /**
     * Clear all items from the Quote Cart.
     */
    public function clear(Request $request)
    {
        session()->forget('quote_cart');

        return response()->json([
            'success' => true,
            'message' => 'Quote selection cleared.',
            'cart' => [],
            'items' => [],
            'total_items' => 0,
            'cart_count' => 0,
            'total_cbm' => 0,
            'formatted_total_cbm' => '0.00 CBM',
            'subtotal' => 0,
            'formatted_subtotal' => '0.00 CBM',
        ]);
    }
}
