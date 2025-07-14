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
        $bill = Bill::findOrFail($id);
        $bill->cashback = $request->cashback;
        $bill->status = 'approved';
        $bill->save();

        return response()->json(['success' => true]);
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
