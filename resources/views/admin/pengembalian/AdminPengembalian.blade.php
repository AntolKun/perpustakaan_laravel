@extends('layouts.AdminTemplate')

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
    <table id="datatable" class="display table table-bordered w-100">
      <thead style="background-color: #3751CF; color: white; text-align: center;">
        <tr>
          <th>Judul Buku</th>
          <th>Nama Peminjam</th>
          <th>Tanggal Peminjaman</th>
          <th>Tanggal Pengembalian</th>
          <th>Denda</th>
          <th>Tanggal Dikembalikan</th>
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
          <td>
            Rp. {{ number_format($peminjaman->potensiDenda(), 0, ',', '.') }}
          </td>
          <td>
            @if($peminjaman->pengembalian)
            {{ \Carbon\Carbon::parse($peminjaman->pengembalian->tanggal_dikembalikan)->format('d-m-Y') }}
            @else
            -
            @endif
          </td>
          <td>
            @if($peminjaman->pengembalian)
            <span class="badge bg-success">{{ ucfirst($peminjaman->pengembalian->status) }}</span>
            @else
            <span class="badge bg-warning">Belum dikembalikan</span>
            @endif
          </td>
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