<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\BillReward;

class BillRewardAPIController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bills = BillReward::where('user_id', $user->id)->latest()->get();

        // Append full image URL
        $bills->map(function ($bill) {
            $bill->bill_pdf = $bill->bill_pdf ? asset($bill->bill_pdf) : null;
            return $bill;
        });

        return response()->json([
            'status' => true,
            'data' => $bills
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'bill_pdf' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        $filename = null;
        if ($request->hasFile('bill_pdf')) {
            $file = $request->file('bill_pdf');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/bills', $filename, 'public'); // stored at: storage/app/public/uploads/bills/
        }

        do {
            $billNo = 'BILL' . now()->format('Ymd') . strtoupper(Str::random(4));
        } while (BillReward::where('bill_no', $billNo)->exists());

        $bill = BillReward::create([
            'plan' => $request->plan,
            'bill_no' => $billNo,
            'user_id' => $user->id,
            'amount' => $request->amount,
            'reward' => 0,
            'status' => 'pending',
            'bill_pdf' => $path ? 'storage/' . $path : null, // Saved as URL path
        ]);

        // Add full URL in response
        $bill->bill_pdf = $bill->bill_pdf ? asset($bill->bill_pdf) : null;

        return response()->json([
            'status' => true,
            'message' => 'Bill uploaded successfully!',
            'data' => $bill
        ]);
    }
}
