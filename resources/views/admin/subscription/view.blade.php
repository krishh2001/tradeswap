@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>View Subscription Plan</h2>

    <div class="form-group">
        <label>Plan Name</label>
        <p class="form-value">{{ $subscription->plan_name }}</p>
    </div>

    <div class="form-group">
        <label>Price</label>
        <p class="form-value">₹{{ number_format($subscription->price, 2) }}</p>
    </div>

    <div class="form-group">
        <label>Validity (in Days)</label>
        <p class="form-value">{{ $subscription->validity_days }} days</p>
    </div>

    <div class="form-group">
        <label>Reward Generation Limit</label>
        <p class="form-value">₹{{ $subscription->reward_limit }}</p>
    </div>

    <br>
    <a href="{{ route('admin.subscription.index') }}" class="btn-back">Back to List</a>
</div>
@endsection
