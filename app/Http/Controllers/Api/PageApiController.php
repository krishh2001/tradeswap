<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageApiController extends Controller
{
    public function getPage($key)
    {
        $page = Page::where('type', $key)->first();

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Page not found'], 404);
        }

        return response()->json([
            'success' => true,
            'type' => $key,
            'content' => $page->content, 
        ]);
    }
}
