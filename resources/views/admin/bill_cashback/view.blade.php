@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Bill Details</h2>

        <div class="form-group"><label>Bill No</label>
            <p class="form-value">{{ $bill->bill_no }}</p>
        </div>
        <div class="form-group"><label>Customer</label>
            <p class="form-value">{{ $bill->user->name }}</p>
        </div>
        <div class="form-group"><label>Amount</label>
            <p class="form-value">₹{{ $bill->amount }}</p>
        </div>
        <div class="form-group"><label>Cashback</label>
            <p class="form-value">₹{{ $bill->cashback ?? '0' }}</p>
        </div>
        <div class="form-group"><label>Status</label>
            <p class="form-value">{{ ucfirst($bill->status) }}</p>
        </div>
        <div class="form-group"><label>Created At</label>
            <p class="form-value">{{ $bill->created_at->format('Y-m-d') }}</p>
        </div>

        <a href="{{ route('admin.bill_cashback.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
