@extends('layouts.UserTemplate')
@section('content')

<div class="col-lg-12 d-flex align-items-stretch">
	<div class="card w-80">
		<div class="card-body p-4 bg-primary">
			<h5 class="card-title fw-semibold">Rekomendasi</h5>
			<div class="owl-carousel collectibles-carousel owl-theme mt-9">
				<div class="item">
					<div class="card overflow-hidden mb-4 mb-md-0 shadow-none">
						<div class="position-relative">
							<img src="{{ asset('dist/images/nft/1.jpg') }}" class="img-fluid w-100" alt="1" />
						</div>
						<div class="text-center pt-9 px-4">
							<h5>Loneliness is my best friend</h5>
							<p class="mt-4">Muhammad Riski</p>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="card overflow-hidden mb-4 mb-md-0 shadow-none">
						<div class="position-relative">
							<img src="{{ asset('dist/images/nft/5.jpg') }}" class="img-fluid w-100" alt="1" />
						</div>
						<div class="text-center pt-9 px-4">
							<h5>Loneliness is my best friend</h5>
							<p class="mt-4">Muhammad Riski</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12 d-flex align-items-stretch">
	<div class="card w-80">
		<div class="card-body p-4 bg-primary">
			<div class="container">
				<div class="row">
					<div class="col">
						<h5>Kategori</h5>
					</div>
					<div class="col"></div>
					<div class="col"></div>
					<div class="col"></div>
					<div class="col">
						<div class="btn-group mb-2" role="group" aria-label="Basic example">
							<button type="button" class="btn btn-light-primary text-primary font-medium">
								Left
							</button>
							<button type="button" class="btn btn-light-primary text-primary font-medium">
								Middle
							</button>
							<button type="button" class="btn btn-light-primary text-primary font-medium">
								Right
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-lg-3 col-md-6">
					<!-- Card -->
					<div class="card">
						<img class="card-img-top img-responsive" src="../../dist/images/big/img1.jpg" alt="Card image cap" />
						<div class="card-body">
							<h4 class="card-title">Card title</h4>
							<p class="card-text">
								Some quick example text to build on the card title and make up the bulk of the card's content.
							</p>
							<a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
						</div>
					</div>
					<!-- Card -->
				</div>
				<div class="col-lg-3 col-md-6">
					<!-- Card -->
					<div class="card">
						<img class="card-img-top img-responsive" src="../../dist/images/big/img1.jpg" alt="Card image cap" />
						<div class="card-body">
							<h4 class="card-title">Card title</h4>
							<p class="card-text">
								Some quick example text to build on the card title and make up the bulk of the card's content.
							</p>
							<a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
						</div>
					</div>
					<!-- Card -->
				</div>
				<div class="col-lg-3 col-md-6">
					<!-- Card -->
					<div class="card">
						<img class="card-img-top img-responsive" src="../../dist/images/big/img1.jpg" alt="Card image cap" />
						<div class="card-body">
							<h4 class="card-title">Card title</h4>
							<p class="card-text">
								Some quick example text to build on the card title and make up the bulk of the card's content.
							</p>
							<a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
						</div>
					</div>
					<!-- Card -->
				</div>
				<div class="col-lg-3 col-md-6">
					<!-- Card -->
					<div class="card">
						<img class="card-img-top img-responsive" src="../../dist/images/big/img1.jpg" alt="Card image cap" />
						<div class="card-body">
							<h4 class="card-title">Card title</h4>
							<p class="card-text">
								Some quick example text to build on the card title and make up the bulk of the card's content.
							</p>
							<a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
						</div>
					</div>
					<!-- Card -->
				</div>
				<div class="col-lg-3 col-md-6">
					<!-- Card -->
					<div class="card">
						<img class="card-img-top img-responsive" src="../../dist/images/big/img1.jpg" alt="Card image cap" />
						<div class="card-body">
							<h4 class="card-title">Card title</h4>
							<p class="card-text">
								Some quick example text to build on the card title and make up the bulk of the card's content.
							</p>
							<a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
						</div>
					</div>
					<!-- Card -->
				</div>
				<div class="col-lg-3 col-md-6">
					<!-- Card -->
					<div class="card">
						<img class="card-img-top img-responsive" src="../../dist/images/big/img1.jpg" alt="Card image cap" />
						<div class="card-body">
							<h4 class="card-title">Card title</h4>
							<p class="card-text">
								Some quick example text to build on the card title and make up the bulk of the card's content.
							</p>
							<a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
						</div>
					</div>
					<!-- Card -->
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($message = session()->get('success'))
<script type="text/javascript">
	Swal.fire({
		icon: "success",
		title: "Sukses!",
		text: "{{ $message }}",
	});
</script>
@endif @if ($message = session()->get('error'))
<script type="text/javascript">
	Swal.fire({
		icon: "error",
		title: "Waduh!",
		text: "{{ $message }}",
	});
</script>

@endif
@endsection