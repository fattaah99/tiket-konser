@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('auth_body')
@if(session('success'))
<div class="card card-success">
    <div class="card-header text-center">
        <h3 class="card-title">Pendaftaran Berhasil</h3>
    </div>
    <div class="card-body text-center">
        <p>{{ session('success') }}</p>
        <a href="{{ route('login') }}" class="btn btn-primary btn-block">Login Sekarang</a>
    </div>
</div>
@else
<form action="{{ route('register.post') }}" method="POST">
    @csrf
    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
    </div>

    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>

    <div class="input-group mb-3">
        <input type="text" name="phone" class="form-control" placeholder="Nomor Telepon" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-phone"></span>
            </div>
        </div>
    </div>

    <div class="input-group mb-3">
        <textarea name="address" class="form-control" placeholder="Alamat Lengkap" required></textarea>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-map-marker-alt"></span>
            </div>
        </div>
    </div>

    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>

    <div class="input-group mb-3">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password"
            required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
</form>

<div class="text-center mt-3">
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
</div>
@endif
@endsection