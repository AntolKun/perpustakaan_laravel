@extends('layouts.UserTemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')

<div class="container">
  <h2>Buku yang Dipinjam</h2>
</div>

<table id="datatable" class="table table-striped mt-5" style="width:100%">
  <thead>
    <tr>
      <th>Judul Buku</th>
      <th>Penulis</th>
      <th>Tanggal Peminjaman</th>
      <th>Tanggal Pengembalian</th>
      <th>Status Peminjaman</th>
    </tr>
  </thead>
  <tbody>
    @foreach($peminjaman as $p)
    <tr>
      <td>{{ $p->buku->judulbuku }}</td>
      <td>{{ $p->buku->penulis }}</td>
      <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') }}</td>
      <td>{{ \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d-m-Y') }}</td>
      <td>
        @if($p->status == 'disetujui')
        <span class="badge bg-success">{{ ucfirst($p->status) }}</span>
        @elseif($p->status == 'ditolak')
        <span class="badge bg-danger">{{ ucfirst($p->status) }}</span>
        @else
        <span class="badge bg-warning">{{ ucfirst($p->status) }}</span>
        @endif
      </td>
    </tr>
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