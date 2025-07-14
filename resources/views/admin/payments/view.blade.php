@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Payment</h2>

        <div class="form-group">
            <label>User Name</label>
            <p class="form-value">{{ $payment->user->name ?? 'N/A' }}</p>
        </div>

        <div class="form-group">
            <label>Plan</label>
            <p class="form-value">{{ $payment->plan }}</p>
        </div>

        <div class="form-group">
            <label>Amount</label>
            <p class="form-value">${{ number_format($payment->amount, 2) }}</p>
        </div>

        <div class="form-group">
            <label>Payment Method</label>
            <p class="form-value">{{ $payment->payment_method }}</p>
        </div>

        <div class="form-group">
            <label>Date</label>
            <p class="form-value">{{ \Carbon\Carbon::parse($payment->date)->format('Y-m-d') }}</p>
        </div>

        <div class="form-group">
            <label>Status</label>
            <p class="form-value">{{ ucfirst($payment->status) }}</p>
        </div>

        <br>
        <a href="{{ route('admin.payments.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
