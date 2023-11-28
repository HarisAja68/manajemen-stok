<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = BarangModel::all();
        return view('barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = KategoriModel::all();
        return view('barang.tambah', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kode_barang = BarangModel::generateKode();

        $data = new BarangModel;
        $data->kode_barang = $kode_barang;
        $data->nama_barang = $request->nama_barang;
        $data->kategori_id = $request->kategori_id;
        $data->jumlah = $request->stok_awal;
        $data->stok_awal = $request->stok_awal;
        $data->save();
        return redirect('barang')->with('success', 'Data barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoriSelected = KategoriModel::all();
        $barang = BarangModel::find($id);
        return view('barang.edit', compact('barang', 'kategoriSelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = BarangModel::find($id);
        $barang->kategori_id = $request->kategori_id;
        $barang->nama_barang = $request->nama_barang;

        if ($barang->stok_awal != $request->stok_awal) {
            if ($request->stok_awal > $barang->stok_awal) {
                $total =  $request->stok_awal - $barang->stok_awal;
                $request['jumlah'] = $barang->jumlah + $total;
                $barang->jumlah = $request['jumlah'];
            } else {
                $total =   $barang->stok_awal - $request['stok_awal'];
                $request['jumlah'] = $barang->jumlah - $total;
                $barang->jumlah = $request['jumlah'];
            }
        }
        $barang->stok_awal = $request->stok_awal;
        $barang->update();
        return redirect('barang')->with('success', 'Data barang berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            BarangModel::destroy($id);
            return redirect('barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('barang')->with('danger', 'Data barang Masih Digunakan di menu lain');
            throw $th;
        }
    }
}
