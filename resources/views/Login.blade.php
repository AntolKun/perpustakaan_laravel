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
		<style>
        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }
        .text-primary {
            text-decoration: none;
        }
    </style>
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
						<div class="col-md-8 col-lg-6 col-xxl-3">
							<div class="card mb-0">
								<div class="card-body">
									<div class="position-relative text-center my-4">
										<p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative text-bold">Selamat Datang di Perpustakaan</p>
										<p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative text-bold">SMA NEGERI 8 BANDAR LAMPUNG</p>
									</div>
									<div class="position-relative text-center my-4">
										<p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">Silahkan Login</p>
										<span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
									</div>
									<form>
										<div class="mb-3">
											<label for="exampleInputEmail1" class="form-label">Username</label>
											<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
										</div>
										<div class="mb-4">
											<label for="exampleInputPassword1" class="form-label">Password</label>
											<input type="password" class="form-control" id="exampleInputPassword1">
										</div>
										<a href="/dashboard" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</a>
										<div class="row d-flex">
											<div class="position-relative">
												<a class="text-primary fw-medium position-absolute top-50 start-0 translate-middle-y" href="#">Lupa Sandi?</a>
												<a class="text-primary fw-medium position-absolute top-50 end-0 translate-middle-y" href="/register">Buat Akun</a>
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