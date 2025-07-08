@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View User</h2>

        <div class="form-group">
            <label>Full Name</label>
            <p class="form-value">John Doe</p>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <p class="form-value">john@example.com</p>
        </div>

        <div class="form-group">
            <label>Role</label>
            <p class="form-value">Admin</p>
        </div>

        <div class="form-group">
            <label>Status</label>
            <p class="form-value">Active</p>
        </div>

        <br>
        <a href="{{ route('admin.users.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
