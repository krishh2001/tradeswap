@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Payment</h2>

        <div class="form-group">
            <label>User Name</label>
            <p class="form-value">John Doe</p>
        </div>

        <div class="form-group">
            <label>Plan</label>
            <p class="form-value">Premium Plan</p>
        </div>

        <div class="form-group">
            <label>Amount</label>
            <p class="form-value">$199</p>
        </div>

        <div class="form-group">
            <label>Payment Method</label>
            <p class="form-value">Credit Card</p>
        </div>

        <div class="form-group">
            <label>Date</label>
            <p class="form-value">2025-01-10</p>
        </div>

        <div class="form-group">
            <label>Status</label>
            <p class="form-value">Success</p>
        </div>

        <br>
        <a href="{{ route('admin.payments.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
