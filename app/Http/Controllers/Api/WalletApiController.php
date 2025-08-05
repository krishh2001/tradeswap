<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BillReward;

class WalletApiController extends Controller
{
    // Get all users with wallet info (admin view)
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'status', 'wallet_reward', 'wallet_cashback')->get();

        if ($users->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No users found.',
                'data' => []
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    // Get wallet info for the logged-in user
    public function show()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please log in first.',
                'data' => null
            ]);
        }

        // Get latest approved bill
        $latestBill = $user->billRewards()
            ->where('status', 'approved')
            ->latest()
            ->first();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'wallet_reward' => $user->wallet_reward ?? 0,
                'wallet_cashback' => $user->wallet_cashback ?? 0,
                'plan' => $latestBill ? $latestBill->plan : null,
                'remaining_days' => $latestBill ? $latestBill->remaining_days : null,
            ]
        ]);
    }
}
