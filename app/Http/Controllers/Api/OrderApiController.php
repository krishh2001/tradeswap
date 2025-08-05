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
    $orders = Order::with('product')->latest()->get();

    $products = $orders->map(function ($order) {
        return [
            'id' => $order->product->id,
            'order_id' => $order->order_id,
            'product_id' => $order->product_id,
            'name' => $order->product->name,
            'actual_price' => $order->product->actual_price,
            'price' => $order->product->price,
            'stock' => $order->product->stock,
            'description' => $order->product->description,
            'product_img' => $order->product->product_img,
            'status' => $order->product->status,
            'created_at' => $order->product->created_at,
            'updated_at' => $order->product->updated_at,
        ];
    });

    return response()->json([
        'success' => true,
        'message' => 'Product details fetched successfully',
        'data' => $products,
    ]);
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
            // 'order_id'    => 'required|unique:orders',
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
