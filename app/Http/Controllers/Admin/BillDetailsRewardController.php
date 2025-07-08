<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\BillDetail;

class BillDetailsRewardController extends Controller
{
    // Display bill details list

    public function index()
    {
        return view('admin.bill_reward.index');
    }
    public function view()
    {
        return view('admin.bill_reward.view');
    }
}
