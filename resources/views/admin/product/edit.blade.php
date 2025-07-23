@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>Edit Product</h2>

    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Product Image</label>
            <input type="file" name="product_img" accept="image/*">
            @if ($product->product_img)
                <div style="margin-top: 10px;">
                    <img src="{{ asset('storage/' . $product->product_img) }}" alt="Product Image" width="100">
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group">
            <label>Actual Price (₹)</label>
            <input type="number" name="actual_price" value="{{ old('actual_price', $product->actual_price) }}" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label>Current Price (₹)</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required>
        </div>

        <div class="form-group">
            <label>Product Description</label>
            <textarea name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Update</button>
        <a href="{{ route('admin.product.index') }}" class="btn-back">Back</a>
    </form>
</div>
@endsection
