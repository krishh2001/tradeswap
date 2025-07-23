<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('admin.product.create');
    }

   // Store method
public function store(Request $request)
{
    $data = $request->validate([
        'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'required|string|max:255',
        'actual_price' => 'required|numeric|min:0',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
    ]);

    if ($request->hasFile('product_img')) {
        $data['product_img'] = $request->file('product_img')->store('products', 'public');
    }

    Product::create($data);

    return redirect()->route('admin.product.index')->with('success', 'Product created successfully!');
}

// Update method
public function update(Request $request, Product $product)
{
    $data = $request->validate([
        'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'required|string|max:255',
        'actual_price' => 'required|numeric|min:0',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
    ]);

    if ($request->hasFile('product_img')) {
        $data['product_img'] = $request->file('product_img')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
}



     // Show a single product
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    // Show edit form
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    public function toggleStatus(Product $product)
    {
        // Toggle status
        $product->status = $product->status === 'active' ? 'inactive' : 'active';

        // Only save the status field
        $product->save();

        return redirect()->back()->with('success', 'Product status updated.');
    }



    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully!');
    }
}
