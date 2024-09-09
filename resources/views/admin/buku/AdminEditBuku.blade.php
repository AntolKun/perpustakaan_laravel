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
			<h4 class="mb-sm-0 font-size-18">Edit Buku</h4>
		</div>
	</div>
</div>

<div class="row justify-content-center">
	<div class="col-12 col-md-12">
		<div class="card">
			<div class="card-body">
				<form action="{{ route('bukuEdit', $buku->id) }}" method="POST" enctype="multipart/form-data">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					@csrf
					@method('PUT')
					<div class="row">
						<div class="col-md-6">
							<div class="form-group mt-4">
								<label for="judulbuku">Judul Buku</label>
								<input type="text" class="form-control" id="judulbuku" name="judulbuku" placeholder="Masukkan judul buku" value="{{ old('judulbuku', $buku->judulbuku) }}" required>
							</div>

							<div class="form-group mt-4">
								<label for="isbn">ISBN</label>
								<input type="text" class="form-control" id="isbn" name="isbn" placeholder="Masukkan ISBN" value="{{ old('isbn', $buku->isbn) }}" required>
							</div>

							<div class="form-group mt-4">
								<label for="penerbit">Penerbit</label>
								<input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Masukkan penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group mt-4">
								<label for="tahun_terbit">Tahun Terbit</label>
								<input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="Masukkan tahun terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" required>
							</div>

							<div class="form-group mt-4">
								<label for="stok">Stok</label>
								<input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan stok" value="{{ old('stok', $buku->stok) }}" required>
							</div>

							<div class="form-group mt-4">
								<label for="gambar">Gambar Buku</label>
								@if(isset($buku->gambar))
								<div>
									<img src="{{ asset('buku_photos/' . $buku->gambar) }}" alt="Gambar Buku" class="img-thumbnail" style="max-width: 200px;">
								</div>
								@endif
								<input class="form-control mt-2" type="file" id="gambar" name="gambar">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group mt-4">
								<label for="penulis">Penulis</label>
								<input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukkan nama penulis" value="{{ old('penulis', $buku->penulis) }}" required>
							</div>

							<div class="form-group mt-4">
								<label for="halaman">Jumlah Halaman</label>
								<input type="number" class="form-control" id="halaman" name="halaman" placeholder="Masukkan jumlah halaman" value="{{ old('halaman', $buku->halaman) }}" required>
							</div>
						</div>
					</div>

					<div class="col-md-12 mt-4">
						<div class="form-group">
							<label for="deskripsi">Deskripsi Buku</label>
							<textarea required id="deskripsi" name="deskripsi" class="form-control" rows="3" style="height: 173px;">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
						</div>
					</div>

					<div class="row-12 mt-4">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{ url('/adminBuku') }}" type="button" class="btn btn-danger waves-effect waves-light">Kembali</a>
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