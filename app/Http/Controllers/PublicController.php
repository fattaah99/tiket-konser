<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use App\Models\EventGallery;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $latestTicket = Ticket::with('event')->latest()->first(); // Ambil tiket terbaru beserta event-nya
        $tickets = Ticket::with('event')->latest()->get(); // Ambil semua tiket
        $eventGallery = EventGallery::whereIn('event_id', $tickets->pluck('event_id'))->get(); // Gallery berdasarkan event dari tiket
        $latestEventGallery = $latestTicket ? EventGallery::where('event_id', $latestTicket->event_id)->get() : collect();

        return view('public.home', compact('tickets', 'eventGallery', 'latestEventGallery', 'latestTicket'));
    }
    public function allTiket()
    {
        $latestTicket = Ticket::with('event')->latest()->first(); // Ambil tiket terbaru beserta event-nya
        $tickets = Ticket::with('event')->latest()->get(); // Ambil semua tiket
        $eventGallery = EventGallery::whereIn('event_id', $tickets->pluck('event_id'))->get(); // Gallery berdasarkan event dari tiket
        $latestEventGallery = $latestTicket ? EventGallery::where('event_id', $latestTicket->event_id)->get() : collect();

        return view('public.all-tiket', compact('tickets', 'eventGallery', 'latestEventGallery', 'latestTicket'));
    }
    
    public function show($id)
    {
        // Ambil tiket yang dipilih beserta event dan galerinya
        $ticket = Ticket::with(['event.galleries'])->findOrFail($id);
    
        // Ambil semua kelas tiket berdasarkan event_id
        $ticketClasses = Ticket::where('event_id', $ticket->event_id)
            ->select('id', 'ticket_class', 'price')
            ->distinct()
            ->get();
    
        return view('public.ticket-detail', compact('ticket', 'ticketClasses'));
    }
    
    
}