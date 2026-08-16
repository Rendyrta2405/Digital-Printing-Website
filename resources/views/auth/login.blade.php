<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin · {{ $site->site_name ?? 'Toko Percetakan' }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-body">

  <div style="width:100%;max-width:420px">
    <div class="card border-0 shadow-lg login-card">
      <div class="card-body p-4 p-md-5">
        <div class="text-center mb-4">
          <div class="brand-dots d-flex justify-content-center mb-2"><i></i><i></i><i></i><i></i></div>
          <h1 class="h4 fw-extrabold">Masuk Admin Panel</h1>
          <p class="text-muted small mb-0">Kelola produk, pesanan, dan pengaturan toko.</p>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <label class="form-label fw-bold small">Email</label>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" class="form-control" 
               value="{{ old('email', 'admin@digitalprinting.com') }}" required autofocus>
          </div>

          <label class="form-label fw-bold small">Password</label>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" class="form-control" required
               value="password">
          </div>

          <div class="form-check mb-4">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label small" for="remember">Ingat saya</label>
          </div>

          <button class="btn btn-wa w-100">Masuk <i class="bi bi-arrow-right"></i></button>
        </form>
      </div>
    </div>

    <p class="text-center mt-3 mb-0">
      <a href="{{ route('home') }}" class="text-decoration-none small" style="color:rgba(255,255,255,.9)">
        <i class="bi bi-arrow-left"></i> Kembali ke website
      </a>
    </p>
  </div>

</body>
</html>