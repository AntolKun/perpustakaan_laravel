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
      <h2>{{ $lomba->judul }}</h2>

      @if($lomba->gambar)
      <img src="{{ asset('admin_lomba/' . $lomba->gambar) }}" alt="{{ $lomba->judul }}" style="max-width: 100%; height: auto; margin-top: 20px;">
      @else
      <img src="https://via.placeholder.com/800x400?text=No+Image" alt="No Image" style="max-width: 100%; height: auto; margin-top: 20px;">
      @endif

      <p class="mt-4" style="text-align: justify;">
        {{ $lomba->deskripsi }}
      </p>
    </div>

    <div class="col-md-8 d-flex justify-content-end" style="margin-top: 20px;">
      <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#daftarLombaModal">Daftar Lomba</button>
      <a href="{{ route('lomba.peserta', $lomba->id) }}" class="btn btn-secondary me-2">Daftar Peserta</a>
      <a href="" class="btn btn-success">Pengumuman Pemenang</a>
    </div>
  </div>
</div>

<div class="modal fade" id="daftarLombaModal" tabindex="-1" aria-labelledby="daftarLombaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #10439F;">
      <div class="modal-header border-0">
        <h5 class="modal-title text-white" id="daftarLombaModalLabel">Daftar Lomba</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <form action="{{ route('lomba.daftar.store', $lomba->id) }}" method="POST" enctype="multipart/form-data" class="p-4 bg-white rounded">
              @csrf
              <input type="hidden" name="lomba_id" value="{{ $lomba->id }}">

              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
              </div>

              <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" name="kelas" class="form-control" id="kelas" required>
              </div>

              <div class="mb-3">
                <label for="kategori_lomba_id" class="form-label">Kategori Lomba</label>
                <select name="kategori_lomba_id" class="form-select" id="kategori_lomba_id" required>
                  <option value="" disabled selected>Pilih Kategori</option>
                  @foreach($kategoriLombas as $kategori)
                  <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" class="form-control" id="nomor_telepon" required>
              </div>

              <div class="mb-3">
                <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" class="form-control" id="bukti_pembayaran" accept=".jpeg,.jpg,.png,.pdf" required>
              </div>

              <div class="modal-footer border-0">
                <button type="submit" class="btn btn-primary">Daftar</button>
              </div>
            </form>
          </div>

          <div class="col-md-6 d-none d-md-block">
            <img src="{{ asset('assets/images/Lomba.png') }}" alt="Lomba" class="img-fluid rounded">
          </div>
        </div>
      </div>
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