@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Coupon</h2>

        <div class="form-group">
            <label>Coupon Code</label>
            <p class="form-value">{{ $coupon->code }}</p>
        </div>

        <div class="form-group">
            <label>Discount</label>
            <p class="form-value">{{ $coupon->discount }}%</p>
        </div>

        <div class="form-group">
            <label>Usage Limit</label>
            <p class="form-value">{{ $coupon->usage_limit }}</p>
        </div>

        <div class="form-group">
            <label>Used</label>
            <p class="form-value">{{ $coupon->used }}</p>
        </div>

        <div class="form-group">
            <label>Limit (Days)</label>
            <p class="form-value">{{ $coupon->limit_days }}</p>
        </div>

        <div class="form-group">
            <label>Used</label>
            <p class="form-value">{{ $coupon->used }}</p>
        </div>

        <div class="form-group">
            <label>Expiry Date</label>
            <p class="form-value">{{ $coupon->expiry_date }}</p>
        </div>

        <div class="form-group">
            <label>Status</label>
            <p class="form-value">{{ ucfirst($coupon->status) }}</p>
        </div>

        <a href="{{ route('admin.coupons.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
