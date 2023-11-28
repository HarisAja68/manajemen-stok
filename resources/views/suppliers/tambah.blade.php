@extends('layouts.app')
@section('name')
    Halaman tambah suppliers
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Suppliers Create</h3>
                </div>
                <form action="{{ route('supplier.index') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Suppliers</label>
                            <input name="nama" class="form-control" placeholder="Silahkan isi nama suppliers" required>
                        </div>
                        <div class="form-group">
                            <label>No Handphone</label>
                            <input name="nomer_tlpn" class="form-control" placeholder="Silahkan isi No Handphone" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Silahkan Isi Keterangan" required></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="{{ route('supplier.index') }}" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> kembali</a>
                    </div>
                </form>
            </div>
        <div class="col-md-6">
    </div>
</div>
@endsection
