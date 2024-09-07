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
			<h4 class="mb-sm-0 font-size-18">Lihat Admin</h4>
		</div>
	</div>
</div>

<div class="row justify-content-center">
	<div class="col-12 col-md-12">
		<div class="card">
			<div class="card-body">
				<form>
					<div class="col">
						<div class="row">
							<div class="col-md-6 mt-4">
								<div class="form-group">
									<label for="nama">Nama</label>
									<input type="text" disabled class="form-control" id="nama" name="nama" value="{{ $admin->nama }}" placeholder="Masukkan Nama">
								</div>
							</div>

							<div class="col-md-6 mt-4">
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" disabled class="form-control" id="username" name="username" value="{{ $admin->username }}" placeholder="Masukkan Username">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 mt-4">
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" disabled class="form-control" id="email" name="email" value="{{ $admin->email }}" placeholder="Masukkan Email">
								</div>
							</div>

							<div class="col-md-6 mt-4">
								<div class="form-group">
									<label for="foto">Foto</label>
									@if($admin->foto)
									<img src="{{ asset('admin_photos/' . $admin->foto) }}" alt="Admin Photo" class="img-fluid">
									@else
									<p>No photo available</p>
									@endif
								</div>
							</div>
						</div>

						<!-- <div class="col-md-12 mt-4">
								<div class="form-group">
									<label class="form-label">Password</label>
									<div class="input-group auth-pass-inputgroup">
										<input type="password" disabled class="form-control" name="password" value="{{ $admin->password_placeholder }}" placeholder="Enter password" aria-label="Password">
										<button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
									</div>
								</div>
							</div> -->

						<div class="row-12 mt-4">
							<a type="button" class="btn btn-success waves-effect waves-light" href="/adminData">Kembali</a>
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