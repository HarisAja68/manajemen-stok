<?php

namespace App\Http\Controllers;

use App\Models\BarangMasukModel;
use App\Models\BarangModel;
use App\Models\DetailBarangKeluarModel;
use Carbon\Carbon;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function laporanPdf()
    {
        if (request()->input('dari') &&  request()->input('sampai')) {
            $dari =   Carbon::createFromFormat('Y-m-d', request()->input('dari'));
            $sampai = Carbon::createFromFormat('Y-m-d', request()->input('sampai'));
        }
        if (request()->input('laporan') == 'masuk') {
            $dataMasuk = BarangMasukModel::laporan($dari, $sampai);
            // return PDF::loadView('b_masuk.reportPdf', compact('dataMasuk'))->stream('laporan-barang-masuk-tgl-' . Carbon::parse($dari)->format('d-m-Y') . ' sampai ' . Carbon::parse($sampai)->format('d-m-Y') . '.pdf');
            return view('b_masuk.reportPdf', compact('dari', 'sampai', 'dataMasuk'));
        } else if (request()->input('laporan') == "keluar") {
            $barang_keluar = DetailBarangKeluarModel::laporan($dari, $sampai);
            return view('b_keluar.reportPdf', compact('dari', 'sampai', 'barang_keluar'));
        } else {
            $dataBarang = [];
            $stokAkhir = BarangModel::with('barangkeluar', 'barangMasuk')->get()->toArray();
            foreach ($stokAkhir as $barang) {
                $totalkeluar = 0;
                $totalmasuk = 0;
                foreach ($barang['barangkeluar'] as $barangkeluar) {
                    $totalkeluar +=  $barangkeluar['jumlah'];
                }
                if (count($barang['barang_masuk']) > 0) {
                    foreach ($barang['barang_masuk'] as $barangMasuk) {
                        $totalmasuk +=  $barangMasuk['jumlah'];
                    }
                }
                $barang['totalKeluar'] = $totalkeluar;
                $barang['totalMasuk'] = $totalmasuk;
                array_push($dataBarang, $barang);
            }
            // return PDF::loadView("barang.reportStokAkhir", ['dataBarang' => $dataBarang])->stream('laporan-stok-barang-akhir' . '.pdf');
            return view('barang.reportStokAkhir', compact('dari', 'sampai', 'dataBarang'));
        }
    }
}
