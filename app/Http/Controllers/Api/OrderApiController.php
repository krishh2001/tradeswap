<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    // User places an order
    public function store(Request $request)
    {
        $request->validate([
            'order_id'    => 'required|unique:orders',
            'user_id'     => 'required|exists:users,id',
            'product_id'  => 'required|exists:products,id',
            'total_price' => 'required|numeric',
        ]);

        $order = Order::create([
            'order_id'    => $request->order_id,
            'user_id'     => $request->user_id,
            'product_id'  => $request->product_id,
            'total_price' => $request->total_price,
            'status'      => 'pending',
        ]);

        return response()->json([
            'message' => 'Order placed successfully',
            'order'   => $order
        ], 201);
    }
}
