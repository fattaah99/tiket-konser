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
    // public function show($id)
    // {
    //     $ticket = Ticket::findOrFail($id);
    //     return response()->json($ticket);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|integer',
            'ticket_class' => 'required|in:Reguler,VIP',
            'user_id' => 'required|integer',
            'email' => 'required|email|max:255',
            'quantity' => 'required|string',
            'total_price' => 'required|string',
        ]);
    
        // Ambil ticket untuk mengetahui event_id
        $ticket = Ticket::findOrFail($request->ticket_id);
    
        // Hitung jumlah order untuk event ini yang status-nya selain pending
        $completedOrdersCount = Order::whereHas('ticket', function ($query) use ($ticket) {
            $query->where('event_id', $ticket->event_id);
        })
        ->where('user_id', $request->user_id)
        ->where('status', '!=', 'pending') // hanya hitung yang bukan pending
        ->count();
    
        if ($completedOrdersCount >= 3) {
            return redirect()->back()->with('error', 'Anda sudah mencapai batas maksimal 3 order yang telah dibayar untuk event ini.');
        }
    
        // Buat order baru
        $order = Order::create([
            'ticket_id' => $request->ticket_id,
            'ticket_class' => $request->ticket_class,
            'user_id' => $request->user_id,
            'email' => $request->email,
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
            'status' => 'pending'
        ]);
    
        $order->load('user');
    
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    
        $midtrans_order_id = 'ORDER-' . $order->id . '-' . uniqid();
    
        $transaction_details = [
            'order_id' => $midtrans_order_id,
            'gross_amount' => $order->total_price,
        ];
    
        $customer_details = [
            'first_name' => $order->user->name ?? 'Customer',
            'email' => $order->email,
        ];
    
        $params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details
        ];
    
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order->snap_token = $snapToken;
        $order->save();
    
        return view('order.payment', compact('snapToken', 'order'));
    }
    
    
    
    

public function success($id)
{
    // Cari order berdasarkan ID
    $order = Order::find($id);

    // Jika order tidak ditemukan, tampilkan error
    if (!$order) {
        return redirect()->route('home')->with('error', 'Order tidak ditemukan.');
    }

    // Perbarui status order menjadi 'success'
    $order->status = 'paid'; // Pastikan dalam tanda kutip
    $order->updated_at = now(); // Tambahkan update timestamp (opsional)
    $order->save();

    // Redirect ke halaman sukses dengan pesan sukses
    return view('order.order-success');
}

public function show($id)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat pesanan Anda.');
        }

        // Ambil order berdasarkan ID dan user yang login
        $order = Order::where('id', $id)->where('user_id', Auth::id())->first();

        // Jika order tidak ditemukan atau milik user lain
        if (!$order) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan atau bukan milik Anda.');
        }

        // Kirim data ke view
        return view('orders.show', compact('order'));
    }

    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat pesanan Anda.');
        }

        // Ambil semua order berdasarkan user yang login
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        // Kirim data ke view
        return view('orders.index', compact('orders'));
    }

    public function myOrders()
    {
        $userEmail = Auth::user()->email; // Ambil email dari user yang login
    
        $orders = Order::where('email', $userEmail)
                    ->with(['ticket.event']) // Muat relasi ticket dan event
                    ->get();
    
        return view('order.index', compact('orders'));
    }

    public function continue($id)
{
    $order = Order::findOrFail($id);

    // // Pastikan order masih berstatus pending
    // if ($order->status !== 'Pending') {
    //     return redirect()->route('home')->with('error', 'Transaksi sudah diproses atau tidak bisa dilanjutkan.');
    // }

    // Pastikan snap_token tersedia
    if (!$order->snap_token) {
        return redirect()->route('home')->with('error', 'Token pembayaran tidak tersedia.');
    }

    return view('order.payment', [
        'snapToken' => $order->snap_token,
        'order' => $order
    ]);
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