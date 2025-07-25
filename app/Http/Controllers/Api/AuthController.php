<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    // Step 1: Registration - Send OTP to email

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'mobile_number'  => 'required|string|unique:users,mobile_number',
            'password'       => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors()
            ], 422);
        }

        $otp = rand(1000, 9999);

        // Store data temporarily (5 min)
        Cache::put('pending_registration_' . $request->email, [
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => $request->password, // ✅ plain password
        ], now()->addMinutes(5));


        // Send email
        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Verify your email');
        });

        // Save OTP to cache
        Cache::put('otp_' . $request->email, $otp, now()->addMinutes(5));

        return response()->json([
            'status' => true,
            'message' => 'OTP sent to your email. Please verify to complete registration.'
        ]);
    }


    // Step 2: Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:4',
        ]);

        $cachedOtp = Cache::get('otp_' . $request->email);
        $userData = Cache::get('pending_registration_' . $request->email);

        if (!$cachedOtp || !$userData) {
            return response()->json(['message' => 'OTP expired or invalid.'], 400);
        }

        if ($request->otp != $cachedOtp) {
            return response()->json(['message' => 'Incorrect OTP.'], 400);
        }

        // Generate unique referral code
        $referralCode = strtoupper(substr(md5(uniqid()), 0, 8));

        $user = User::create([
            'name'              => $userData['name'],
            'email'             => $userData['email'],
            'mobile_number'     => $userData['mobile_number'],
            'password'          => $userData['password'],
            'referral_code'     => $referralCode,
            'is_email_verified' => true,
            'email_verified_at' => now(),
            'date_of_joining'   => now(),
        ]);

        // Clear OTP and temp data
        Cache::forget('otp_' . $request->email);
        Cache::forget('pending_registration_' . $request->email);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Email verified and user registered successfully.',
            'token'   => $token,
            'user'    => $user,
        ]);
    }



    // Login
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
            ], 400); // Bad Request
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


    // Get Profile
   public function profile(Request $request)
{
    $user = $request->user();

    return response()->json([
        'status' => true,
        'message' => 'Profile fetched successfully.',
        'user' => [
            'name'           => $user->name,
            'email'          => $user->email,
            'mobile_number'  => $user->mobile_number,
            'profile_photo'  => $user->profile_photo
                ? 'storage/profile_photos/' . $user->profile_photo
                : null,
        ]
    ]);
}



    // Update Profile
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'mobile_number' => ['required', 'digits:10', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => 'nullable|image|max:5120', // Max 5MB
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;

        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Store new photo and save the path (like: profile_photos/abc123.jpg)
            $user->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully.',
            'user' => [
                'name'          => $user->name,
                'email'         => $user->email,
                'mobile_number' => $user->mobile_number,
                'profile_photo' => $user->profile_photo
                    ? 'storage/' . $user->profile_photo // correct relative path
                    : null,
            ],
        ]);
    }



    // ✅ Get Authenticated User
    public function user(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized. Invalid or expired token.',
                ], 401);
            }

            return response()->json([
                'status' => true,
                'message' => 'User fetched successfully.',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while fetching user.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // ✅ Logout Authenticated User
    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized. Invalid or expired token.',
                ], 401);
            }

            $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred during logout.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
