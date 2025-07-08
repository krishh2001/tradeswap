<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SubscriptionController extends Controller
{
    // Display user list

  public function index()
    {
        return view('admin.subscription.index');
    }
    
    public function create()
  {
      return view('admin.subscription.create');
    }
  public function edit()
  {
      return view('admin.subscription.edit');
  }
 
  public function view()
    {
        return view('admin.subscription.view');
    }
}
