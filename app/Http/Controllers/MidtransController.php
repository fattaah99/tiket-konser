<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class MidtransController extends Controller
{
    public function checkPaymentStatus($orderId)
    {
        $serverKey = config('services.midtrans.server_key'); // Ambil server key dari .env
        $encodedKey = base64_encode($serverKey . ":"); // Encode untuk authentication

        // Panggil API Midtrans
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $encodedKey
        ])->get("https://api.sandbox.midtrans.com/v2/$orderId/status");

        $data = $response->json();

        if (!$response->successful()) {
            return response()->json(['message' => 'Gagal mendapatkan status pembayaran'], 400);
        }

        // Cek status pembayaran dari response
        $order = Order::where('id', $orderId)->first();
        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        // Update status order berdasarkan response dari Midtrans
        if ($data['transaction_status'] == 'settlement' || $data['transaction_status'] == 'capture') {
            $order->status = 'success';
        } elseif ($data['transaction_status'] == 'pending') {
            $order->status = 'pending';
        } elseif ($data['transaction_status'] == 'expire' || $data['transaction_status'] == 'cancel') {
            $order->status = 'cancelled';
        }

        $order->save();

        return response()->json([
            'message' => 'Status pembayaran diperbarui',
            'status' => $order->status
        ]);
    }
}