@extends('layouts.app')
@section('name')
Halaman Laporan
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h5>HALAMAN LAPORAN</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('laporanPdf') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="dari">Dari Tanggal</label>
                <div class="input-group date" id="dari" data-target-input="nearest">
                    <input name="dari" type="text" class="form-control datetimepicker-input date" data-target="#dari" />
                    <div class="input-group-append" data-target="#dari" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="sampai">Sampai Tanggal</label>
                <div class="input-group date" id="sampai" data-target-input="nearest">
                    <input name="sampai" type="text" class="form-control datetimepicker-input date" data-target="#sampai" />
                    <div class="input-group-append" data-target="#sampai" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="laporan">Tipe Laporan</label>
                <select name="laporan" id="laporan" class="form-control select2" required>
                    <option value="" disabled hidden selected>-- Pilih Laporan --</option>
                    <option value="masuk">Barang Masuk</option>
                    <option value="keluar">Barang Keluar</option>
                    <option value="stok-akhir">Stok Akhir</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" target="_blank"><i class="fas fa-save"></i> Cetak</button>
        </form>
    </div>
</div>
@endsection

@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('template') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('template') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endpush
@push('js')
<!-- Select2 -->
<script src="{{ asset('template') }}/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="{{ asset('template') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('template') }}/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('template') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
@endpush
@push('script')
<script>
$(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    //Date picker
    $('.date').datetimepicker({
        icons: { time: 'far fa-clock' },
        format: 'YYYY-MM-DD',
        locale: 'id'
    });
});
</script>
@endpush
