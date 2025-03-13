@extends('admin.master')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tabel Event Gallery</h3>
                </div>
                <div class="col-sm-6 d-flex justify-content-end gap-3">
                    <button class="btn btn-danger" id="deleteSelected">Hapus Terpilih</button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGalleryModal">
                        Tambah Gambar
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
                            <h3 class="card-title">Daftar Gambar Event</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>No</th>
                                        <th>Event</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($galleries as $index => $gallery)
                                    <tr>
                                        <td><input type="checkbox" class="galleryCheckbox" value="{{ $gallery->id }}">
                                        </td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $gallery->event->title }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $gallery->image_url) }}"
                                                class="img-thumbnail" width="150">
                                        </td>
                                        <td>
                                            <!-- <button class="btn btn-warning btn-sm"
                                                onclick="openEditModal({{ json_encode($gallery) }})">Edit</button> -->
                                            <form action="{{ route('admin.event_gallery.destroy', $gallery->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus gambar ini?')">Hapus</button>
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

        <!-- Modal Tambah Gambar -->
        <div class="modal fade" id="addGalleryModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Gambar Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.event_gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Event</label>
                                <select name="event_id" class="form-control" required>
                                    @foreach(App\Models\Event::all() as $event)
                                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Gambar</label>
                                <input type="file" class="form-control" name="image" accept="image/*" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Gambar -->
        <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Gambar Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="edit_id" name="id">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Event</label>
                                    <select id="edit_event_id" name="event_id" class="form-control" required>

                                        @foreach(App\Models\Event::all() as $event)
                                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload Gambar Baru</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
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
    // function openEditModal(gallery) {
    //     let editForm = document.getElementById("editForm");

    //     if (!editForm) {
    //         console.error("Form edit tidak ditemukan!");
    //         return;
    //     }

    //     editForm.action = "/admin/event-gallery/" + gallery.id; // Set action ke URL yang benar
    //     document.getElementById("edit_id").value = gallery.id;
    //     document.querySelector("[name='event_id']").value = gallery.event_id;

    //     new bootstrap.Modal(document.getElementById("editModal")).show();
    // }


    document.getElementById("selectAll").addEventListener("click", function() {
        let checkboxes = document.querySelectorAll(".galleryCheckbox");
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById("deleteSelected").addEventListener("click", function() {
        let selectedIds = [];
        document.querySelectorAll(".galleryCheckbox:checked").forEach((checkbox) => {
            selectedIds.push(checkbox.value);
        });

        if (selectedIds.length === 0) {
            alert("Pilih setidaknya satu gambar untuk dihapus!");
            return;
        }

        if (!confirm("Apakah Anda yakin ingin menghapus gambar yang dipilih?")) {
            return;
        }

        fetch("{{ route('admin.gallery.bulkDelete') }}", {
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