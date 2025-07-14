<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class ManageAppController extends Controller
{
    public function pages()
    {
        $privacyPolicy = Page::where('type', 'privacy_policy')->first();
        $termsConditions = Page::where('type', 'terms_conditions')->first();

        return view('admin.manage_app.pages', compact('privacyPolicy', 'termsConditions'));
    }

    public function updatePages(Request $request)
    {
        $request->validate([
            'page_type' => 'required|in:privacy_policy,terms_conditions',
            'content' => 'required|string',
        ]);

        Page::updateOrCreate(
            ['type' => $request->page_type],
            ['content' => $request->content]
        );

        return redirect()->route('admin.manage_app.pages')->with('success', 'Page content updated successfully.');
    }

    public function popup()
    {
        return view('admin.manage_app.popup');
    }
}
