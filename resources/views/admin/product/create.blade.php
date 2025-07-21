@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>Create New Product</h2>
    <form action="{{ route('admin.product.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Actual Price (₹)</label>
            <input type="number" name="actual_price" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label>Current Price (₹)</label>
            <input type="number" name="price" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock" min="0" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Create</button>
        <a href="{{ route('admin.product.index') }}" class="btn-back">Back</a>
    </form>
</div>
@endsection
