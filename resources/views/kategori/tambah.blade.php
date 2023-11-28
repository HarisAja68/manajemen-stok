@extends('layouts.app')
@section('name')
Halaman Tambah Kategori
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Kategori Create</h3>
            </div>
            <form action="{{ route('kategori.index') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input name="nama_kategori" class="form-control" placeholder="Silahkan isi nama kategori" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> kembali</a>
                </div>
            </form>
        </div>
    <div class="col-md-6">
</div>
@endsection
