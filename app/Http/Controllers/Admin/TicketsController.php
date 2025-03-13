<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin'); // Hanya admin yang bisa mengakses
    }

    public function index()
    {
        $tickets = Ticket::with('event')->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        // dd($request->all()); 
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_class' => 'required|in:Reguler,VIP',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
        ]);

        Ticket::create([
            'event_id' => $request->event_id,
            'ticket_class' => $request->ticket_class,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $events = Event::all();
        return view('admin.tickets.edit', compact('ticket', 'events'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_class' => 'required|in:Reguler,VIP',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
        ]);

        $ticket->update([
            'event_id' => $request->event_id,
            'ticket_class' => $request->ticket_class,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil dihapus!');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:tickets,id',
        ]);

        Ticket::whereIn('id', $request->ids)->delete();

        return response()->json(['success' => true, 'message' => 'Tiket berhasil dihapus!']);
    }
}