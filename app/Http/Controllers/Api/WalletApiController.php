<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BillReward; // ✅ Corrected model name

class WalletApiController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'status', 'wallet_balance')->get();

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
                'message' => 'Unauthorized. Token missing or invalid.'
            ], 401);
        }

        $latestBill = $user->billRewards()->latest()->first();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'wallet_balance' => $user->wallet_balance,
                'remaining_days' => $latestBill ? $latestBill->remaining_days : null,
            ]
        ]);
    }
}
