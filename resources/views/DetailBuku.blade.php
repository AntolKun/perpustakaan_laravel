@extends('layouts.UserTemplate')
@section('content')

<div class="container mt-5">
  <div class="row">
    <!-- Bagian Gambar -->
    <div class="col-md-4">
      <img src="{{ asset('buku_photos/' . $buku->gambar) }}" alt="{{ $buku->judulbuku }}" class="img-fluid" style="height: 100%; object-fit: cover;">
    </div>

    <!-- Bagian Detail Buku -->
    <div class="col-md-8">
      <h1 class="fw-bold">{{ $buku->judulbuku }}</h1>
      <ul class="list-unstyled mt-5 fs-4">
        <li class="mt-2"><strong>ISBN :</strong> {{ $buku->isbn }}</li>
        <li class="mt-2"><strong>Penerbit :</strong> {{ $buku->penerbit }}</li>
        <li class="mt-2"><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</li>
        <li class="mt-2"><strong>Stok Buku :</strong> {{ $buku->stok }}</li>
        <li class="mt-2"><strong>Penulis :</strong> {{ $buku->penulis }}</li>
        <li class="mt-2"><strong>Halaman :</strong> {{ $buku->halaman }}</li>
      </ul>
    </div>

    <!-- Syarat dan Ketentuan -->
    <div class="row mt-4">
      <div class="col-12">
        <h4 class="fw-bold">Syarat dan Ketentuan</h4>
        <p>
          Batas waktu peminjaman maksimal adalah 3 hari sejak buku dipinjam.
          Jika buku dikembalikan terlambat, akan dikenakan denda sebesar Rp250 per hari.
          Apabila buku hilang atau rusak, peminjam akan dikenakan sanksi.
        </p>
      </div>
    </div>
  </div>

  <!-- Sinopsis Buku -->
  <div class="row mt-4">
    <div class="col-12">
      <h4 class="fw-bold">Sinopsis</h4>
      <p>{{ $buku->deskripsi }}</p>
    </div>
  </div>

  <div class="d-flex justify-content-end mb-3 me-3">
    <!-- Tombol Kembali -->
    <button class="btn btn-secondary me-2" onclick="window.history.back()">Kembali</button>

    <!-- Tombol Pinjam Buku -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjamModal">Pinjam Buku</button>
  </div>
</div>

<!-- Modal Form Peminjaman Buku -->
<div class="modal fade modal-lg" id="pinjamModal" tabindex="-1" aria-labelledby="pinjamModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pinjamModalLabel">Form Peminjaman Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('peminjaman.store') }}" method="POST">
          @csrf
          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" name="email" required>
          </div>

          <!-- Jurusan -->
          <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" id="jurusan" name="jurusan" required>
          </div>

          <!-- NISN -->
          <div class="mb-3">
            <label for="nisn" class="form-label">NISN</label>
            <input type="text" class="form-control" id="nisn" value="{{ auth()->user()->nisn }}" name="nisn" required>
          </div>

          <!-- Username -->
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" value="{{ auth()->user()->username }}" name="username" required>
          </div>

          <!-- Nama -->
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" value="{{ auth()->user()->nama }}" name="nama" required>
          </div>

          <!-- Kelas -->
          <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" class="form-control" id="kelas" name="kelas" required>
          </div>

          <input type="hidden" name="buku_id" value="{{ $buku->id }}">

          <button type="submit" class="btn btn-primary">Pinjam Buku</button>
        </form>
      </div>
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