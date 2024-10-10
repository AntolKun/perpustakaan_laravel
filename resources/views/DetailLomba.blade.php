@extends('layouts.UserTemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')

<div class="container">
  <h2>Lomba Literasi</h2>
</div>

<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">
      <!-- Judul Lomba -->
      <h2>{{ $lomba->judul }}</h2>

      <!-- Gambar Lomba -->
      @if($lomba->gambar)
      <img src="{{ asset('admin_lomba/' . $lomba->gambar) }}" alt="{{ $lomba->judul }}" style="max-width: 100%; height: auto; margin-top: 20px;">
      @else
      <img src="https://via.placeholder.com/800x400?text=No+Image" alt="No Image" style="max-width: 100%; height: auto; margin-top: 20px;">
      @endif

      <!-- Deskripsi Lomba -->
      <h5 class="my-5 py-5" style="text-align: justify;">
        {{ $lomba->deskripsi }}
      </h5>
    </div>

    <!-- Tombol di Kanan Bawah di bawah deskripsi -->
    <div class="col-md-8 d-flex justify-content-end" style="margin-top: 20px;">
      <a href="" class="btn btn-primary me-2">Daftar Lomba</a>
      <a href="" class="btn btn-secondary me-2">Daftar Peserta</a>
      <a href="" class="btn btn-success">Pengumuman Pemenang</a>
    </div>
  </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
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
@endsection


