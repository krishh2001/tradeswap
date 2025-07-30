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
        $users = User::select('id', 'name', 'email', 'status', 'wallet_balance')->get();

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

        $latestBill = $user->billRewards()->latest()->first();

        if (!$latestBill) {
            return response()->json([
                'success' => true,
                'message' => 'No subscription found for this user.',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'status' => $user->status,
                    'wallet_balance' => $user->wallet_balance,
                    'remaining_days' => null,
                ]
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'wallet_balance' => $user->wallet_balance,
                'remaining_days' => $latestBill->remaining_days,
            ]
        ]);
    }
}
