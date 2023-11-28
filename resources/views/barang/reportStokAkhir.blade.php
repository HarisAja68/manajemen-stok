<title>laporan Stok Akhir</title>
<div style="line-height: 7px; text-align: center; margin-bottom: 30px">
    <h2 style="font-weight: bold">Toko Barokah Motor</h2>
    <p>Dusun Glagah Pasar</p>
    <p>Desa Glagah Kecamatan Glagah Kabupaten Lamongan</p>
</div>
<hr>
<br>
<center>
    <h3>Laporan Stok Akhir</h3>
    <h3> Per Tanggal {{ \Carbon\Carbon::parse($sampai)->format('d-m-Y') }} </h3>
</center>
<hr /><br />
<table border="1" width="100%">
    <thead>
        <tr style="text-align:center">
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama barang</th>
            <th>Total Masuk</th>
            <th>Total Keluar</th>
            <th>Stok Akhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataBarang as $no => $dt)
            <tr style="text-align:center">
                <td>{{ $no + 1 }}</td>
                <td>{{ $dt['kode_barang'] }}</td>
                <td>{{ $dt['nama_barang'] }}</td>
                <td>{{ $dt['totalMasuk'] }}</td>
                <td>{{ $dt['totalKeluar'] }}</td>
                <td>{{ $dt['jumlah'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script type="text/javascript">
    window.print();
</script>
