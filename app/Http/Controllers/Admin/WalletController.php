<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
{
    $users = User::select('id', 'name', 'email', 'status', 'wallet_balance')->get();
    return view('admin.wallet.index', compact('users'));
}


    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.wallet.view', compact('user'));
    }

    public function toggleStatus($id)
{
    $user = User::findOrFail($id);
    $user->status = $user->status === 'active' ? 'inactive' : 'active';
    $user->save();

    return back()->with('success', 'User status updated.');
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.wallet.index')->with('success', 'User deleted successfully.');
    }
}
