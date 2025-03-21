@extends('admin.master')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tabel Orders</h3>
                </div>
                <div class="col-sm-6 d-flex justify-content-end gap-3">
                    <input type="text" id="searchBox" class="form-control" style="max-width: 300px;"
                        placeholder="Search..." onkeyup="filterTable()">

                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Orders</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Event</th>
                                        <th>Nama Pembeli</th>
                                        <th>Email</th>
                                        <th>Kelas</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $index => $order)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $order->ticket->event->title ?? 'Tidak Ada Event' }}</td>
                                        <td>{{ $order->buyer_name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->ticket->ticket_class }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td>{{ ucfirst($order->status) }}</td>
                                        <td>

                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus order ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <script>
    function openEditModal(order) {
        document.getElementById("edit_id").value = order.id;
        document.getElementById("edit_buyer_name").value = order.buyer_name;
        document.getElementById("edit_email").value = order.email;
        document.getElementById("edit_quantity").value = order.quantity;
        document.getElementById("edit_total_price").value = order.total_price;
        document.getElementById("edit_ticket_id").value = order.ticket_id;

        // Kosongkan dropdown ticket class
        const ticketClassSelect = document.getElementById("edit_ticket_class");
        ticketClassSelect.innerHTML = '<option value="">Pilih Kelas Tiket</option>';

        // Set pilihan ticket class sesuai dengan tiket yang dipilih
        const selectedTicket = document.querySelector(`#edit_ticket_id option[value="${order.ticket_id}"]`);
        if (selectedTicket) {
            const ticketClass = selectedTicket.getAttribute("data-ticket-class");
            ticketClassSelect.innerHTML += `<option value="${ticketClass}" selected>${ticketClass}</option>`;
        }

        // Set action form ke URL update
        document.getElementById("editForm").action = "/admin/orders/" + order.id;

        // Tampilkan modal edit
        new bootstrap.Modal(document.getElementById("editModal")).show();
    }

    // Update ticket class saat ticket_id berubah
    document.getElementById("edit_ticket_id").addEventListener("change", function() {
        const ticketClassSelect = document.getElementById("edit_ticket_class");
        ticketClassSelect.innerHTML = '<option value="">Pilih Kelas Tiket</option>';

        const selectedTicket = this.options[this.selectedIndex];
        if (selectedTicket) {
            const ticketClass = selectedTicket.getAttribute("data-ticket-class");
            ticketClassSelect.innerHTML += `<option value="${ticketClass}" selected>${ticketClass}</option>`;
        }
    });
    </script>

</main>
@endsection