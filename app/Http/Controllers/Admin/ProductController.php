<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProductController extends Controller
{
    // Display product list

  public function index()
    {
        return view('admin.product.index');
    }
  public function create()
  {
      return view('admin.product.create');
    }
  public function edit()
  {
      return view('admin.product.edit');
  }
  public function view()
    {
        return view('admin.product.view');
    }
}
