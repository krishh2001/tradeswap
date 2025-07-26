<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;

class SupportTicketController extends Controller
{
    public function store(Request $request)
    {
        // Ensure token is valid and user is authenticated
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Token missing or invalid.',
            ], 401);
        }

        // Validate only subject and message (name/email will come from token)
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Store ticket
        $ticket = SupportTicket::create([
            'user_name'  => $user->name,
            'user_email' => $user->email,
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
