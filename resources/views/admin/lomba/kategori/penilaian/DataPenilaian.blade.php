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
      <h4 class="mb-sm-0 font-size-18">Penilaian Kategori Lomba: {{ $kategoriLomba->nama_kategori }}</h4>
      <div>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addPenilaianModal">
          <i class="bx bx-plus font-size-16 align-middle me-2"></i>Tambah Penilaian</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <table id="datatable" class="display table table-bordered w-100" style="width:100%; border: 2px solid #3751CF;">
      <thead style="background-color: #3751CF; color: white; text-align: center;">
        <tr>
          <th>Field 1</th>
          <th>Field 2</th>
          <th>Field 3</th>
          <th>Field 4</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($penilaians as $penilaian)
        <tr>
          <td>{{ $penilaian->field_1 }}</td>
          <td>{{ $penilaian->field_2 }}</td>
          <td>{{ $penilaian->field_3 }}</td>
          <td>{{ $penilaian->field_4 }}</td>
          <td>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPenilaianModal{{ $penilaian->id }}">
              Edit
            </button>
            <form action="{{ route('adminPenilaian.delete', $penilaian->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Tambah Penilaian -->
<div class="modal fade" id="addPenilaianModal" tabindex="-1" aria-labelledby="addPenilaianModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('adminPenilaian.store', $kategoriLomba->id) }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addPenilaianModalLabel">Tambah Penilaian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="field_1" class="form-label">Field 1</label>
            <input type="text" class="form-control" id="field_1" name="field_1" required>
          </div>
          <div class="mb-3">
            <label for="field_2" class="form-label">Field 2</label>
            <input type="text" class="form-control" id="field_2" name="field_2" required>
          </div>
          <div class="mb-3">
            <label for="field_3" class="form-label">Field 3</label>
            <input type="text" class="form-control" id="field_3" name="field_3" required>
          </div>
          <div class="mb-3">
            <label for="field_4" class="form-label">Field 4</label>
            <input type="text" class="form-control" id="field_4" name="field_4" required>
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

@foreach($penilaians as $penilaian)
<!-- Modal Edit Penilaian -->
<div class="modal fade" id="editPenilaianModal{{ $penilaian->id }}" tabindex="-1" aria-labelledby="editPenilaianModalLabel{{ $penilaian->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('adminPenilaian.update', $penilaian->id) }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="editPenilaianModalLabel{{ $penilaian->id }}">Edit Penilaian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="field_1" class="form-label">Field 1</label>
            <input type="text" class="form-control" id="field_1" name="field_1" value="{{ $penilaian->field_1 }}" required>
          </div>
          <div class="mb-3">
            <label for="field_2" class="form-label">Field 2</label>
            <input type="text" class="form-control" id="field_2" name="field_2" value="{{ $penilaian->field_2 }}" required>
          </div>
          <div class="mb-3">
            <label for="field_3" class="form-label">Field 3</label>
            <input type="text" class="form-control" id="field_3" name="field_3" value="{{ $penilaian->field_3 }}" required>
          </div>
          <div class="mb-3">
            <label for="field_4" class="form-label">Field 4</label>
            <input type="text" class="form-control" id="field_4" name="field_4" value="{{ $penilaian->field_4 }}" required>
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