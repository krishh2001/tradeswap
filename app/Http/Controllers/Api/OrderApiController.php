<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderApiController extends Controller
{
    // List all orders (for user)
    public function index()
    {
        $orders = Order::with('user')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    // Get a single order
    public function show($id)
    {
        $order = Order::with('user')->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }

    // Store a new order
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'nullable|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully',
            'data' => $order
        ]);
    }
}
