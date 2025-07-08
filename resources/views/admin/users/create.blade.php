@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>Create New User</h2>
        <form action="#" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" placeholder="Enter full name" required>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" id="email" placeholder="Enter email address" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="">-- Select Role --</option>
                    <option value="admin">Admin</option>
                    <option value="moderator">Moderator</option>
                    <option value="user">User</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Create a password" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Create User</button>
            <a href="{{ route('admin.users.index') }}" class="btn-back">Back</a>
        </form>
    </div>
@endsection
