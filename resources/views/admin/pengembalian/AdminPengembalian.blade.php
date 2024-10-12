@extends('layouts.AdminTemplate')

@section('css')
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
      <h4 class="mb-sm-0 font-size-18">Pengembalian Buku</h4>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <table id="datatable" class="display table table-bordered w-100" style="width:100%; border: 2px solid #3751CF;">
      <thead style="background-color: #3751CF; color: white; text-align: center;">
        <tr>
          <th>Judul Buku</th>
          <th>Nama Peminjam</th>
          <th>Tanggal Peminjaman</th>
          <th>Tanggal Pengembalian</th>
          <th>Denda</th>
          <th>Tanggal Dikembalikan</th>
          <!-- <th>Denda</th> -->
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($peminjamans as $peminjaman)
        <tr>
          <td>{{ $peminjaman->buku->judulbuku }}</td>
          <td>{{ $peminjaman->nama }}</td>
          <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y') }}</td>
          <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d-m-Y') }}</td>

          <!-- Potensi Denda -->
          <td>Rp. {{ number_format($peminjaman->potensiDenda(), 0, ',', '.') }}</td>

          <!-- Tanggal Dikembalikan -->
          <td>
            @if($peminjaman->pengembalian)
            {{ \Carbon\Carbon::parse($peminjaman->pengembalian->tanggal_dikembalikan)->format('d-m-Y') }}
            @else
            -
            @endif
          </td>

          <!-- Denda -->
          <!-- <td>
            @if($peminjaman->pengembalian)
            Rp. {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}
            @else
            -
            @endif
          </td> -->

          <!-- Status -->
          <td>
            @if($peminjaman->pengembalian)
            <span class="badge bg-success">{{ ucfirst($peminjaman->pengembalian->status) }}</span>
            @else
            <span class="badge bg-warning">Belum dikembalikan</span>
            @endif
          </td>

          <!-- Aksi -->
          <td>
            @if(!$peminjaman->pengembalian)
            <form action="{{ route('admin.pengembalian.store', $peminjaman->id) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-primary">Kembalikan Buku</button>
            </form>
            @else
            <button class="btn btn-secondary" disabled>Sudah Dikembalikan</button>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

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