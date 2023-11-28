@extends('layouts.app')
@section('name')
Halaman Edit Kategori
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Kategori</h3>
                </div>
                <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input name="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" required>
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
</div>
@endsection
