@extends('layouts.app')
@section('name')
Halaman suppliers Edit
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Suppliers Edit</h3>
                </div>
                <form action="{{ route('supplier.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <input name="nama" class="form-control" value="{{ $supplier->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label>No Handphone</label>
                            <input name="nomer_tlpn" class="form-control" value="{{ $supplier->nomer_tlpn }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3" required>{{ $supplier->alamat }}</textarea>
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
