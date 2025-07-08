<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BillDetail;

class BillDetailsController extends Controller
{
    // Display bill details list

    public function index()
    {
        return view('admin.bill_details.index');
    }
    public function view()
    {
        return view('admin.bill_details.view');
    }
    public function index1()
    {
        return view('admin.bill_details_reward.index');
    }
    public function view1()
    {
        return view('admin.bill_details_reward.view');
    }
    
}
