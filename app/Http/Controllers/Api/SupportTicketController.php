<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;

class SupportTicketController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_name'    => 'required|string|max:255',
            'user_email'   => 'required|email',
            'subject'      => 'required|string|max:255',
            'message'      => 'required|string',
        ]);

        $ticket = SupportTicket::create([
            'user_name'  => $request->user_name,
            'user_email' => $request->user_email,
            'subject'    => $request->subject,
            'message'    => $request->message,
            'status'     => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket submitted successfully.',
            'data'    => $ticket,
        ], 201);
    }
}
