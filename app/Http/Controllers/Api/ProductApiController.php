<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApiController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::where('status', 'active')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    // Show single product
    public function show($id)
    {
        $product = Product::where('status', 'active')->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
}
