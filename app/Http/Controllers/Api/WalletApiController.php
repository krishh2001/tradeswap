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

        // Fetch latest approved bill reward
        $latestBill = $user->billRewards()
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->first();

        // Determine plan status
        if ($latestBill) {
            if ($latestBill->remaining_days > 0) {
                $planStatus = 'active';
            } else {
                $planStatus = 'expired';
            }
        } else {
            $planStatus = 'no active plan';
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                // 'status' => $user->status,
                'wallet_reward' => $user->wallet_reward ?? 0,
                'wallet_cashback' => $user->wallet_cashback ?? 0,
                'plan' => $latestBill->plan ?? null,
                'reward_limit' => $latestBill->amount ?? 0,
                'remaining_days' => $latestBill->remaining_days ?? 0,
                'plan_status' => $planStatus
            ]
        ]);
    } 
}
