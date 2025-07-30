<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class WalletApiController extends Controller
{
    // Return all users (admin use-case, optional)
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'status', 'wallet_balance')->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    // Return wallet info of the authenticated user
    public function show()
    {
        $user = Auth::user(); // Gets user from token

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Token missing or invalid.'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'wallet_balance' => $user->wallet_balance
            ]
        ]);
    }
}
