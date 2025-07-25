<?php

// app/Http/Controllers/Api/PaymentController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user')->get();

        return response()->json([
            'status' => true,
            'payments' => $payments
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'plan' => 'required|string',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'date' => 'required|date',
            'status' => 'required|in:pending,success,failed',
        ]);

        $payment = Payment::create($validated);

        return response()->json(['status' => true, 'message' => 'Payment recorded', 'payment' => $payment]);
    }
}
