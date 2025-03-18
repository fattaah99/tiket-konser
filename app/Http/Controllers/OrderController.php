<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Menampilkan detail tiket tertentu
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return response()->json($ticket);
    }

    public function store(Request $request)
{
    // Validasi input
   
    $request->validate([
      
        'ticket_id' => 'required|integer',
        'ticket_class' => 'required|in:Reguler,VIP',
        'buyer_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'quantity' => 'required|string',
        'total_price' => 'required|string',
        
    ]);

    // Buat order baru
    $order=Order::create([
      
        'ticket_id' => $request->ticket_id,
        'ticket_class' => $request->ticket_class,
        'buyer_name' => $request->buyer_name,
        'email' => $request->email,
        'quantity' => $request->quantity,
        'total_price' => $request->total_price,
        'status' =>'pending'
    ]);

    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = config('midtrans.serverKey');
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = false;
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;

    $transaction_details = [
        'order_id' => $order->id,
        'gross_amount' => $order->total_price,
    ];

    $customer_details = [
        'first_name' => $order->buyer_name,
        'email' => $order->email,
    ];

    $params = [
        'transaction_details' => $transaction_details,
        'customer_details' => $customer_details
    ];

    $snapToken = \Midtrans\Snap::getSnapToken($params);
    $order ->snap_token = $snapToken;

    $order -> save();


    return view('order.payment', compact('snapToken', 'order'));

}


    // Membuat order baru
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     // 🔍 Validasi input
    //     $request->validate([
    //         'ticket_id' => 'required|exists:tickets,id',
    //         'quantity' => 'required|integer|min:1',
    //         'buyer_name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //     ]);
    
    //     // 🔐 Pastikan user login
    //     if (!Auth::check()) {
    //         return redirect()->back()->with('error', 'Anda harus login untuk melakukan pemesanan.');
    //     }
    
    //     // 🔍 Ambil data tiket
    //     $ticket = Ticket::findOrFail($request->ticket_id);
    //     $totalPrice = $ticket->price * $request->quantity;
    
    //     // 📌 Siapkan data order
    //     $orderData = [
    //         'user_id' => Auth::id(), // Ambil user yang sedang login
    //         'ticket_id' => $ticket->id,
    //         'ticket_class' => $ticket->ticket_class, // Pastikan field ini ada di database
    //         'buyer_name' => $request->buyer_name, // Ambil dari input
    //         'email' => $request->email, // Ambil dari input
    //         'quantity' => $request->quantity,
    //         'total_price' => $totalPrice,
    //         'status' => 'pending',
    //     ];
    
    //     // 🛠 Debugging sebelum insert
    //     dd("📌 Data sebelum insert:", $orderData); 
    
    //     // 🔄 Simpan ke database dengan transaksi
    //     DB::beginTransaction();
    //     try {
    //         $order = Order::create($orderData);
    //         DB::commit();
    //         return redirect()->back()->with('success', 'Order berhasil dibuat!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->with('error', 'Gagal membuat order: ' . $e->getMessage());
    //     }
    // }
    
    
    // public function store(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $order = Order::create([
    //             'user_id' => 1, // Hardcode user ID (misalnya user ID 1)
    //             'ticket_id' => 2, // Hardcode ticket ID
    //             'ticket_class' => 'VIP', // Hardcode ticket class
    //             'buyer_name' => 'John Doe', // Hardcode nama pembeli
    //             'email' => 'johndoe@example.com', // Hardcode email
    //             'quantity' => 3, // Hardcode quantity
    //             'total_price' => 150000, // Hardcode total price
    //             'status' => 'pending',
    //         ]);
    
    //         DB::commit();
    //         return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['error' => 'Failed to create order', 'message' => $e->getMessage()], 500);
    //     }
    // }
    
    
}