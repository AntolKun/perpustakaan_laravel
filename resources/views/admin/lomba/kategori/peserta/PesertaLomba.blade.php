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
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0 font-size-18">Peserta Lomba: {{ $lomba->judul }} - {{ $kategori->nama_kategori }}</h4>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
      <thead style="background-color: #3751CF; color: white;">
        <tr>
          <th>Nama Peserta</th>
          <th>Kelas</th>
          <th>Nomor Telepon</th>
          <th>Bukti Pembayaran</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pesertaLombas as $peserta)
        <tr>
          <td>{{ $peserta->nama }}</td>
          <td>{{ $peserta->kelas }}</td>
          <td>{{ $peserta->nomor_telepon }}</td>
          <td>
            @if($peserta->bukti_pembayaran)
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buktiModal" data-src="{{ asset('bukti_pembayaran/' . $peserta->bukti_pembayaran) }}">
              Lihat Bukti
            </button>
            @else
            Tidak ada bukti
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="buktiModal" tabindex="-1" aria-labelledby="buktiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buktiModalLabel">Bukti Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="buktiPembayaranImg" src="" alt="Bukti Pembayaran" class="img-fluid">
      </div>
    </div>
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

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var buktiModal = document.getElementById('buktiModal');

    buktiModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget; // Tombol yang diklik
      var src = button.getAttribute('data-src'); // Ambil URL dari data-src

      var img = buktiModal.querySelector('#buktiPembayaranImg');
      img.src = src; // Set gambar modal
    });
  });
</script>


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