<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BillReward;


class WalletApiController extends Controller
{
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

    // Fetch all approved subscriptions with remaining_days > 0
    $activeBills = $user->billRewards()
        ->where('status', 'approved')
        ->orderBy('created_at', 'desc')
        ->get();

    $totalRemainingDays = $activeBills->sum('remaining_days');
    $latestBill = $activeBills->first();

    if ($activeBills->isEmpty()) {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'wallet_reward' => $user->wallet_reward ?? 0,
                'wallet_cashback' => $user->wallet_cashback ?? 0,
                'plan' => null,
                'reward_limit' => 0,
                'remaining_days' => 0,
                'subscription_expiry_date' => null,
                'plan_status' => 'No active plan'
            ]
        ]);
    }

    if ($totalRemainingDays <= 0) {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'wallet_reward' => $user->wallet_reward ?? 0,
                'wallet_cashback' => $user->wallet_cashback ?? 0,
                'plan' => $latestBill->plan ?? null,
                'reward_limit' => $latestBill->amount ?? 0,
                'remaining_days' => 0,
                'subscription_expiry_date' => $latestBill->created_at->format('Y-m-d'),
                'plan_status' => 'Expired'
            ]
        ]);
    }

    // Active plan
    $expiryDate = now()->addDays($totalRemainingDays)->format('Y-m-d');

    return response()->json([
        'success' => true,
        'data' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'wallet_reward' => $user->wallet_reward ?? 0,
            'wallet_cashback' => $user->wallet_cashback ?? 0,
            'plan' => $latestBill->plan ?? null,
            'reward_limit' => $latestBill->amount ?? 0,
            'remaining_days' => $totalRemainingDays,
            'subscription_expiry_date' => $expiryDate,
            'plan_status' => 'Active'
        ]
    ]);
}

}
