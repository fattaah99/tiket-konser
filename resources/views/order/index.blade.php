@extends('user.layout.master')

@section('content')
<main class="app-main mt-4">
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
                                        <th>Buyer Name</th>
                                        <th>Email</th>
                                        <th>Ticket</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $index => $order)
                                    <tr>

                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $order->buyer_name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->ticket->event->title ?? 'No Event' }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge 
                                            @if($order->status == 'Pending') bg-warning 
                                            @elseif($order->status == 'Paid') bg-primary 
                                            @else bg-danger 
                                            @endif">
                                                {{ $order->status }}
                                            </span>
                                        </td>

                                        <td>
                                            @if($order->status == 'Paid')
                                            <a href="{{ route('ticket.print', $order->id) }}"
                                                class="btn btn-primary btn-sm" target="_blank">
                                                Print
                                            </a>
                                            @elseif($order->status == 'Pending')
                                            <a href="{{ route('orders.continue', $order->id) }}"
                                                class="btn btn-success btn-sm">
                                                Lanjutkan Transaksi
                                            </a>
                                            @endif
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

        <!-- Modal Tambah Order -->


    </div>

</main>
@endsection