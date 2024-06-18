@extends('layouts.AdminTemplate')
@section('content')

<div class="row">
	<!-- Column -->
	<div class="col-lg-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex flex-row align-items-center">
					<div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
						<i class="ti ti-credit-card fs-6"></i>
					</div>
					<div class="ms-3 align-self-center">
						<h3 class="mb-0 fs-6">21</h3>
						<span class="text-muted">Data Admin</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
	<!-- Column -->
	<div class="col-lg-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex flex-row align-items-center">
					<div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-info">
						<i class="ti ti-users fs-6"></i>
					</div>
					<div class="ms-3 align-self-center">
						<h3 class="mb-0 fs-6">2690</h3>
						<span class="text-muted">Data Buku</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
	<!-- Column -->
	<div class="col-lg-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex flex-row align-items-center">
					<div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-danger">
						<i class="ti ti-calendar fs-6"></i>
					</div>
					<div class="ms-3 align-self-center">
						<h3 class="mb-0 fs-6">19</h3>
						<span class="text-muted">Peminjaman Buku</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
	<!-- Column -->
	<div class="col-lg-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex flex-row align-items-center">
					<div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
						<i class="ti ti-settings fs-6"></i>
					</div>
					<div class="ms-3 align-self-center">
						<h3 class="mb-0 fs-6">13</h3>
						<span class="text-muted">Pengembalian Buku</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
	<!-- Column -->
	<div class="col-lg-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex flex-row align-items-center">
					<div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
						<i class="ti ti-settings fs-6"></i>
					</div>
					<div class="ms-3 align-self-center">
						<h3 class="mb-0 fs-6">17</h3>
						<span class="text-muted">Lomba Literasi</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
	<!-- Column -->
	<div class="col-lg-3 col-md-6">
		<div class="card">
			<div class="card-body">
				<div class="d-flex flex-row align-items-center">
					<div class="ms-3 align-self-center">
						<h6 class="text-muted">Syarat Dan Ketentuan Peminjaman</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
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