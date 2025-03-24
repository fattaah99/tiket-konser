<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Event;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin'); // Hanya admin yang bisa mengakses
    }
    public function index()
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalEvents = Event::count();
        $totalTickets = Ticket::count();

        return view('admin.dashboard', compact('totalUsers', 'totalOrders', 'totalEvents', 'totalTickets'));
    }
}