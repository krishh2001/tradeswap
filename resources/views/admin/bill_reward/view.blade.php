@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>Bill Reward Details</h2>

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
            <label>Bill PDF</label>
            <p><a href="{{ asset('storage/' . $bill->bill_pdf) }}" target="_blank">View PDF</a></p>
        </div>
    @endif

    @if ($bill->status === 'pending')
    <form method="POST" action="{{ route('admin.bill_reward.approve', $bill->id) }}">
        @csrf
        <div class="form-group">
            <label>Enter Reward Amount</label>
            <input type="number" name="reward" class="form-control" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success">Approve</button>
    </form>

    <form method="POST" action="{{ route('admin.bill_reward.discard', $bill->id) }}" class="mt-2">
        @csrf
        <button type="submit" class="btn btn-warning">Discard</button>
    </form>
    @endif

    <form method="POST" action="{{ route('admin.bill_reward.delete', $bill->id) }}" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this bill?')">Delete</button>
    </form>

    <br>
    <a href="{{ route('admin.bill_reward.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
