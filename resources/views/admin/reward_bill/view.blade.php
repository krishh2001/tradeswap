@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Bill Details</h2>

        <div class="form-group"><label>Bill No</label>
            <p class="form-value">{{ $reward_bills->bill_number }}</p>
        </div>
        <div class="form-group"><label>Customer</label>
            <p class="form-value">{{ $reward_bills->user->name }}</p>
        </div>


        <div class="form-group"><label>Status</label>
            <p class="form-value">{{ ucfirst($reward_bills->status) }}</p>
        </div>
        <div class="form-group"><label>Created At</label>
            <p class="form-value">{{ $reward_bills->created_at->format('Y-m-d') }}</p>
        </div>

        <div class="form-group"><label>Bill</label>
            @if ($reward_bills->file)
                @php
                    $fileUrl = url('public/' . $reward_bills->file); // Add 'public/' prefix manually
                @endphp
                <a href="{{ $fileUrl }}" target="_blank" class="btn-delete">View Bill</a>
            @else
                <p class="form-value">N/A</p>
            @endif
        </div>
        <br>
        <a href="{{ route('admin.reward_bill.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
