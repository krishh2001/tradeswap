<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::query();

        if ($request->has('type')) {
            $query->where('report_type', $request->type);
        }

        if ($request->has('from_date')) {
            $query->where('report_date', '>=', $request->from_date);
        }

        if ($request->has('to_date')) {
            $query->where('report_date', '<=', $request->to_date);
        }

        return response()->json([
            'success' => true,
            'data' => $query->latest()->get()
        ]);
    }
}
