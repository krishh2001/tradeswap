@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>Create New Product</h2>
        <form action="#" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" placeholder="Enter product name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter product description" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" placeholder="Enter price" step="0.01" min="0"
                    required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" placeholder="Enter category" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Create Product</button>
            <a href="{{ route('admin.product.index') }}" class="btn-back">Back</a>
        </form>
    </div>
@endsection
