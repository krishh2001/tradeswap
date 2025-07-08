@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Bill Details</h2>

        <div class="form-group">
            <label>Bill No</label>
            <p class="form-value">#BILL001</p>
        </div>

        <div class="form-group">
            <label>Customer</label>
            <p class="form-value">John Doe</p>
        </div>

        <div class="form-group">
            <label>Amount</label>
            <p class="form-value">₹2,500</p>
        </div>

        <div class="form-group">
            <label>Cashback</label>
            <p class="form-value">₹150</p>
        </div>

        <div class="form-group">
            <label>Status</label>
            <p class="form-value">Pending</p>
        </div>

        <div class="form-group">
            <label>Created At</label>
            <p class="form-value">2025-06-18</p>
        </div>

        <br>
        <a href="{{ route('admin.bill_details.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
