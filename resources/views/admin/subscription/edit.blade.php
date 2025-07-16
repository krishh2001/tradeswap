@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>Edit Subscription Plan</h2>
    <form action="{{ route('admin.subscription.update', $subscription->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="plan_name">Plan Name</label>
            <input type="text" name="plan_name" id="plan_name" value="{{ $subscription->plan_name }}" required>
        </div>

        <div class="form-group">
            <label for="price">Plan Price (₹)</label>
            <input type="number" name="price" id="price" value="{{ $subscription->price }}" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="validity_days">Validity (in Days)</label>
            <input type="number" name="validity_days" id="validity_days" value="{{ $subscription->validity_days }}" min="1" required>
        </div>

        <div class="form-group">
            <label for="reward_limit">Reward Generation Limit(₹)</label>
            <input type="number" name="reward_limit" id="reward_limit" value="{{ $subscription->reward_limit }}" min="1" required>
        </div>

        <button type="submit" class="btn-submit">Update</button>
        <a href="{{ route('admin.subscription.index') }}" class="btn-back">Back</a>
    </form>
</div>
@endsection
