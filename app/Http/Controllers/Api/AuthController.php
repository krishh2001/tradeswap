<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'             => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'mobile_number'         => 'required|digits:10|unique:users,mobile_number',
            'password'              => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name'           => $request->full_name,
            'email'          => $request->email,
            'mobile_number'  => $request->mobile_number,
            'password'       => $request->password,
            'wallet_balance' => 0,
            'status'         => 'active',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data'    => $user
        ]);
    }
}
