@extends('layouts.AdminTemplate')

@section('css')
<!-- CSS khusus untuk halaman ini -->
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
      <h4 class="mb-sm-0 font-size-18">Data Kategori Lomba: {{ $lomba->judul }}</h4>
      <div>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
          <i class="bx bx-plus font-size-16 align-middle me-2"></i>Tambah Kategori
        </button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
      <thead style="background-color: #3751CF; color: white;">
        <tr>
          <th>Nama Kategori</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($kategoriLombas as $kategori)
        <tr>
          <td>{{ $kategori->nama_kategori }}</td>
          <td>
            <!-- Tombol Edit Kategori -->
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editKategoriModal{{ $kategori->id }}">
              Edit
            </button>

            <!-- Form Hapus Kategori -->
            <form action="{{ route('adminLomba.kategori.delete', $kategori->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form>

            <!-- Tombol Lihat Penilaian -->
            <a href="{{ route('adminPenilaian.index', $kategori->id) }}" class="btn btn-info">Lihat Penilaian</a>
            <a href="{{ route('adminLomba.kategori.peserta', ['lomba' => $lomba->id, 'kategori' => $kategori->id]) }}" class="btn btn-success">
              Lihat Peserta
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('adminLomba.kategori.store') }}" method="POST">
        @csrf
        <!-- Hidden input untuk lomba_id -->
        <input type="hidden" name="lomba_id" value="{{ $lomba->id }}">
        <div class="modal-header">
          <h5 class="modal-title" id="addKategoriModalLabel">Tambah Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

@foreach($kategoriLombas as $kategori)
<!-- Modal Edit Kategori -->
<div class="modal fade" id="editKategoriModal{{ $kategori->id }}" tabindex="-1" aria-labelledby="editKategoriModalLabel{{ $kategori->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('adminLomba.kategori.update', $kategori->id) }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="editKategoriModalLabel{{ $kategori->id }}">Edit Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@stop

@section('js')
<!-- Required datatable js -->
<script src="{{ asset('skoteassets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('skoteassets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('skoteassets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('skoteassets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

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