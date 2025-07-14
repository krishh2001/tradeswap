@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>Create New Coupon</h2>
        <form action="{{ route('admin.coupons.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="code">Coupon Code</label>
                <input type="text" name="code" id="code" placeholder="Enter coupon code" required>
            </div>

            <div class="form-group">
                <label for="discount">Discount (%)</label>
                <input type="number" name="discount" id="discount" required min="1" max="100">
            </div>

            <div class="form-group">
                <label for="usage_limit">Usage Limit</label>
                <input type="number" name="usage_limit" id="usage_limit" required min="1">
            </div>

            <div class="form-group">
                <label for="limit_days">Limit (Days)</label>
                <input type="number" name="limit_days" id="limit_days" required min="1">
            </div>
            <div class="form-group">
                <label for="used">Used</label>
                <input type="number" name="used" id="used" required min="1">
            </div>

            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="active">Active</option>
                    <option value="expired">Expired</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Create Coupon</button>
            <a href="{{ route('admin.coupons.index') }}" class="btn-back">Back</a>
        </form>
    </div>
@endsection
