@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>View Subscription Plan</h2>

    <div class="form-group">
        <label>Plan Name</label>
        <p class="form-value">{{ $subscription->plan_name }}</p>
    </div>

    <div class="form-group">
        <label>Actual Price</label>
        <p class="form-value">₹{{ number_format($subscription->actual_price, 2) }}</p>
    </div>

    <div class="form-group">
        <label>Current Price</label>
        <p class="form-value">₹{{ number_format($subscription->price, 2) }}</p>
    </div>

    <div class="form-group">
        <label>Validity</label>
        <p class="form-value">{{ $subscription->validity_days }} Days</p>
    </div>

    <div class="form-group">
        <label>Reward Generation Limit</label>
        <p class="form-value">₹{{ number_format($subscription->reward_limit) }}</p>
    </div>

    <div class="form-actions">
        <a href="{{ route('admin.subscription.index') }}" class="btn-back">Back to List</a>
    </div>
</div>
@endsection
