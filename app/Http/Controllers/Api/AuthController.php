<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'mobile_number' => 'required|digits:10|unique:users,mobile_number',
            'password'      => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required_with:password|same:password',
            'referral_code' => 'nullable|string|exists:users,referral_code',
        ], [
            'full_name.required' => 'Full name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email.',
            'email.unique' => 'Email is already taken.',
            'mobile_number.required' => 'Mobile number is required.',
            'mobile_number.digits' => 'Mobile number must be 10 digits.',
            'mobile_number.unique' => 'Mobile number already exists.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Passwords do not match.',
            'referral_code.exists' => 'Invalid referral code.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        do {
            $generatedReferralCode = strtoupper(Str::random(6));
        } while (User::where('referral_code', $generatedReferralCode)->exists());

        $user = User::create([
            'name'            => $request->full_name,
            'email'           => $request->email,
            'mobile_number'   => $request->mobile_number,
            'password'        => bcrypt($request->password),
            'wallet_balance'  => 0,
            'status'          => 'active',
            'referral_code'   => $generatedReferralCode,
            'date_of_joining' => now()->format('Y-m-d'),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'       => 'Registration successful',
            'access_token'  => $token,
            'token_type'    => 'Bearer',
            'user'          => $user,
        ], 201);
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login_id' => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'login_id.required' => 'Email or mobile number is required.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        $loginId = $request->login_id;

        // Determine login method
        if (filter_var($loginId, FILTER_VALIDATE_EMAIL)) {
            $fieldType = 'email';
            $errorField = 'Email';
        } elseif (preg_match('/^[6-9]\d{9}$/', $loginId)) {
            $fieldType = 'mobile_number';
            $errorField = 'Mobile number';
        } else {
            return response()->json([
                'message' => 'Please enter a valid email or mobile number.'
            ], 422);
        }

        // Fetch user and check soft-deletion
        $user = User::where($fieldType, $loginId)->first();

        if (!$user) {
            return response()->json([
                'message' => "$errorField is not registered with us."
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Incorrect password.'
            ], 401);
        }

        // Check if user is inactive
        if ($user->status === 'inactive') {
            return response()->json([
                'message' => 'Your account is currently inactive. Please contact support.'
            ], 403);
        }

        // Optional: Check if user is blocked
        if ($user->status === 'blocked') {
            return response()->json([
                'message' => 'Your account is blocked. Please contact support.'
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
}
