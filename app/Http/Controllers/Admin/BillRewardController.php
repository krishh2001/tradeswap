<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BillReward;
use App\Models\User;
use Illuminate\Http\Request;

class BillRewardController extends Controller
{
    public function index()
    {
        $bills = BillReward::with('user')->latest()->get();
        return view('admin.bill_reward.index', compact('bills'));
    }

    public function show($id)
    {
        $bill = BillReward::with('user')->findOrFail($id);
        return view('admin.bill_reward.view', compact('bill'));
    }

    public function approve(Request $request, $id)
    {
        $bill = BillReward::findOrFail($id);
        $bill->reward = $request->reward;
        $bill->status = 'approved';
        $bill->save();

        // logic to credit reward to user wallet (if needed)

        return back()->with('success', 'Reward approved successfully.');
    }

    public function discard($id)
    {
        $bill = BillReward::findOrFail($id);
        $bill->status = 'discarded';
        $bill->save();

        return back()->with('success', 'Reward discarded.');
    }

    public function destroy($id)
    {
        BillReward::destroy($id);
        return back()->with('success', 'Bill deleted succesfully.');
    }
}
