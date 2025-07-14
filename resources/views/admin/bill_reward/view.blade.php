@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>View Wallet</h2>

    <div class="form-group">
        <label>User Name</label>
        <p class="form-value">{{ $user->name }}</p>
    </div>

    <div class="form-group">
        <label>Email Address</label>
        <p class="form-value">{{ $user->email }}</p>
    </div>

    <div class="form-group">
        <label>Wallet Balance</label>
        <p class="form-value">₹{{ number_format($user->wallet_balance ?? 0, 2) }}</p>
    </div>

    <br>
    <a href="{{ route('admin.wallet.index') }}" class="btn-back">Back to List</a>
</div>
@endsection
