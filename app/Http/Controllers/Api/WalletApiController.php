<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

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

    public function show($id)
    {
        $user = User::select('id', 'name', 'email', 'status', 'wallet_balance')->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }
}
