<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->latest()->paginate(10);

        return view('admin.pages.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.pages.order.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order.index')->with('success', 'Order inquiry deleted.');
    }
}

