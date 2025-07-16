<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawRequest;

class WithdrawRequestController extends Controller
{
    public function index()
    {
        $withdrawRequests = WithdrawRequest::with('user')->latest()->get();
        return view('admin.withdraw_request.index', compact('withdrawRequests'));
    }

    public function view($id)
    {
        $request = WithdrawRequest::with('user')->findOrFail($id);
        return view('admin.withdraw_request.view', compact('request'));
    }

    public function toggleStatus(Request $request, $id)
    {
        $withdraw = WithdrawRequest::findOrFail($id);

        if ($withdraw->status === 'pending') {
            $withdraw->status = 'approved';
            $withdraw->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Already approved.']);
    }

    public function destroy($id)
    {
        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->delete();

        return redirect()->back()->with('success', 'Withdraw request deleted.');
    }
}
