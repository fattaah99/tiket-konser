@extends('admin.master')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tabel Users</h3>
                </div>
                <div class="col-sm-6 d-flex justify-content-end gap-3">
                    <input type="text" id="searchBox" class="form-control" style="max-width: 300px;"
                        placeholder="Search..." onkeyup="filterTable()">

                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">
                        Tambah User
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
                            <h3 class="card-title">Daftar Users</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>No</th>

                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $index => $user)
                                    <tr>
                                        <td><input type="checkbox" class="userCheckbox" value="{{ $user->id }}"></td>
                                        <td>{{ $index + 1 }}</td>

                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm"
                                                onclick="openEditModal({{ $user }})">Edit</button>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus user ini?')">Hapus</button>
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

        <!-- Modal Tambah User -->
        <div class="modal fade" id="addDataModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit User -->
        <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="edit_id" name="id">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" id="edit_phone" name="phone">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" id="edit_password" name="password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" id="edit_address" name="address">
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
    function openEditModal(user) {
        document.getElementById("edit_id").value = user.id;
        document.getElementById("edit_name").value = user.name;
        document.getElementById("edit_email").value = user.email;
        document.getElementById("edit_phone").value = user.phone;
        document.getElementById("edit_password").value = user.password;
        document.getElementById("edit_address").value = user.address;
        document.getElementById("editForm").action = "/admin/users/" + user.id;
        new bootstrap.Modal(document.getElementById("editModal")).show();
    }

    document.getElementById("selectAll").addEventListener("click", function() {
        let checkboxes = document.querySelectorAll(".userCheckbox");
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });



    document.getElementById("deleteSelected").addEventListener("click", function() {
        let selectedIds = [];
        document.querySelectorAll(".userCheckbox:checked").forEach((checkbox) => {
            selectedIds.push(checkbox.value);
        });

        if (selectedIds.length === 0) {
            alert("Pilih setidaknya satu user untuk dihapus!");
            return;
        }

        if (!confirm("Apakah Anda yakin ingin menghapus user yang dipilih?")) {
            return;
        }

        fetch("{{ route('admin.users.bulkDelete') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    ids: selectedIds
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("User berhasil dihapus!");
                    location.reload(); // Refresh halaman setelah hapus
                } else {
                    scriptert("Terjadi kesalahan saat menghapus user.");
                }
            })
            .catch(error => console.error("Error:", error));
    });
    </script>

</main>
@endsection