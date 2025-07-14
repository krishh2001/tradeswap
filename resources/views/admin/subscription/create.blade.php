@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>Create New Subscription Plan</h2>
    <form action="{{ route('admin.subscription.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="plan_name">Plan Name</label>
            <input type="text" name="plan_name" id="plan_name" placeholder="Enter plan name" required>
        </div>

        <div class="form-group">
            <label for="price">Plan Price (₹)</label>
            <input type="number" name="price" id="price" placeholder="Enter plan price" step="0.01" min="0" required>
        </div>

        <button type="submit" class="btn-submit">Create Plan</button>
        <a href="{{ route('admin.subscription.index') }}" class="btn-back">Back</a>
    </form>
</div>
@endsection
