<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetailBarangKeluarModel extends Model
{
    use HasFactory;

    protected $table = 'detail_barang_keluar';
    protected $guarded = [];

    public static function laporan($dari, $sampai)
    {
        return DB::table('detail_barang_keluar')
            ->select("detail_barang_keluar.*", "barang_keluar.*", "barang_keluar.no_keluar", "barang_keluar.keterangan", "barang.nama_barang", "users.name")
            ->join('barang', "detail_barang_keluar.barang_id", "=", "barang.id")
            ->join('barang_keluar', "detail_barang_keluar.barang_keluar_id", "=", "barang_keluar.id")
            ->join('users', "barang_keluar.yg_mengeluarkan", "=", "users.id")
            ->whereBetween('barang_keluar.created_at', [$dari, $sampai])
            ->get();
    }

    public function barang()
    {
        return $this->belongsTo(BarangModel::class);
    }
}
