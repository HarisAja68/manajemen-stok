<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluarModel;
use App\Models\BarangModel;
use App\Models\DetailBarangKeluarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bKeluar = BarangKeluarModel::all();
        return view('b_keluar.index', compact('bKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = BarangModel::all();
        $no_keluar = BarangKeluarModel::generateNoPo();
        return view('b_keluar.tambah', compact('barang', 'no_keluar'));
    }

    public function addCart()
    {
        $dataBarang = request()->except("_token");
        $barang = BarangModel::find($dataBarang['id_barang']);
        $dataBarang['kode_barang'] = $barang->kode_barang;
        $dataBarang['nama_barang'] = $barang->nama_barang;
        if (request()->session()->exists('databarang') && !empty(session()->get('databarang'))) {
            request()->session()->push('databarang', $dataBarang);
        } else {
            request()->session()->put('databarang', []);
            request()->session()->push('databarang', $dataBarang);
        }
        return response(true);
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

        $data = $request->except('_token');
        $user = Auth::user()->id;

        $file  = $request->foto_nota;
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->StoreAs('public/nota_keluar/', $fileName);
        $data['foto_nota'] = $fileName;
        $data['yg_mengeluarkan'] = $user;

        try {
            $create = BarangKeluarModel::create($data);
            if (request()->session()->exists('databarang')) {
                foreach (request()->session()->get('databarang') as $br) {
                    $barang = BarangModel::find($br['id_barang']);
                    $barang->fill([
                        'jumlah' =>  $barang->jumlah - $br['jumlahMasuk']
                    ]);
                    $barang->save();
                    DetailBarangKeluarModel::create([
                        'barang_keluar_id' => $create->id,
                        'barang_id' => $br['id_barang'],
                        'jumlah' => $br['jumlahMasuk'],
                        'sisa_stok' => $br['sisaStok'],
                        'jumlah_sebelumnya' => $br['stokSebelumnya'],
                    ]);
                }
            }
            DB::commit();
            request()->session()->forget('databarang');
            return redirect('bKeluar')->with('success', 'Data barang keluar berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('bKeluar')->with('danger', 'Data barang keluar gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota = BarangKeluarModel::find($id);
        return view('b_keluar.nota', compact('nota'));
    }

    public function detail($id)
    {
        $detailKeluar = DetailBarangKeluarModel::with('barang')->where('barang_keluar_id', $id)->get();
        return view('b_keluar.detail', compact('detailKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bKeluar = BarangKeluarModel::find($id);
        return view('b_keluar.edit', compact('bKeluar'));
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
            'tgl_keluar' => 'required',
            'foto_nota' => 'file|image|mimes:png,jpg,jpeg',
            'keterangan' => 'required',
        ]);

        if ($request->hasFile('foto_nota')) {
            $file  = $request->foto_nota;
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->StoreAs('public/nota_keluar/', $fileName);

            Storage::delete('public/nota_keluar/' . $request->oldPhoto);
            $barang['foto_nota'] = $fileName;
        } else {
            $barang['foto_nota'] = $request->oldPhoto;
        }

        BarangKeluarModel::find($id)->update($barang);
        return redirect('bKeluar')->with('success', 'Data barang keluar berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barangKeluar = BarangKeluarModel::find($id);
        if ($barangKeluar) {
            foreach (DetailBarangKeluarModel::where('barang_keluar_id', $barangKeluar->id)->get() as $detail) {
                $barang = BarangModel::find($detail->barang_id);
                $total = $barang->jumlah + $detail->jumlah;
                BarangModel::where('id', $detail->barang_id)->update([
                    'jumlah' => $total
                ]);
            }
            DetailBarangKeluarModel::where('barang_keluar_id', $barangKeluar->id)->delete();
            Storage::delete('public/nota_keluar/' . $barangKeluar->foto_nota);
            $barangKeluar->delete();
        }
        return redirect('bKeluar')->with('success', 'Data barang keluar berhasil di Hapus');
    }
}
