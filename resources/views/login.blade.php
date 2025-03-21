<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4 rounded" style="width: 400px;">
            <h3 class="text-center fw-bold mb-3">Login</h3>

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
            </form>

            <div class="text-center mt-3">
                <p>Belum punya akun? <a href="{{ route('register') }}" class="fw-bold text-primary">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>