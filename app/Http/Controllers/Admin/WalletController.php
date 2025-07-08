<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BillDetail;

class WalletController extends Controller
{
    // Display wallet list

    public function index()
    {
        return view('admin.wallet.index');
    }
    public function view()
    {
        return view('admin.wallet.view');
    }
}
