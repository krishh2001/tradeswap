@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Wallet</h2>

        <div class="form-group">
            <label>User Name</label>
            <p class="form-value">John Doe</p>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <p class="form-value">john@example.com</p>
        </div>

        <div class="form-group">
            <label>Wallet Balance</label>
            <p class="form-value">₹1,200</p>
        </div>

        <br>
        <a href="{{ route('admin.wallet.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
