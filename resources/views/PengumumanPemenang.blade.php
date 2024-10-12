@extends('layouts.UserTemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container py-4">
  <h2>Pengumuman Pemenang: {{ $lomba->judul }}</h2>

  @foreach ($winners as $kategori => $topWinners)
  <h3 class="mt-4">{{ $kategori }}</h3>
  <div class="row">
    @if ($topWinners->isEmpty())
    <div class="col-md-12 text-center">
      <img src="{{ asset('assets/images/empty.svg') }}" alt="No Winners" style="width: 150px; height: auto;">
      <p>Tidak ada pemenang untuk kategori ini.</p>
    </div>
    @else
    @foreach ($topWinners as $index => $winner)
    <div class="col-md-4 mb-3">
      <div class="card text-center">
        <img src="{{ asset('assets/images/winner.png') }}" class="card-img-top" alt="Winner">
        <div class="card-body">
          @php
          $medalImage = '';
          if ($index === 0) {
          $medalImage = 'jur1.png';
          } elseif ($index === 1) {
          $medalImage = 'jur2.png';
          } elseif ($index === 2) {
          $medalImage = 'jur3.png';
          }
          @endphp

          @if ($medalImage)
          <img src="{{ asset('assets/images/' . $medalImage) }}" alt="Medal" style="width: 70px; height: 100px;">
          @endif
          <h5 class="card-title my-4">{{ $winner->pendaftaranLomba->nama }}</h5>
          <p class="card-text">Total Nilai: {{ $winner->total_nilai }}</p>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>
  @endforeach
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