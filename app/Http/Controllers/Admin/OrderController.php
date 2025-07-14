<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }


    public function view($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin.orders.view', compact('order'));
    }


    public function destroy($id)
    {
        Order::destroy($id);
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
