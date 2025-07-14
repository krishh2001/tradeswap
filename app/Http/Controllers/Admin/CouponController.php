<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'discount' => 'required|numeric|min:1|max:100',
            'usage_limit' => 'required|integer|min:1',
            'limit_days' => 'required|integer|min:1',
            'used' => 'required|integer|min:1',
            'expiry_date' => 'required|date',
            'status' => 'required|in:active,expired',
        ]);

        Coupon::create($request->all());
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function view(Coupon $coupon)
    {
        return view('admin.coupons.view', compact('coupon'));
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'discount' => 'required|numeric|min:1|max:100',
            'usage_limit' => 'required|integer|min:1',
            'limit_days' => 'required|integer|min:1',
            'used' => 'required|integer|min:1',
            'expiry_date' => 'required|date',
            'status' => 'required|in:active,expired',
        ]);

        $coupon->update($request->all());
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully.');
    }

    public function toggleStatus(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->status = $request->status;
        $coupon->save();

        return response()->json(['success' => true, 'status' => $coupon->status]);
    }
}
