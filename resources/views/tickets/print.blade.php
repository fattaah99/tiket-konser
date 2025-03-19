<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Tiket</title>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
    <style>
    .ticket-container {
        width: 80mm;
        padding: 10px;
        border: 2px dashed black;
        text-align: center;
        margin: auto;
    }

    .ticket-header {
        font-size: 18px;
        font-weight: bold;
    }

    .ticket-body {
        font-size: 14px;
    }

    .qrcode {
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <div class="ticket-container">
        <div class="ticket-header">🎫 Tiket Konser</div>
        <hr>
        <div class="ticket-body">
            <p><strong>Nama:</strong> {{ $order->buyer_name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Tiket:</strong>
                <td>{{ $order->ticket->event->title ?? 'Event tidak ditemukan' }}</td>
            </p>
            <p><strong>Kelas:</strong> {{ $order->ticket_class }}</p>
            <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
            <p><strong>Total Bayar:</strong> Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
            <div class="qrcode">
                {!! QrCode::size(100)->generate(route('ticket.print', $order->id)) !!}
            </div>
        </div>
        <hr>
        <button onclick="window.print()" class="btn btn-primary btn-sm">🖨 Cetak Tiket</button>
    </div>
</body>

</html>