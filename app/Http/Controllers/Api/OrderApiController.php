<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderApiController extends Controller
{
    // ✅ Admin sees all orders
    public function index()
    {
        $orders = Order::with('product')->latest()->get();

        $products = $orders->map(function ($order) {
            return [
                'id'           => $order->product->id,
                'order_id'     => $order->order_id,
                'product_id'   => $order->product_id,
                'name'         => $order->product->name,
                'actual_price' => $order->product->actual_price,
                'price'        => $order->product->price,
                'stock'        => $order->product->stock,
                'description'  => $order->product->description,
                'product_img'  => $order->product->product_img,
                // 'product_status' => $order->product->status,    
                'order_status'   => $order->status,              // ✅ added — pending/complete
                'created_at'   => $order->created_at,
                'updated_at'   => $order->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Order details fetched successfully',
            'data'    => $products,
        ]);
    }

    // ✅ Store Order
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Token missing or invalid.'
            ], 401);
        }

        // Validation
        $request->validate([
            'product_id'  => 'required|exists:products,id',
            'total_price' => 'required|numeric',
            'address'     => 'nullable|string|max:255',
        ]);

        // ✅ Create order with default status
        $order = Order::create([
            'user_id'     => $user->id,
            'product_id'  => $request->product_id,
            'total_price' => $request->total_price,
            'address'     => $request->address,
            'status'      => 'pending', // ✅ default status
        ]);

        // Generate unique order_id
        $order->order_id = 'ORD-' . str_pad($order->id, 5, '0', STR_PAD_LEFT);
        $order->save();

        return response()->json([
            'message' => 'Order placed successfully',
            'order'   => $order
        ], 201);
    }
}
