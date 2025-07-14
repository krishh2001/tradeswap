<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        $query = SupportTicket::query();

        if ($request->filled('search')) {
            $query->where('user_name', 'like', '%' . $request->search . '%');
        }

      

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tickets = $query->orderByDesc('created_at')->paginate(10);

        return view('admin.supports.index', compact('tickets'));
    }

    public function toggleStatus($id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $ticket->status = $ticket->status === 'pending' ? 'resolved' : 'pending';
        $ticket->save();

        return back()->with('success', 'Ticket status updated!');
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string'
        ]);

        $ticket = SupportTicket::findOrFail($id);
        $ticket->reply = $request->reply;
        $ticket->status = 'resolved';
        $ticket->save();

        return back()->with('success', 'Reply sent successfully!');
    }

    public function destroy($id)
    {
        SupportTicket::findOrFail($id)->delete();
        return back()->with('success', 'Ticket deleted successfully!');
    }
}
