@extends('admin.master')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tabel Events</h3>
                </div>
                <div class="col-sm-6 d-flex justify-content-end gap-3">
                    <input type="text" id="searchBox" class="form-control" style="max-width: 300px;"
                        placeholder="Search..." onkeyup="filterTable()">

                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">
                        Tambah Event
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
                            <h3 class="card-title">Daftar Events</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>No</th>
                                        <th>Nama Event</th>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($events as $index => $event)
                                    <tr>
                                        <td><input type="checkbox" class="eventCheckbox" value="{{ $event->id }}"></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->event_date }}</td>
                                        <td>{{ $event->location }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm"
                                                onclick="openEditModal({{ json_encode($event) }})">Edit</button>
                                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus event ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button class="btn btn-danger mt-4" id="deleteSelected">Hapus Terpilih</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Event -->
        <div class="modal fade" id="addDataModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.events.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Event</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="event_date" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" class="form-control" name="location" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Event -->
        <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="edit_id" name="id">
                            <div class="mb-3">
                                <label class="form-label">Nama Event</label>
                                <input type="text" class="form-control" id="edit_title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="edit_date" name="event_date" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="edit_location" name="location" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function openEditModal(event) {
        document.getElementById("edit_id").value = event.id;
        document.getElementById("edit_title").value = event.title;
        document.getElementById("edit_date").value = event.event_date;
        document.getElementById("edit_location").value = event.location;
        document.getElementById("editForm").action = "/admin/events/" + event.id;
        new bootstrap.Modal(document.getElementById("editModal")).show();
    }

    document.getElementById("selectAll").addEventListener("click", function() {
        let checkboxes = document.querySelectorAll(".eventCheckbox");
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById("deleteSelected").addEventListener("click", function() {
        let selectedIds = [];
        document.querySelectorAll(".eventCheckbox:checked").forEach((checkbox) => {
            selectedIds.push(checkbox.value);
        });

        if (selectedIds.length === 0) {
            alert("Pilih setidaknya satu event untuk dihapus!");
            return;
        }

        if (!confirm("Apakah Anda yakin ingin menghapus event yang dipilih?")) {
            return;
        }

        fetch("{{ route('admin.events.bulkDelete') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                ids: selectedIds
            })
        }).then(response => location.reload());
    });
    </script>
</main>
@endsection