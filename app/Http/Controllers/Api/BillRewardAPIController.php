<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\RewardBill;
use Illuminate\Validation\ValidationException;

class BillRewardAPIController extends Controller
{
    /**
     * Upload a new reward bill.
     */
   public function upload(Request $request)
{
    try {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:5120', // max 5MB
        ]);

        $user = Auth::user(); // or set default user_id = 1 for testing

        $filename = Str::random(20) . '.' . $request->file->getClientOriginalExtension();
        $path = $request->file('file')->storeAs('reward_bills', $filename, 'public');

        $bill = RewardBill::create([
            'user_id' => $user->id,
            'bill_number' => strtoupper(Str::random(10)),
            'file' => $path,
            'cashback' => 0,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reward bill uploaded successfully.',
            'data' => $bill,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Please try again.',
        ], 500);
    }
}


    /**
     * List all bills of the logged-in user
     */
    public function index()
    {
        $user = Auth::user();
        $bills = RewardBill::where('user_id', $user->id)->latest()->get();

        // Attach full URL to file
        $bills->map(function ($bill) {
            $bill->file_url = Storage::url('reward_bills/' . $bill->file);
            return $bill;
        });

        return response()->json([
            'success' => true,
            'data' => $bills,
        ]);
    }

    /**
     * Get a specific bill detail
     */
    public function show($id)
    {
        $user = Auth::user();
        $bill = RewardBill::where('id', $id)->where('user_id', $user->id)->first();

        if (!$bill) {
            return response()->json([
                'success' => false,
                'message' => 'Bill not found.',
            ], 404);
        }

        $bill->file_url = Storage::url('reward_bills/' . $bill->file);

        return response()->json([
            'success' => true,
            'data' => $bill,
        ]);
    }
}
