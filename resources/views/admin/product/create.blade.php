@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>Create New Product</h2>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Product Image --}}
        <div class="form-group">
            <label for="product_img">Product Image</label>
            <input type="file" name="product_img" id="product_img" accept="image/*" required>
        </div>

        {{-- Product Name --}}
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" required>
        </div>

        {{-- Actual Price --}}
        <div class="form-group">
            <label for="actual_price">Actual Price (₹)</label>
            <input type="number" name="actual_price" id="actual_price" step="0.01" min="0" required>
        </div>

        {{-- Current Price --}}
        <div class="form-group">
            <label for="price">Current Price (₹)</label>
            <input type="number" name="price" id="price" step="0.01" min="0" required>
        </div>

        {{-- Stock --}}
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" min="0" required>
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        {{-- Product Description --}}
        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea name="description" id="description" rows="4" required></textarea>
        </div>

        {{-- Submit Buttons --}}
        <div class="form-actions">
            <button type="submit" class="btn-submit">Create</button>
            <a href="{{ route('admin.product.index') }}" class="btn-back">Back</a>
        </div>
    </form>
</div>
@endsection
