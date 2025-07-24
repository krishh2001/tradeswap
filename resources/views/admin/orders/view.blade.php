@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Order</h2>

        <div class="form-group">
            <label>Order ID</label>
            <p class="form-value">{{ $order->order_id }}</p>
        </div>

        <div class="form-group">
            <label>Customer</label>
            <p class="form-value">{{ $order->user->name ?? 'Guest' }}</p>
        </div>

        <div class="form-group">
            <label>Product</label>
            <p class="form-value">{{ $order->product->name ?? 'N/A' }}</p>
        </div>

        <div class="form-group">
            <label>Total Price</label>
            <p class="form-value">₹{{ number_format($order->total_price, 2) }}</p>
        </div>

        {{-- <div class="form-group">
            <label>Status</label>
            <p class="form-value">{{ ucfirst($order->status) }}</p>
        </div> --}}

        <div class="form-group">
            <label>Placed At</label>
            <p class="form-value">{{ $order->created_at->format('d M, Y') }}</p>
        </div>

        <br>
        <a href="{{ route('admin.orders.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
