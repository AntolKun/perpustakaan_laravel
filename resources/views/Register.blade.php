<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 Oct 2023 01:42:11 GMT -->
<head>
		<!--  Title -->
		<title>Perpustakaan SMAN 8 Bandar Lampung</title>
		<!--  Required Meta Tag -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="handheldfriendly" content="true" />
		<meta name="MobileOptimized" content="width" />
		<meta name="description" content="Web Perpustakaan SMA Negeri 8 Bandar Lampung" />
		<meta name="author" content="" />
		<meta name="keywords" content="Mordenize" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<!--  Favicon -->
		<link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
		<!-- Core Css -->
		<link  id="themeColors"  rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}" />
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader">
			<img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
		</div>
		<!-- Preloader -->
		<div class="preloader">
			<img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
		</div>
		<!--  Body Wrapper -->
		<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
			<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
				<div class="d-flex align-items-center justify-content-center w-100">
					<div class="row justify-content-center w-100">
						<div class="col-md-6 col-lg-6 col-xxl-6">
							<div class="card mb-0">
								<div class="card-body">
									<div class="position-relative text-center my-4">'
										<h1 class="mb-5">Silahkan Daftar Akun</h1>
									</div>
									<form>
										<div class="row d-flex">
											<div class="col">
												<div class="mb-3">
													<label for="username" class="form-label">Username</label>
													<input type="text" class="form-control" id="username" aria-describedby="input username">
												</div>
											</div>
											<div class="col">
												<div class="mb-4">
													<label for="email" class="form-label">Email</label>
													<input type="email" class="form-control" id="email">
												</div>
											</div>
										</div>

										<div class="row d-flex">
											<div class="col">
												<div class="mb-3">
													<label for="nisn" class="form-label">NISN</label>
													<input type="number" class="form-control" id="nisn" aria-describedby="input email">
												</div>
											</div>
											<div class="col">
												<div class="mb-4">
													<label for="kelas" class="form-label">Kelas</label>
													<input type="text" class="form-control" id="kelas">
												</div>
											</div>
										</div>

										<div class="row d-flex">
											<div class="col">
												<div class="mb-3">
													<label for="password" class="form-label">Password</label>
													<input type="password" class="form-control" id="password" aria-describedby="input password">
												</div>
											</div>
											<div class="col">
												<div class="mb-4">
													<label for="password" class="form-label">Konfirmasi Password</label>
													<input type="password" class="form-control" id="password">
												</div>
											</div>
										</div>

										<a href="/login" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Daftar</a>
										<div class="row d-flex">
											<div class="position-relative">
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
	</body>
</html>