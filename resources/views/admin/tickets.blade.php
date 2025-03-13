@extends('admin.master')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tabel Tiket</h3>
                </div>
                <div class="col-sm-6 d-flex justify-content-end gap-3">
                    <input type="text" id="searchBox" class="form-control" style="max-width: 300px;"
                        placeholder="Search..." onkeyup="filterTable()">

                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">
                        Tambah Tiket
                    </button>
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
                            <h3 class="card-title">Daftar Tiket</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Event</th>
                                        <th>Pengguna</th>
                                        <th>Jenis Tiket</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $index => $ticket)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $ticket->event->title }}</td>
                                        <td>{{ $ticket->user->name }}</td>
                                        <td>{{ $ticket->ticket_type }}</td>
                                        <td>Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm"
                                                onclick="openEditModal({{ json_encode($ticket) }})">Edit</button>
                                            <form action="{{ route('admin.tickets.destroy', $ticket->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus tiket ini?')">Hapus</button>
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

        <!-- Modal Tambah Tiket -->
        <div class="modal fade" id="addDataModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Tiket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.tickets.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Event</label>
                                <select class="form-control" name="event_id" required>
                                    @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pengguna</label>
                                <select class="form-control" name="user_id" required>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Tiket</label>
                                <input type="text" class="form-control" name="ticket_type" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function openEditModal(ticket) {
        document.getElementById("edit_id").value = ticket.id;
        document.getElementById("edit_event").value = ticket.event_id;
        document.getElementById("edit_user").value = ticket.user_id;
        document.getElementById("edit_ticket_type").value = ticket.ticket_type;
        document.getElementById("edit_price").value = ticket.price;
        document.getElementById("editForm").action = "/admin/tickets/" + ticket.id;
        new bootstrap.Modal(document.getElementById("editModal")).show();
    }
    </script>
</main>
@endsection