@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Order</h2>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            Order #{{ $order->id }}
        </div>
        <div class="card-body">
            <p><strong>Event:</strong> {{ $order->ticket->event->title ?? 'No Event' }}</p>
            <p><strong>Kelas Tiket:</strong> {{ $order->ticket_class }}</p>
            <p><strong>Nama Pembeli:</strong> {{ $order->buyer_name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Jumlah Tiket:</strong> {{ $order->quantity }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
            <p><strong>Status:</strong>
                @if($order->status == 'pending')
                <span class="badge bg-warning">Pending</span>
                @elseif($order->status == 'success')
                <span class="badge bg-success">Success</span>
                @else
                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                @endif
            </p>
        </div>
    </div>

    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali</a>
</div>
@endsection