<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\BillReward;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BillRewardAPIController extends Controller
{
    public function upload(Request $request)
    {
        try {
            // Validate incoming request
            $validated = $request->validate([
                'file' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            ]);

            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access.',
                ], 401);
            }

            // Store file in public disk under 'bills' folder
            $filename = $request->file('file')->store('bills', 'public');

            // Create new bill entry
           $bill = BillReward::create([
    'user_id' => $user->id,
    'bill_no' => 'BILL-' . strtoupper(Str::random(8)), // ✅ fix field name
    'bill_pdf' => $filename, // ✅ match with admin blade
    'reward' => 0, // ✅ fix column name
    'status' => 'pending',
]);

            return response()->json([
                'success'     => true,
                'message'     => 'Bill uploaded successfully.',
                'bill_number' => $bill->bill_number,
                'reward_cashback'    => 0,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    public function history()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access.',
                ], 401);
            }

            $bills = BillReward::where('user_id', $user->id)
                ->latest()
                ->get();

            $history = $bills->map(function ($bill) {
    return [
        'date' => now()->format('d-m-Y h:i A'),
        'amount' => $bill->status === 'approved' ? number_format($bill->reward, 2) : 0,
        'status' => ucfirst($bill->status)
    ];
});

$totalCashback = $bills->where('status', 'approved')->sum('reward');


            return response()->json([
                'success' => true,
                'total_reward' => number_format($totalCashback, 2),
                'history' => $history
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve history.',
            ], 500);
        }
    }
}
