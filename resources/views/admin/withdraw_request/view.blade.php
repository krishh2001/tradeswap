@extends('admin.layouts.admin')

@section('content')
    <style>
        .badge-warning {
            background: linear-gradient(135deg, #ffb300, #835200);
            color: #fff;
            padding: 7px 10px;
            border-radius: 4px;
        }

        .badge-info {
            background: linear-gradient(135deg, #018d3d, #00501e);
            color: #fff;
            padding: 7px 10px;
            border-radius: 6px;
        }
    </style>
    <div class="user-create-wrapper">
        <h2>Withdraw Request Details</h2>

        <div class="form-group">
            <label><strong>User:</strong></label>
            <p class="form-value">{{ $request->user->name ?? 'N/A' }}</p>
        </div>

        <div class="form-group">
            <label><strong>Email:</strong></label>
            <p class="form-value">{{ $request->user->email ?? 'N/A' }}</p>
        </div>

        <div class="form-group">
            <label><strong>Amount:</strong></label>
            <p class="form-value">₹{{ number_format($request->amount, 2) }}</p>
        </div>

        <div class="form-group">
            <label><strong>Method:</strong></label>
            <p class="form-value">{{ ucfirst($request->method) }}</p>
        </div>

        <div class="form-group">
            <label><strong>Status:</strong></label>
            <p class="form-value">
                @if ($request->status === 'pending')
                    <span class="badge badge-warning">Pending</span>
                @elseif ($request->status === 'approved')
                    <span class="badge badge-info">Approved</span>
                @elseif ($request->status === 'successful')
                    <span class="badge badge-success">Successful</span>
                @else
                    <span class="badge badge-secondary">{{ ucfirst($request->status) }}</span>
                @endif
            </p>
        </div>

        <div class="form-group">
            <label><strong>Requested At:</strong></label>
            <p class="form-value">{{ $request->created_at->format('d M Y, h:i A') }}</p>
        </div>

        @if ($request->note)
            <div class="form-group">
                <label><strong>Note:</strong></label>
                <p class="form-value">{{ $request->note }}</p>
            </div>
        @endif

        <a href="{{ route('admin.withdraw_request.index') }}" class="btn-back">← Back to List</a>

    </div>
@endsection
