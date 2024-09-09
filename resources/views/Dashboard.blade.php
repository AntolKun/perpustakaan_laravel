@extends('layouts.UserTemplate')

@section('content')

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