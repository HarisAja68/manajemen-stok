@extends('layouts.app')
@section('name')
Halaman Detail Barang Keluar
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="tabel" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Keluar</th>
                        <th>Jumlah Sebelumnya</th>
                        <th>Sisa Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailKeluar as $key => $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->Barang->kode_barang }}</td>
                            <td>{{ $data->Barang->nama_barang }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>{{ $data->jumlah_sebelumnya }}</td>
                            <td>{{ $data->sisa_stok }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a class="btn btn-danger" href="{{ route('bKeluar.index') }}"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
        </div>
    </div>
@endsection
