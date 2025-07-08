<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show order list
    public function index()
    {
        return view('admin.orders.index');
    }

    // Show order view
    public function view()
    {
        return view('admin.orders.view');
    }
}
