@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>Bill Reward Details</h2>

    <div class="form-group">
        <label>Plan Name</label>
        <p class="form-value">{{$bill->plan ?? 'N/A'}}</p>
    </div>
    <div class="form-group">
        <label>User Name</label>
        <p class="form-value">{{ $bill->user->name ?? 'N/A' }}</p>
    </div>

    <div class="form-group">
        <label>Email Address</label>
        <p class="form-value">{{ $bill->user->email ?? 'N/A' }}</p>
    </div>

    <div class="form-group">
        <label>Bill Number</label>
        <p class="form-value">{{ $bill->bill_no }}</p>
    </div>

    <div class="form-group">
        <label>Amount</label>
        <p class="form-value">₹{{ number_format($bill->amount, 2) }}</p>
    </div>

    <div class="form-group">
        <label>Reward</label>
        <p class="form-value">
            @if($bill->reward)
                ₹{{ number_format($bill->reward, 2) }}
            @else
                Not rewarded yet
            @endif
        </p>
    </div>

    <div class="form-group">
        <label>Status</label>
        <p class="form-value text-capitalize">{{ $bill->status }}</p>
    </div>

    @if ($bill->bill_pdf)
        <div class="form-group">
            <label>Bill </label>
            <p><a href="{{ asset('public/' . $bill->bill_pdf) }}" target="_blank" class="btn-delete">View Bill</a></p>
        </div>
    @endif

   

    <br>
    <a href="{{ route('admin.sub_reward.index') }}" class="btn-back">Back to List</a>
</div>
@endsection
