<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RewardBill;
use App\Models\User;

class BillRewardController extends Controller
{
    public function index()
{
    $reward_bills = RewardBill::with('user')->orderBy('created_at', 'desc')->get();

    return view('admin.reward_bill.index', compact('reward_bills'));
}

   public function view($id)
{
    $reward_bills = RewardBill::with('user')->findOrFail($id);
    return view('admin.reward_bill.view', compact('reward_bills'));
}


    public function approve(Request $request, $id)
    {
        try {
            $request->validate([
                'reward' => 'required|numeric|min:0',
            ]);

            $bill = RewardBill::with('user')->findOrFail($id);
            $user = $bill->user;

            $reward = $request->input('reward');
            $user->wallet_reward += $reward;
            $user->save();

            $bill->reward = $reward;
            $bill->status = 'approved';
            $bill->save();

            return response()->json([
                'success' => true,
                'message' => 'Reward approved successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function discard($id)
    {
        try {
            $bill = RewardBill::findOrFail($id);
            $bill->status = 'discarded';
            $bill->save();

            return response()->json([
                'success' => true,
                'message' => 'Bill has been discarded.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $bill = RewardBill::findOrFail($id);
        $bill->delete();

        return redirect()->route('admin.reward_bill.index')->with('success', 'Bill deleted successfully.');
    }
}
