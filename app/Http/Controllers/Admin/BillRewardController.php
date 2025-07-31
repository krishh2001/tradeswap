<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RewardBill;

class BillRewardController extends Controller
{
    public function index()
    {
        $reward_bills = RewardBill::with('user')->latest()->get();
        return view('admin.reward_bill.index', compact('reward_bills'));
    }

public function view($id)
{
    $reward_bills = RewardBill::findOrFail($id);
    return view('admin.reward_bill.view', compact('reward_bills'));
}


   // RewardBillController.php
public function approve(Request $request, $id)
{
    $request->validate(['cashback' => 'required|numeric|min:1']);

    $bill = RewardBill::with('user')->findOrFail($id);
    $cashback = $request->cashback;

    if ($bill->status === 'approved') {
        return response()->json(['success' => false, 'message' => 'Already approved.']);
    }

    // Step 1: Update reward bill
    $bill->cashback = $cashback;
    $bill->status = 'approved';
    $bill->save();

    // Step 2: Update user's wallet balance
    $user = $bill->user;
    if ($user) {
        $user->wallet_balance += $cashback;
        $user->save();
    }

        return redirect()->route('admin.reward_bill.index')->with('success', 'Reward Approved.');

}



   public function discardCashback($id)
{
    $reward = RewardBill::findOrFail($id);
    $reward->status = 'discarded';
    $reward->save();

    return redirect()->route('admin.reward_bill.index')->with('success', 'Reward discarded.');
}


    public function destroy($id)
    {
        $bill = RewardBill::findOrFail($id);
        $bill->delete();

        return redirect()->route('admin.reward_bill.index')
            ->with('success', 'Bill deleted successfully.');
    }
}
