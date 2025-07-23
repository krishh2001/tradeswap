@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>View Product</h2>

    <div class="form-group">
        <label>Product Image</label>
        @if($product->product_img)
            <img style="height: 100px; width: 100px;" src="{{ asset('public/storage/' . $product->product_img) }}" alt="{{ $product->name }}" class="product-image">
        @else
            <span class="no-image">No Image</span>
        @endif
    </div>

    <div class="form-group">
        <label>Product Name</label>
        <p class="form-value">{{ $product->name }}</p>
    </div>

    <div class="form-group">
        <label>Actual Price (₹)</label>
        <p class="form-value">₹{{ number_format($product->actual_price, 2) }}</p>
    </div>

    <div class="form-group">
        <label>Current Price (₹)</label>
        <p class="form-value">₹{{ number_format($product->price, 2) }}</p>
    </div>

    <div class="form-group">
        <label>Stock</label>
        <p class="form-value">{{ $product->stock }}</p>
    </div>

    <div class="form-group">
        <label>Product Description</label>
        <p class="form-value">{{ $product->description }}</p>
    </div>

    <div class="form-group">
        <label>Status</label>
        <p class="form-value">{{ ucfirst($product->status) }}</p>
    </div>

    <a href="{{ route('admin.product.index') }}" class="btn-back">Back</a>
</div>
@endsection
