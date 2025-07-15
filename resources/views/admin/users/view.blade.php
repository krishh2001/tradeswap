@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View User</h2>

        <div class="form-group">
            <label>Full Name</label>
            <p class="form-value">{{ $user->name }}</p>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <p class="form-value">{{ $user->email }}</p>
        </div>

        <div class="form-group">
            <label>Mobile Number</label>
            <p class="form-value">{{ $user->mobile_number }}</p>
        </div>

        <div class="form-group">
            <label>Status</label>
            <p class="form-value">{{ ucfirst($user->status) }}</p>
        </div>

        <br>
        <a href="{{ route('admin.users.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
