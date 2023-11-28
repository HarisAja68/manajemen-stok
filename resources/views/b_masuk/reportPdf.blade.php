<title>laporan Barang Masuk</title>
<div style="line-height: 7px; text-align: center; margin-bottom: 30px">
    <h2 style="font-weight: bold">Toko Barokah Motor</h2>
    <p>Dusun Glagah Pasar</p>
    <p>Desa Glagah Kecamatan Glagah Kabupaten Lamongan</p>
</div>
<hr>
<br>
<center>
    <h4>Laporan Barang Masuk</h4>
    <h3>Tanggal {{ \Carbon\Carbon::parse($dari)->format('d-m-Y') }} s/d Tanggal {{ \Carbon\Carbon::parse($sampai)->format('d-m-Y') }} </h3>
</center>
<hr /><br />
<table border="1" width="100%">
    <thead>
        <tr style="text-align: center">
            <th>No</th>
            <th>Barang</th>
            <th>Supplier</th>
            <th>Penerima</th>
            <th>Stok Masuk</th>
            <th>Stok Total</th>
            <th>TGL Masuk</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataMasuk as $key => $data)
            <tr style="text-align: center">
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->nama_barang }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->jumlah }}</td>
                <td>{{ $data->total_stok }}</td>
                <td>{{ \Carbon\Carbon::parse($data->tgl_masuk)->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script type="text/javascript">
    window.print();
</script>
