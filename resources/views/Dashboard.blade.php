@extends('layouts.UserTemplate')
@section('content')

<div class="col-lg-12 d-flex align-items-stretch">
	<div class="card w-100">
		<div class="card-body p-4 bg-primary">
			<h5 class="card-title fw-semibold text-white">Rekomendasi</h5>
			<div class="owl-carousel collectibles-carousel owl-theme">
				@foreach ($buku as $b)
				<div class="item">
					<div class="card overflow-hidden shadow-sm d-flex flex-column">
						<div class="position-relative">
							<img src="{{ asset('buku_photos/' . $b->gambar) }}" class="img-fluid" alt="Book Image" style="height: 350px; object-fit: cover;" />
						</div>
						<div class="d-flex flex-column flex-grow-1">
							<div class="text-center p-3 flex-grow-1 d-flex flex-column justify-content-between">
								<h5 class="card-title mb-2" style="overflow: hidden; white-space: nowrap;">{{ $b->judulbuku }}</h5>
								<p class="card-text mb-0" style="overflow: hidden; white-space: nowrap;">{{ $b->penulis }}</p>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>


<div class="col-lg-12 d-flex align-items-stretch">
	<div class="card w-100">
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

			<div class="row">
				@foreach ($buku as $b)
				<div class="col-lg-3 col-md-6 mt-4">
					<!-- Card -->
					<div class="card h-100 d-flex flex-column">
						<img class="card-img-top img-fluid d-block w-100" src="{{ asset('buku_photos/' . $b->gambar) }}" alt="Card image cap" style="height: 200px; object-fit: cover;" />
						<div class="card-body flex-grow-1 d-flex flex-column">
							<h4 class="card-title">{{ $b->judulbuku }}</h4>
							<p class="card-text flex-grow-1">
								{{ Str::limit($b->deskripsi, 50) }}
							</p>
							<button class="btn btn-primary mt-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#bukuSidebar{{ $b->id }}" aria-controls="bukuSidebar{{ $b->id }}">Lihat Detail</button>
						</div>
					</div>
				</div>

				<!-- Sidebar -->
				<div class="offcanvas offcanvas-end" tabindex="-1" id="bukuSidebar{{ $b->id }}" aria-labelledby="bukuSidebarLabel{{ $b->id }}" style="width: 400px;">
					<div class=" offcanvas-header">
						<h5 class="offcanvas-title" id="bukuSidebarLabel{{ $b->id }}"></h5>
						<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body text-center">
						<img src="{{ asset('buku_photos/' . $b->gambar) }}" class="img-fluid mb-3" alt="{{ $b->judulbuku }}">
						<h3 class="fw-bold">{{ $b->judulbuku }}</h3>
						<h5 class="mt-4">{{ $b->penulis }}</h5>
						<p class="mt-4">{{ $b->deskripsi }}</p>
						<a href="{{ route('buku.show', $b->id) }}" class="btn btn-info mt-4">Lihat Detail</a>
					</div>
				</div>
				@endforeach
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