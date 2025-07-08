<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Display user list

  public function index()
    {
        return view('admin.users.index');
    }
  public function create()
    {
        return view('admin.users.create');
    }
  public function edit()
    {
        return view('admin.users.edit');
    }
  public function view()
    {
        return view('admin.users.view');
    }
}
