<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Title -->
  <title>Admin Login - Perpustakaan SMAN 8 Bandar Lampung</title>
  <!-- Meta tags, stylesheets, etc. -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}">
  <!-- Other required meta tags -->
</head>

<body>
  <div class="page-wrapper">
    <div class="authentication-login min-vh-100 bg-body d-flex align-items-center justify-content-center">
      <div class="col-sm-8 col-md-6 col-xl-4">
        <!-- Admin Logo -->
        <img src="{{ asset('assets/images/logosma.png') }}" alt="Admin Logo" class="img-fluid mb-4" style="max-width: 150px;">
        <!-- Admin Login Header -->
        <h2 class="mb-3 fs-7 fw-bolder text-center">Admin Login - Perpustakaan SMAN 8 Bandar Lampung</h2>
        <p class="text-center my-4">Silahkan Login sebagai Admin</p>
        <!-- Admin Login Form -->
        <form method="POST" action="{{ url('/admin/actionAdminLogin') }}">
          {{ csrf_field() }}
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email admin..." required>
          </div>
          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password admin..." required>
          </div>
          <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Login sebagai Admin</button>
          <a href="{{ url('/login') }}" class="text-primary">Kembali ke Halaman User Login</a>
        </form>
      </div>
    </div>
  </div>
  <!-- Required Scripts -->
  <script src="{{ asset('dist/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  @if ($message = session()->get('success'))
  <script type="text/javascript">
    Swal.fire({
      icon: 'success',
      title: 'Sukses!',
      text: '{{ $message }}',
    });
  </script>
  @endif

  @if ($message = session()->get('error'))
  <script type="text/javascript">
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: '{{ $message }}',
    });
  </script>
  @endif
</body>

</html>