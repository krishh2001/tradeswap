<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderApiController extends Controller
{
    // Admin sees all orders
    public function index()
    {
        $orders = Order::with('user', 'product')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Orders fetched successfully',
            'data' => $orders,
        ], 200);
    }


    public function store(Request $request)
    {
        // Get the authenticated user from token
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Token missing or invalid.'
            ], 401);
        }

        $request->validate([
            'order_id'    => 'required|unique:orders',
            'product_id'  => 'required|exists:products,id',
            'total_price' => 'required|numeric',
                'address'     => 'nullable|string|max:255',

        ]);

        $order = Order::create([
            'order_id'    => $request->order_id,
            'user_id'     => $user->id, // Taken from token
            'product_id'  => $request->product_id,
            'total_price' => $request->total_price,
             'address'     => $request->address,
            // 'status'      => 'pending',
        ]);

        return response()->json([
            'message' => 'Order placed successfully',
            'order'   => $order
        ], 201);
    }
}
