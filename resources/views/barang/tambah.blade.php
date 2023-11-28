@extends('layouts.app')
@section('name')
Halaman Tambah Barang
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Barang Create</h3>
            </div>
            <form action="{{ route('barang.index') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Kategori Barang</label>
                        <select name="kategori_id" id="kategori_id" class="form-control select2" required>
                            <option disabled selected>Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input name="nama_barang" class="form-control" placeholder="Silahkan isi nama barang" required>
                    </div>
                    <div class="form-group">
                        <label>Stok Awal</label>
                        <input type="number" name="stok_awal" class="form-control" placeholder="Silahkan isi stok awal" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> kembali</a>
                </div>
            </form>
        </div>
    <div class="col-md-6">
</div>
@endsection

@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('template') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@push('js')
<!-- Select2 -->
<script src="{{ asset('template') }}/plugins/select2/js/select2.full.min.js"></script>
@endpush
@push('script')
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
});
</script>
@endpush
