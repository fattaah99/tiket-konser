<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class TicketController extends Controller
{
    public function printTicket($id)
    {
        $order = Order::findOrFail($id);
        return view('tickets.print', compact('order'));
    }
}