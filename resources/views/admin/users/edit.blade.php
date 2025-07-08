@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>Edit User</h2>
        <form action="#" method="POST">
            <!-- Static form, no CSRF needed here -->

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" value="John Doe" placeholder="Enter full name" required>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" id="email" value="john@example.com"
                    placeholder="Enter email address" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" name="role" id="role" value="Admin" placeholder="Enter role" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="active" selected>Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Update User</button>
            <a href="{{ route('admin.users.index') }}" class="btn-back">Back</a>
        </form>
    </div>
@endsection
