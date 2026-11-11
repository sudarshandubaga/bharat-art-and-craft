<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'nullable|string|max:50',
            'message' => 'nullable|string',
        ]);

        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone ?? '',
            'message' => $request->message ?? 'Contact form enquiry',
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been received. Our concierge will be in touch shortly.',
                'order_id' => $order->id,
            ]);
        }

        return redirect()->back()->with('success', 'Thank you! Your message has been received. Our concierge will be in touch shortly.');
    }
}

