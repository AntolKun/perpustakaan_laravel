@extends('layouts.AdminTemplate')

@section('css')
<link href="{{ asset('skoteassets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ asset('skoteassets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('skoteassets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ asset('skoteassets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('skoteassets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('skoteassets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('content')

<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">Tambah Admin</h4>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-12 col-md-12">
			<div class="card">
				<div class="card-body">
					<form action="{{ url('/adminStore') }}" method="POST" enctype="multipart/form-data">
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif
						{{ csrf_field() }}

						<!-- Nama -->
						<div class="col">
							<div class="row">
								<div class="col-md-6 mt-4">
									<div class="form-group">
										<label for="nama">Nama</label>
										<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
									</div>
								</div>

								<div class="col-md-6 mt-4">
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6 mt-4">
									<div class="form-group">
										<label for="password">Kata Sandi</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
									</div>
								</div>

								<div class="col-md-6 mt-4">
									<div class="form-group">
										<label for="password_confirmation">Konfirmasi Kata Sandi</label>
										<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
									</div>
								</div>
							</div>
							<!-- Role (Dropdown) -->
							<div class="row">
								<div class="col-md-6 mt-4">
									<div class="form-group">
										<label for="role">Role</label>
										<select class="form-control" id="role" name="role" required>
											<option value="">Pilih Role</option>
											<option value="Admin">Admin</option>
											<option value="Pustakawan">Pustakawan</option>
											<option value="Juri">Juri</option>
										</select>
									</div>
								</div>

								<!-- Foto -->
								<div class="col-md-6 mt-4">
									<div class="form-group">
										<label for="foto">Foto</label>
										<input type="file" class="form-control" id="foto" name="foto">
									</div>
								</div>
							</div>

							<!-- Tombol Submit -->
							<div class="row-12 mt-4">
								<button type="submit" class="btn btn-primary">Tambah</button>
								<a href="/adminData" type="button" class="btn btn-danger waves-effect waves-light">Kembali</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	@section('js')
	<!-- Required datatable js -->
	<script src="{{ asset('skoteassets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('skoteassets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<!-- Buttons examples -->
	<script src="{{ asset('skoteassets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('skoteassets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('skoteassets/libs/jszip/jszip.min.js') }}"></script>
	<script src="{{ asset('skoteassets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
	<script src="{{ asset('skoteassets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
	<script src="{{ asset('skoteassets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('skoteassets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('skoteassets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

	<!-- Responsive examples -->
	<script src="{{ asset('skoteassets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('skoteassets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

	<!-- Datatable init js -->
	<script src="{{ asset('skoteassets/js/pages/datatables.init.js') }}"></script>
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

	@stop

	@endsection