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

            {{-- <div class="form-group">
                <label for="actual_price">Actual Price (₹)</label>
                <input type="number" name="actual_price" id="actual_price" placeholder="e.g. 999" step="0.01"
                    min="0" required>
            </div> --}}

            <div class="form-group">
                <label for="price"> Price (₹)</label>
                <input type="number" name="price" id="price" placeholder="e.g. 499" step="0.01" min="0"
                    required>
            </div>

            <div class="form-group">
                <label for="validity_days">Validity (in Days)</label>
                <input type="number" name="validity_days" id="validity_days" placeholder="e.g. 30" min="1" required>
            </div>

            <div class="form-group">
                <label for="reward_limit">Reward Generation Limit (₹)</label>
                <input type="number" name="reward_limit" id="reward_limit" placeholder="e.g. 100" min="1" required>
            </div>

            <div class="form-group">
                <label for="description">Plan Description</label>
                <textarea name="description" id="description" rows="4" placeholder="Enter plan description (optional)"></textarea>
            </div>


            <div class="form-actions">
                <button type="submit" class="btn-submit">Create Plan</button>
                <a href="{{ route('admin.subscription.index') }}" class="btn-back">Back</a>
            </div>
        </form>
    </div>
@endsection
