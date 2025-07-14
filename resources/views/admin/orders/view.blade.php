@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Order</h2>

        <div class="form-group">
            <label>Order ID</label>
            <p class="form-value">{{ $order->order_id }}</p>
        </div>

        <div class="form-group">
            <label>User Name</label>
            <p class="form-value">{{ $order->user->name ?? 'N/A' }}</p>
        </div>

        <div class="form-group">
            <label>Plan</label>
            <p class="form-value">{{ $order->plan }}</p>
        </div>

        <div class="form-group">
            <label>Amount</label>
            <p class="form-value">${{ number_format($order->amount, 2) }}</p>
        </div>

        <div class="form-group">
            <label>Date</label>
            <p class="form-value">{{ \Carbon\Carbon::parse($order->date)->format('Y-m-d') }}</p>
        </div>

        <div class="form-group">
            <label>Status</label>
            <p class="form-value">{{ ucfirst($order->status) }}</p>
        </div>

        <br>
        <a href="{{ route('admin.orders.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
