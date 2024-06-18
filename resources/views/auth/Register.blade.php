<!DOCTYPE html>
<html lang="en">
<head>
		<!--  Title -->
		<title>Perpustakaan SMAN 8 Bandar Lampung</title>
		<!--  Required Meta Tag -->
		<style>
        .left-logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 100px; /* Adjust as needed */
            height: auto;
        }
    </style>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="handheldfriendly" content="true" />
		<meta name="MobileOptimized" content="width" />
		<meta name="description" content="Web Perpustakaan SMA Negeri 8 Bandar Lampung" />
		<meta name="author" content="" />
		<meta name="keywords" content="Mordenize" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<!--  Favicon -->
		<link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logosma.png') }}" />
		<!-- Core Css -->
		<link  id="themeColors"  rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}" />
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader">
			<img src="{{ asset('assets/images/logosma.png') }}" alt="loader" class="lds-ripple img-fluid" />
		</div>
		<!-- Preloader -->
		<div class="preloader">
			<img src="{{ asset('assets/images/logosma.png') }}" alt="loader" class="lds-ripple img-fluid" />
		</div>
		<!--  Body Wrapper -->
		<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
			<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('assets/images/bglogin.png') }}'); background-size: cover; background-position: center;">
				<img src="{{ asset('assets/images/logosma.png') }}" alt="Logo SMA" class="left-logo">
				<div class="d-flex align-items-center justify-content-center w-100">
					<div class="row justify-content-center w-100">
						<div class="col-md-6 col-lg-6 col-xxl-6">
							<div class="card mb-0">
								<div class="card-body">
									<div class="position-relative text-center my-4">
										<h1 class="mb-5">Silahkan Daftar Akun</h1>
									</div>
									<form action="{{ url('/post-register') }}" method="POST" enctype="multipart/form-data">
										{{ csrf_field() }}
										<div class="row d-flex">
											<div class="col">
												<div class="mb-3">
													<label for="username" class="form-label">Username</label>
													<input type="text" name="username" class="form-control" id="username" aria-describedby="input username" required>
												</div>
											</div>
											<div class="col">
												<div class="mb-4">
													<label for="email" class="form-label">Email</label>
													<input type="email" name="email" class="form-control" id="email" required>
												</div>
											</div>
										</div>

										<div class="row d-flex">
											<div class="col">
												<div class="mb-3">
													<label for="nisn" class="form-label">NISN</label>
													<input type="number" name="nisn" class="form-control" id="nisn" aria-describedby="input email" required>
												</div>
											</div>
											<div class="col">
												<div class="mb-4">
													<label for="kelas" class="form-label">Kelas</label>
													<input type="text" name="kelas" class="form-control" id="kelas" required>
												</div>
											</div>
										</div>

										<div class="row d-flex">
											<div class="col">
												<div class="mb-3">
													<label for="password" class="form-label">Password</label>
													<input type="password" name="password" class="form-control" id="password" aria-describedby="input password" required>
												</div>
											</div>
											<div class="col">
												<div class="mb-4">
													<label for="password_confirmation" class="form-label">Konfirmasi Password</label>
													<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
												</div>
											</div>
										</div>

										<button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2" type="submit">Daftar</button>
										<div class="row d-flex">
											<div class="position-relative mt-3">
												<a class="text-primary fw-medium position-absolute top-50 start-0 translate-middle-y" href="#">Lupa Sandi?</a>
												<a class="text-primary fw-medium position-absolute top-50 end-0 translate-middle-y" href="/login">Login</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!--  Import Js Files -->
		<script src="{{ asset('dist/libs/jquery/dist/jquery.min.js') }}"></script>
		<script src="{{ asset('dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
		<script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
		<!--  core files -->
		<script src="{{ asset('dist/js/app.min.js') }}"></script>
		<script src="{{ asset('dist/js/app.init.js') }}"></script>
		<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
		<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
		
		<script src="{{ asset('dist/js/custom.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		@if ($message = session()->get('success'))
		<script type="text/javascript">
			Swal.fire({
				icon: 'success',
				title: 'Sukses!',
				text: '{{ $message }}',
			})
		</script>
		@endif

		@if ($message = session()->get('error'))
		<script type="text/javascript">
			Swal.fire({
				icon: 'error',
				title: 'Waduh!',
				text: '{{ $message }}',
			})
		</script>
		@endif
	</body>
</html>