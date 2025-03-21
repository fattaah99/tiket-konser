<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;


class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin'); // Hanya admin yang bisa mengakses
    }

    public function index()
    {
        $orders = Order::with(['ticket.event'])->get();
        $tickets = Ticket::with('event')->get(); // Ambil tiket beserta eventnya
        return view('admin.orders.index', compact('orders', 'tickets'));
    }
    
    

    public function store(Request $request)
    {
        // Validasi input
        dd($request->all());
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'ticket_class' => 'required|string|max:255',
            'buyer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,canceled',
        ]);

        // Simpan data order
        Order::create($request->all());

        return redirect()->route('admin.orders.index')->with('success', 'Order berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        dd($request->all());
        // Validasi input
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'ticket_class' => 'required|string|max:255',
            'buyer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,canceled',
        ]);

        // Update data order
        $order->update($request->all());

        return redirect()->route('admin.orders.index')->with('success', 'Order berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order berhasil dihapus!');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:orders,id',
        ]);

        Order::whereIn('id', $request->ids)->delete();

        return response()->json(['success' => true, 'message' => 'Order berhasil dihapus!']);
    }
}