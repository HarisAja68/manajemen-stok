@extends('layouts.app')
@section('name')
Halaman Kategori
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a class="btn btn-primary btn-sm" href="{{ route('kategori.create') }}" role="button"><i
            class="fas fa-plus"></i>
        Tambah Data</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="tabel" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $key => $data)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{ $data->nama_kategori}}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $data->id) }}" class="btn btn-sm btn-warning"><i
                                class="fas fa-edit"> Edit</i></a>
                        <form class="d-inline" action="{{ route('kategori.destroy', $data->id) }}" role="alert"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash-alt"></i>
                                Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Sweetalert 2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('template') }}/plugins/sweetalert2/sweetalert2.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('template') }}/plugins/toastr/toastr.min.css">
@endpush
@push('js')
<script src="{{ asset('template') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('template') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('template') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('template') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('template') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('template') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('template') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Sweetalert 2 -->
<script type="text/javascript" src="{{ asset('template') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{{ asset('template') }}/plugins/toastr/toastr.min.js"></script>
@endpush
@push('script')
<script>
    $(function () {
        $("#tabel").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
    });

</script>
@if (session()->has('success'))
<script>
    $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Berhasilll',
        body: '{{ session('success') }}'
        });

        setTimeout(() => {
            $('.toasts-top-right').remove();
        }, 5000);
</script>
@endif
@if (session()->has('danger'))
<script>
     $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Gagal',
        body: '{{ session('danger') }}'
      });

      setTimeout(() => {
           $('.toasts-top-right').remove();
       }, 5000);
</script>
@endif
<script>
    $(document).ready(function () {
        $("form[role='alert']").submit(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin untuk menghapus?',
                text: "Anda tidak akan bisa mengembalikan data yang telah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'YA, hapus saja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        });
    });

</script>
@endpush
