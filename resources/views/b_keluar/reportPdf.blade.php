<title>laporan Barang Keluar</title>
<div style="line-height: 7px; text-align: center; margin-bottom: 30px">
    <h2 style="font-weight: bold">Toko Barokah Motor</h2>
    <p>Dusun Glagah Pasar</p>
    <p>Desa Glagah Kecamatan Glagah Kabupaten Lamongan</p>
</div>
<hr>

<br>
<center>
    <h3>Laporan Barang Keluar </h3>
    <h3>Tanggal {{ \Carbon\Carbon::parse($dari)->format('d-m-Y') }} s/d Tanggal {{ \Carbon\Carbon::parse($sampai)->format('d-m-Y') }} </h3>
</center>
<hr /><br />
<table border="1" width="100%">
    <thead>
        <tr style="text-align: center">
            <th>No</th>
            <th>Barang</th>
            <th>Stok Keluar</th>
            <th>Stok Sebelumnya</th>
            <th>Sisa Stok</th>
            <th>Yang mengeluarkan</th>
            <th>TGL Keluar</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barang_keluar as $key => $data)
            <tr style="text-align: center">
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->nama_barang }}</td>
                <td>{{ $data->jumlah }}</td>
                <td>{{ $data->jumlah_sebelumnya }}</td>
                <td>{{ $data->sisa_stok }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                <td>{{ $data->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script type="text/javascript">
    window.print();
</script>
