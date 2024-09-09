<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Perpustakaan SMAN 8</title>
	<!-- Bootstrap CDN -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
	<style>
		body {
			background-color: #f4f4f4;
		}

		.sidebar {
			background-color: #003399;
			height: 100vh;
			padding-top: 20px;
			color: white;
			position: fixed;
			/* Sidebar tetap di posisi saat di-scroll */
			top: 0;
			left: 0;
			width: 16.666667%;
			/* Sesuaikan dengan ukuran col-md-2 */
		}

		.sidebar a {
			color: white;
			text-decoration: none;
			display: block;
			padding: 15px 20px;
			border-radius: 8px;
			margin-bottom: 10px;
		}

		.sidebar a:hover {
			background-color: #ffcc00;
		}

		.navbar-custom {
			background-color: #003399;
			padding: 10px;
			position: fixed;
			/* Header tetap di posisi saat di-scroll */
			top: 0;
			left: 16.666667%;
			/* Posisi mulai setelah sidebar */
			width: 83.333333%;
			/* Sesuaikan agar full ke kanan */
			z-index: 1000;
		}

		.navbar-custom .navbar-brand,
		.navbar-custom .navbar-text {
			color: white;
		}

		.card-custom {
			border: none;
		}

		.card-custom img {
			border-radius: 10px;
		}

		.main-content {
			margin-left: 16.666667%;
			/* Sama dengan ukuran sidebar */
			padding-top: 70px;
			/* Sesuaikan dengan tinggi header */
		}

		.sidebar {
			background-color: #003399;
			height: 100vh;
			padding-top: 20px;
			color: white;
			position: fixed;
			/* Sidebar tetap ketika scroll */
		}

		.sidebar img {
			border-radius: 50%;
			border: 2px solid white;
		}

		.sidebar h5 {
			margin-bottom: 20px;
			font-size: 1.2rem;
		}

		.sidebar .nav {
			width: 100%;
			text-align: left;
		}

		.sidebar .nav-item {
			margin-bottom: 10px;
		}

		.sidebar .nav-link {
			color: white;
			padding: 10px 20px;
			border-radius: 10px;
			font-size: 1.1rem;
			transition: background-color 0.3s, box-shadow 0.3s;
		}

		.sidebar .nav-link:hover {
			background-color: #ffcc00;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.sidebar .nav-link.active {
			background-color: #ffcc00;
			color: #000000;
			font-weight: bold;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
		}

		.sidebar .nav-link i {
			margin-right: 10px;
			font-size: 1.2rem;
		}

		.button-logout {
			position: absolute;
			bottom: 0;
			width: 90%;
			background-color: #d9534f;
			color: white;
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<!-- Sidebar -->
			<div class="col-md-2 sidebar text-center">
				<img src="{{ asset('assets/images/logosma.png') }}" alt="Logo" class="img-fluid mb-3" style="max-width: 150px;">
				<h5 class="text-white">Perpustakaan SMAN 8 Bandar Lampung</h5>

				<ul class="nav flex-column mt-4">
					<li class="nav-item">
						<a href="#" class="nav-link active">
							<i class="bi bi-house-door"></i> Beranda
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="bi bi-book"></i> Peminjaman
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="bi bi-arrow-counterclockwise"></i> Pengembalian
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="bi bi-trophy"></i> Lomba Literasi
						</a>
					</li>
				</ul>

				<a href="#" class="nav-link text-danger bg-danger text-white button-logout">
					<i class="bi bi-box-arrow-right"></i> Logout
				</a>
			</div>

			<!-- Main Content -->
			<div class="col-md-10 main-content">
				<!-- Navbar -->
				<nav class="navbar navbar-custom">
					<div class="container-fluid">
						<form class="d-flex w-50">
							<input class="form-control me-2" type="search" placeholder="Cari Buku" aria-label="Search">
							<button class="btn btn-outline-light" type="submit">Search</button>
						</form>
						<div class="d-flex align-items-center">
							<i class="bi bi-bell text-white me-3" style="font-size: 24px;"></i>
							<div class="d-flex align-items-center">
								<img src="https://64.media.tumblr.com/2d34d3c454d089b227902151c8c7847f/0db45671e0bd9366-c5/s1280x1920/4cd0a4cbe3bd869a889912b69ed52141bcd03096.png" alt="User" class="rounded-circle" width="40" height="40">
								<span class="text-white ms-2">Najib Wiharjanto</span>
							</div>
						</div>
					</div>
				</nav>

				<div class="container mt-5">
					<!-- Rekomendasi Section -->
					<div class="row mb-4">
						<div class="col-lg-12 d-flex align-items-stretch">
							<div class="card w-100">
								<div class="card-body p-4" style="background-color: #007bff;">
									<h5 class="card-title fw-semibold" style="color: white;">Rekomendasi</h5>
									<div class="owl-carousel collectibles-carousel owl-theme mt-4">
										<!-- Item 1 -->
										<div class="item">
											<div class="card overflow-hidden shadow-none" style="border: none;">
												<div class="position-relative">
													<img src="https://via.placeholder.com/200x200" class="img-fluid w-100" alt="1" />
												</div>
												<div class="text-center pt-4 px-4">
													<h6 style="color: black;">Loneliness is my best friend</h6>
													<p class="mt-2" style="color: black;">Muhammad Riski</p>
												</div>
											</div>
										</div>
										<!-- Item 2 -->
										<div class="item">
											<div class="card overflow-hidden shadow-none" style="border: none;">
												<div class="position-relative">
													<img src="https://via.placeholder.com/200x200" class="img-fluid w-100" alt="2" />
												</div>
												<div class="text-center pt-4 px-4">
													<h6 style="color: black;">The Sun Will Rise</h6>
													<p class="mt-2" style="color: black;">Ariana</p>
												</div>
											</div>
										</div>
										<!-- Add more items as needed -->
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Kategori Section -->
					<div class="row">
						<div class="col-lg-12 d-flex align-items-stretch">
							<div class="card w-100">
								<div class="card-body p-4" style="background-color: #007bff;">
									<div class="container">
										<div class="row">
											<div class="col">
												<h5 style="color: white;">Kategori</h5>
											</div>
											<div class="col"></div>
											<div class="col"></div>
											<div class="col"></div>
											<div class="col">
												<div class="btn-group mb-2" role="group" aria-label="Kategori Navigation">
													<button type="button" class="btn" style="background-color: #e0f7fa; color: #007bff; border: none;">Left</button>
													<button type="button" class="btn" style="background-color: #e0f7fa; color: #007bff; border: none;">Middle</button>
													<button type="button" class="btn" style="background-color: #e0f7fa; color: #007bff; border: none;">Right</button>
												</div>
											</div>
										</div>
									</div>
									<div class="row mt-4">
										<!-- Card Kategori 1 -->
										<div class="col-lg-3 col-md-6 mb-4">
											<div class="card">
												<img class="card-img-top img-responsive" src="https://via.placeholder.com/200x200" alt="Card image cap" />
												<div class="card-body" style="background-color: white;">
													<h4 class="card-title" style="color: black;">Card title 1</h4>
													<p class="card-text" style="color: black;">
														Some quick example text to build on the card title and make up the bulk of the card's content.
													</p>
													<a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
												</div>
											</div>
										</div>
										<!-- Card Kategori 2 -->
										<div class="col-lg-3 col-md-6 mb-4">
											<div class="card">
												<img class="card-img-top img-responsive" src="https://via.placeholder.com/200x200" alt="Card image cap" />
												<div class="card-body" style="background-color: white;">
													<h4 class="card-title" style="color: black;">Card title 2</h4>
													<p class="card-text" style="color: black;">
														Some quick example text to build on the card title and make up the bulk of the card's content.
													</p>
													<a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
												</div>
											</div>
										</div>
										<!-- Add more cards as needed -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
	</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

	<!-- Owl Carousel JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

	<script>
		$(document).ready(function() {
			$(".owl-carousel").owlCarousel({
				loop: true,
				margin: 10,
				nav: true,
				dots: true,
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 2
					},
					1000: {
						items: 3
					}
				}
			});
		});
	</script>
</body>

</html>