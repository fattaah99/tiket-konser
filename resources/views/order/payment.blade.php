<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Pembayaran</title>

    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Checkout Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="text-center">Order ID: <strong>{{ $order->id }}</strong></h5>
                        <p class="text-center">Nama: <strong>{{ $order->buyer_name }}</strong></p>
                        <p class="text-center">Email: <strong>{{ $order->email }}</strong></p>
                        <p class="text-center">Total Harga:
                            <strong>Rp{{ number_format($order->total_price, 0, ',', '.') }}</strong>
                        </p>

                        <div class="text-center mt-4">
                            <button id="pay-button" class="btn btn-success btn-lg w-100">
                                <i class="fa-solid fa-credit-card"></i> Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome untuk ikon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

    <!-- Midtrans Snap Payment -->
    <script>
    document.getElementById('pay-button').onclick = function() {
        window.snap.pay("{{ $snapToken }}", {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                window.location.href = "/order-success";
            },
            onPending: function(result) {
                alert("Menunggu pembayaran!");
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
            }
        });
    };
    </script>

</body>

</html>