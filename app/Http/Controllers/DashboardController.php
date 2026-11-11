<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::query()->latest()->paginate(10);

        return view('admin.pages.dashboard', compact('orders'));
    }
}

