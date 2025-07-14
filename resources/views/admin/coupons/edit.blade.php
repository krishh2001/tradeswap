@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>Edit Coupon</h2>
        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="code">Coupon Code</label>
                <input type="text" name="code" id="code" value="{{ $coupon->code }}" required>
            </div>

            <div class="form-group">
                <label for="discount">Discount (%)</label>
                <input type="number" name="discount" id="discount" value="{{ $coupon->discount }}" min="1"
                    max="100" required>
            </div>

            <div class="form-group">
                <label for="usage_limit">Usage Limit</label>
                <input type="number" name="usage_limit" id="usage_limit" value="{{ $coupon->usage_limit }}" required>
            </div>

            <div class="form-group">
                <label for="limit_days">Limit (Days)</label>
                <input type="number" name="limit_days" id="limit_days" value="{{ $coupon->limit_days }}" required>
            </div>

            <div class="form-group">
                <label for="used">Used</label>
                <input type="number" name="used" id="used" value="{{ $coupon->used }}" required>
            </div>

            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" value="{{ $coupon->expiry_date }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="active" {{ $coupon->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="expired" {{ $coupon->status == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Update Coupon</button>
            <a href="{{ route('admin.coupons.index') }}" class="btn-back">Back</a>
        </form>
    </div>
@endsection
