@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>Edit Subscription Plan</h2>

    <form action="{{ route('admin.subscription.update', $subscription->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="plan_name">Plan Name</label>
            <input type="text" name="plan_name" id="plan_name" value="{{ old('plan_name', $subscription->plan_name) }}" required>
        </div>

        <div class="form-group">
            <label for="actual_price">Actual Price (₹)</label>
            <input type="number" name="actual_price" id="actual_price" value="{{ old('actual_price', $subscription->actual_price) }}" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="price">Current Price (₹)</label>
            <input type="number" name="price" id="price" value="{{ old('price', $subscription->price) }}" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="validity_days">Validity (in Days)</label>
            <input type="number" name="validity_days" id="validity_days" value="{{ old('validity_days', $subscription->validity_days) }}" min="1" required>
        </div>

        <div class="form-group">
            <label for="reward_limit">Reward Generation Limit (₹)</label>
            <input type="number" name="reward_limit" id="reward_limit" value="{{ old('reward_limit', $subscription->reward_limit) }}" min="1" required>
        </div>
        <div class="form-group">
            <label for="description">Plan Description</label>
            <textarea name="description" id="description" rows="4" placeholder="Enter plan description (optional)">{{ old('description', $subscription->description) }}</textarea>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Update Plan</button>
            <a href="{{ route('admin.subscription.index') }}" class="btn-back">Back</a>
        </div>
    </form>
</div>
@endsection
