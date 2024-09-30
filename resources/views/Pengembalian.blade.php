@extends('layouts.UserTemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')

<div class="container">
  <h2>Buku yang Dikembalikan</h2>
</div>

<table id="datatable" class="table table-striped mt-5" style="width:100%">
  <thead>
    <tr>
      <th>Judul Buku</th>
      <th>Penulis</th>
      <th>Tanggal Peminjaman</th>
      <th>Tanggal Pengembalian</th>
      <th>Tanggal Dikembalikan</th>
      <th>Denda</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($dataPeminjaman as $item)
    @if(isset($item->peminjaman))
    <!-- Jika data dari Pengembalian (sudah dikembalikan) -->
    <tr>
      <td>{{ $item->peminjaman->buku->judulbuku }}</td>
      <td>{{ $item->peminjaman->buku->penulis }}</td>
      <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d-m-Y') }}</td>
      <td>{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pengembalian)->format('d-m-Y') }}</td>
      <td>{{ \Carbon\Carbon::parse($item->tanggal_dikembalikan)->format('d-m-Y') }}</td>
      <td>{{ $item->denda ? 'Rp. ' . number_format($item->denda, 0, ',', '.') : '0' }}</td>
      <td><span class="badge bg-success">Dikembalikan</span></td>
    </tr>
    @else
    <!-- Jika data dari Peminjaman (belum dikembalikan) -->
    <tr>
      <td>{{ $item->buku->judulbuku }}</td>
      <td>{{ $item->buku->penulis }}</td>
      <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
      <td>{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d-m-Y') }}</td>
      <td>-</td> <!-- Belum dikembalikan, jadi tidak ada tanggal pengembalian -->
      <td>-</td> <!-- Belum ada denda -->
      <td>
        @if($item->tanggal_pengembalian < now())
          <span class="badge bg-danger">Terlambat</span>
          @else
          <span class="badge bg-warning">Belum Dikembalikan</span>
          @endif
      </td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>

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