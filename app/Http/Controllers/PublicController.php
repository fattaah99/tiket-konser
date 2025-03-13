<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use App\Models\EventGallery;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Menampilkan semua data tickets
    public function tickets()
    {
        $tickets = Ticket::all();
        return response()->json($tickets);
    }

    // Menampilkan semua data events
    public function events()
    {
        $events = Event::all();
        return response()->json($events);
    }

    // Menampilkan semua data event_gallery
    public function eventGallery()
    {
        $eventGallery = EventGallery::all();
        return response()->json($eventGallery);
    }

  
    // public function index()
    // {
    //     // Ambil semua event, tiket, dan event gallery dari database
    //     $events = Event::latest()->get();
    //     $tickets = Ticket::all();
    //     $eventGallery = EventGallery::all();

    //     return view('public.home', compact('events', 'tickets', 'eventGallery'));
    // }
    public function index()
    {
        $events = Event::with('galleries')->latest()->get();
    
        return view('public.home', compact('events'));
    }
    

    public function show($id)
{
    $event = Event::findOrFail($id);
    return view('public.event-detail', compact('event'));
}



}