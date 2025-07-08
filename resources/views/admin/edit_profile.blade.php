@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>Edit Profile</h2>

        <form action="#" method="POST" enctype="multipart/form-data">
            <!-- CSRF and PUT method are removed since it's static -->

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" value="Vishnu Rajput" required>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Image</label>
                <input type="file" name="profile_picture" id="profile_picture">

                <div style="margin-top: 10px;">
                    <img src="{{ asset('images/default-avatar.png') }}" alt="Profile Image"
                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 50px;">
                </div>
            </div>

            <button type="submit" class="btn-submit">Update</button>
            <a href="#" class="btn-back">Cancel</a>
        </form>
    </div>
@endsection
