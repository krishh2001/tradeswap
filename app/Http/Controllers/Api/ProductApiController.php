<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApiController extends Controller
{
    // GET /api/products
    public function index()
    {
        $products = Product::where('status', 'active')->get()->map(function ($product) {
            $product->tsp = round($product->price - ($product->price * 0.30), 2);
            return $product;
        });

        return response()->json([
            'status' => true,
            'products' => $products
        ], 200);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->tsp = round($product->price - ($product->price * 0.30), 2);

        return response()->json([
            'status' => true,
            'product' => $product
        ], 200);
    }
}
