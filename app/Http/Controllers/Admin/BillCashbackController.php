<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;

class BillCashbackController extends Controller
{
    public function index()
    {
        $bills = Bill::with('user')->latest()->get();
        return view('admin.bill_cashback.index', compact('bills'));
    }

    public function view($id)
    {
        $bill = Bill::with('user')->findOrFail($id);
        return view('admin.bill_cashback.view', compact('bill'));
    }

   public function approveCashback(Request $request, $id)
{
    $request->validate(['cashback' => 'required|numeric|min:1']);

    $bill = Bill::with('user')->findOrFail($id);
    $cashback = $request->cashback;

    if ($bill->status === 'approved') {
        return response()->json(['success' => false, 'message' => 'Cashback already approved.']);
    }

    // Step 1: Update bill cashback and status
    $bill->cashback = $cashback;
    $bill->status = 'approved';
    $bill->save();

    // Step 2: Add cashback to user's wallet
    $user = $bill->user;
    if ($user) {
        $user->wallet_balance += $cashback;
        $user->save();
    }

    return response()->json(['success' => true, 'message' => 'Cashback approved and wallet updated.']);
}


    public function discardCashback($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->status = 'discarded';
        $bill->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
{
    $bill = Bill::findOrFail($id);
    $bill->delete();

    return redirect()->route('admin.bill_cashback.index')->with('success', 'Bill deleted successfully.');
}

}
