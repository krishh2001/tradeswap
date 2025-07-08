@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Order</h2>

        <div class="form-group">
            <label>Order ID</label>
            <p class="form-value">#ORD1001</p>
        </div>

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
            <label>Date</label>
            <p class="form-value">2025-01-05</p>
        </div>

        <div class="form-group">
            <label>Status</label>
            <p class="form-value">Completed</p>
        </div>

        <br>
        <a href="{{ route('admin.orders.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
