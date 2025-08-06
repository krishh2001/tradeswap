<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BillReward;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubRewardController extends Controller
{
    public function index()
    {
        $bills = BillReward::with('user')->latest()->get();
        return view('admin.sub_reward.index', compact('bills'));
    }

    public function show($id)
    {
        $bill = BillReward::with('user')->findOrFail($id);
        return view('admin.sub_reward.view', compact('bill'));
    }

   public function approve(Request $request, $id)
{
    $request->validate([
        'reward' => 'required|numeric|min:0',
    ]);

    $bill = BillReward::findOrFail($id);

    // Optional: Prevent duplicate approvals
    if ($bill->status === 'approved') {
        return redirect()->back()->with('error', 'Bill is already approved.');
    }

    // Update bill status and reward
    $bill->reward = $request->reward;
    $bill->status = 'approved';
    $bill->save();

    // Add reward to user's wallet
    $user = $bill->user;
    $user->wallet_reward += $request->reward;
    $user->save();

    return redirect()->back()->with('success', 'Reward approved and added to user wallet.');
}


    public function discard($id)
    {
        $bill = BillReward::findOrFail($id);

        // Avoid changing status if already approved or discarded
        if ($bill->status !== 'pending') {
            return back()->with('error', 'This bill is already processed.');
        }

        $bill->status = 'discarded';
        $bill->save();

        return back()->with('success', 'Reward discarded successfully.');
    }

    public function destroy($id)
    {
        BillReward::destroy($id);
        return back()->with('success', 'Bill deleted successfully.');
    }
}
