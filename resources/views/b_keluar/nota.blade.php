@extends('layouts.app')
@section('name')
Halaman Lihat Nota Barang Keluar
@endsection

@section('content')
    <div class="card">
        <img src="{{ asset('storage/nota_keluar/'.$nota->foto_nota) }}" width="50%">
        <div class="card-footer">
            <a href="{{ route('bKeluar.index') }}" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> kembali</a>
        </div>
    </div>
@endsection
