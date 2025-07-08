<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ManageAppController extends Controller
{
    public function sliders()
    {
        return view('admin.manage_app.sliders'); 
    }
      public function pages()
    {
        return view('admin.manage_app.pages'); 
    }
    public function popup()
    {
        return view('admin.manage_app.popup'); 
    }
  
   
}
