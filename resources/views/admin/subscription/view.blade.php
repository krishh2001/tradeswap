@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Subscription Plan</h2>

        <div class="form-group">
            <label>Plan Name</label>
            <p class="form-value">Basic Plan</p>
        </div>

        <div class="form-group">
            <label>Price</label>
            <p class="form-value">₹9,999</p>
        </div>

        <br>
        <a href="{{ route('admin.subscription.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
