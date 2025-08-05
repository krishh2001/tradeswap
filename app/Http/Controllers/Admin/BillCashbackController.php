<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\BillReward;

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

    public function approve(Request $request, $id)
{
    try {
        $request->validate([
            'cashback' => 'required|numeric|min:0',
        ]);

        $bill = Bill::with('user')->findOrFail($id);
        $user = $bill->user;

        $cashback = $request->input('cashback');
        $user->wallet_cashback += $cashback;
        $user->save();

        $bill->cashback = $cashback;
        $bill->status = 'approved';
        $bill->save();

        return response()->json([
            'success' => true,
            'message' => 'Cashback approved successfully.'
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
        $bill = Bill::findOrFail($id);
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
        $bill = Bill::findOrFail($id);
        $bill->delete();

        return redirect()->route('admin.bill_cashback.index')->with('success', 'Bill deleted successfully.');
    }
}
