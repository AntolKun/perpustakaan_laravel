@extends('layouts.UserTemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')

<div class="container">
  <h2>Lomba Literasi</h2>
</div>

<div class="container py-4">
  <div class="row">
    @foreach($lombas as $lomba)
    <div class="col-md-4 mb-4">
      <div class="card h-100 border-bottom border-start border-top border-end border-info m-2">
        @if($lomba->gambar)
        <img src="{{ asset('admin_lomba/' . $lomba->gambar) }}" class="card-img-top p-2" alt="{{ $lomba->judul }}" style="height: 200px; object-fit: cover;">
        @else
        <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top p-2" alt="No Image" style="height: 200px; object-fit: cover;">
        @endif
        <div class="card-body d-flex flex-column"> <!-- Flex column agar tombol bisa di-bawah -->
          <h5 class="card-title">{{ $lomba->judul }}</h5>
          <p class="card-text" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
            {{ $lomba->deskripsi }}
          </p>
          <a href="#" class="btn btn-primary mt-auto position-absolute bottom-0 end-0 m-3">More Info</a> <!-- Tombol di pojok kanan bawah -->
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
  $(document).ready(function() {
    $('#datatable').DataTable({
      scrollX: true
    });
  });
</script>
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