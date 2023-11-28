<?php

namespace App\Http\Controllers;

use App\Models\BarangMasukModel;
use App\Models\BarangModel;
use App\Models\SuppliersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangMasukContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bMasuk = BarangMasukModel::all();
        return view('b_masuk.index', compact('bMasuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = BarangModel::all();
        $supplier = SuppliersModel::all();
        return view('b_masuk.tambah', compact('barang', 'supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('checkStok')) {
            $id_barang = $request->input('id_barang');
            $barang = BarangModel::find($id_barang);
            return response()->json($barang);
        }

        $barang = $request->validate([
            'barang_id' => 'required',
            'supplier_id' => 'required',
            'penerima' => 'required',
            'jumlah' => 'required',
            'jumlah_sebelumnya' => 'required',
            'total_stok' => 'required',
            'tgl_masuk' => 'required',
            'foto_nota' => 'file|image|mimes:png,jpg,jpeg',
            'keterangan' => 'required',
        ]);

        $file  = $request->foto_nota;
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->StoreAs('public/nota_masuk/', $fileName);
        $barang['foto_nota'] = $fileName;
        BarangMasukModel::create($barang);

        $data = $request->except('_token');
        $barang = BarangModel::find($data['barang_id']);
        $barang->fill([
            'jumlah' => $data['jumlah'] + $barang->jumlah
        ]);
        $barang->update();

        return redirect('bMasuk')->with('success', 'Data barang masuk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota = BarangMasukModel::find($id);
        return view('b_masuk.nota', compact('nota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barangSelected = BarangModel::all();
        $supplierSelected = SuppliersModel::all();
        $bMasuk = BarangMasukModel::find($id);
        return view('b_masuk.edit', compact('bMasuk', 'barangSelected', 'supplierSelected'));
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
        $barang = $request->validate([
            'supplier_id' => 'required',
            'tgl_masuk' => 'required',
            'foto_nota' => 'file|image|mimes:png,jpg,jpeg',
            'keterangan' => 'required',
        ]);

        if ($request->hasFile('foto_nota')) {
            $file  = $request->foto_nota;
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->StoreAs('public/nota_masuk/', $fileName);

            Storage::delete('public/nota_masuk/' . $request->oldPhoto);
            $barang['foto_nota'] = $fileName;
        } else {
            $barang['foto_nota'] = $request->oldPhoto;
        }

        BarangMasukModel::find($id)->update($barang);
        return redirect('bMasuk')->with('success', 'Data barang masuk berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barangMasuk = BarangMasukModel::find($id);
        if ($barangMasuk) {
            $barang = BarangModel::find($barangMasuk->barang_id);
            $total = $barang->jumlah - $barangMasuk->jumlah;
            BarangModel::where('id', $barangMasuk->barang_id)->update([
                'jumlah' => $total
            ]);
            Storage::delete('public/nota_masuk/' . $barangMasuk->foto_nota);
            $barangMasuk->delete();
        }
        return redirect('bMasuk')->with('success', 'Data barang masuk berhasil dihapus');
    }
}
