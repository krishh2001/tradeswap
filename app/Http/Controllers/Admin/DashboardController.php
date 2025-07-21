<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\WithdrawRequest;
use App\Models\SupportTicket;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalOrders' => Order::count(),
            'totalWithdrawRequests' => WithdrawRequest::count(),
            'totalTickets' => SupportTicket::count(),
        ]);
    }
}
