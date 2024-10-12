@extends('layouts.UserTemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')

<div class="container py-4 mb-4">
  <h2>Daftar Peserta Lomba: {{ $lomba->judul }}</h2>

  <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 mt-4">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Kategori Lomba</th>
        <th>Nomor Telepon</th>
        <!-- <th>Bukti Pembayaran</th> -->
      </tr>
    </thead>
    <tbody>
      @foreach($peserta as $p)
      <tr>
        <td>{{ $p->nama }}</td>
        <td>{{ $p->kelas }}</td>
        <td>{{ $p->kategoriLomba->nama_kategori }}</td>
        <td>{{ $p->nomor_telepon }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

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
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

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

@if($peserta->count() > 0)
<script>
  $(document).ready(function() {
    $('#datatable').DataTable({
      scrollX: true
    });
  });
</script>
@endif
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