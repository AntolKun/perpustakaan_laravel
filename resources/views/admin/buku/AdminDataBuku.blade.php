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
			<h4 class="mb-sm-0 font-size-18">Data Buku</h4>
			<div>
				<a type="button" class="btn btn-primary waves-effect waves-light" href="/tambahBuku">
					<i class="bx bx-plus font-size-16 align-middle me-2"></i>Tambah Buku</a>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="table-responsive">
			<table table id="datatable" class="display table table-bordered" style="width:100%; border: 2px solid #3751CF;">
				<thead style="background-color: #3751CF; color: white; text-align: center;">
					<tr>
						<th>Judul Buku</th>
						<th>Kategori</th>
						<th>ISBN</th>
						<th>Penerbit</th>
						<th>Tahun Terbit</th>
						<th>Stok</th>
						<th>Sinopsis</th>
						<th>Foto Buku</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($buku as $b)
					<tr>
						<td>{{ $b->judulbuku }}</td>
						<td>{{ $b->kategori->nama_kategori ?? 'Tidak ada kategori' }}</td>
						<td>{{ $b->isbn }}</td>
						<td>{{ $b->penerbit }}</td>
						<td>{{ $b->tahun_terbit }}</td>
						<td>{{ $b->stok }}</td>
						<td>{{ Str::limit($b->deskripsi, 200, '...') }}</td>
						<td>
							@if($b->gambar)
							<img src="{{ asset('buku_photos/' . $b->gambar) }}" alt="{{ $b->nama }}" width="100" height="100">
							@else
							No Photo
							@endif
						</td>
						<td>
							<div class="col-4">
								<a type="button" class="btn btn-warning waves-effect waves-light" href="/adminLihatBuku/{{ $b->id }}">Lihat</a>
							</div>
							<div class="col-4">
								<a type="button" class="btn btn-primary waves-effect waves-light" href="/getBukuEdit/{{ $b->id }}">Edit</a>
							</div>
							<div class="col-4">
								<form action="{{ url('/bukuDelete') }}/{{ $b->id }}" method="POST">
									@csrf
									@method("DELETE")
									<button type="submit" class="btn btn-danger waves-effect waves-light">Hapus</button>
								</form>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
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