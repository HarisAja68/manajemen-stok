@extends('layouts.app')
@section('name')
Halaman Lihat Nota Barang Masuk
@endsection

@section('content')
    <div class="card">
        <img src="{{ asset('storage/nota_masuk/'.$nota->foto_nota) }}" width="50%">
        <div class="card-footer">
            <a href="{{ route('bMasuk.index') }}" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> kembali</a>
        </div>
    </div>
@endsection
