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
    <h4 class="mb-sm-0">Nilai Siswa: {{ $peserta->nama }} - {{ $peserta->kelas }}</h4>
    <form action="{{ route('nilai-siswa.store') }}" method="POST">
      @csrf
      <input type="hidden" name="lomba_id" value="{{ $peserta->lomba_id }}">
      <input type="hidden" name="pendaftaran_id" value="{{ $peserta->id }}">
      <input type="hidden" name="kategori_lomba_id" value="{{ $kategori_lomba_id }}">

      <div class="mb-3">
        <label for="field_1">{{ $penilaian->field_1 }}</label>
        <input type="number" name="field_1" class="form-control" min="0" max="100" required>
      </div>
      <div class="mb-3">
        <label for="field_2">{{ $penilaian->field_2 }}</label>
        <input type="number" name="field_2" class="form-control" min="0" max="100" required>
      </div>
      <div class="mb-3">
        <label for="field_3">{{ $penilaian->field_3 }}</label>
        <input type="number" name="field_3" class="form-control" min="0" max="100" required>
      </div>
      <div class="mb-3">
        <label for="field_4">{{ $penilaian->field_4 }}</label>
        <input type="number" name="field_4" class="form-control" min="0" max="100" required>
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
      <!-- <a href="{{ url()->previous() }}" class="btn btn-danger ml-4">Kembali</a> -->
    </form>
  </div>
</div>
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

@if ($errors->any())
<script>
  Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: '{{ $errors->first() }}',
  });
</script>
@endif

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