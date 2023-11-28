<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BarangMasukModel extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'penerima', 'id');
    }
    public function barang()
    {
        return $this->belongsTo(BarangModel::class);
    }
    public function supplier()
    {
        return $this->belongsTo(SuppliersModel::class);
    }
    public static function laporan($dari, $sampai)
    {
        return DB::table('barang_masuk')
            ->select("barang_masuk.*", "barang.nama_barang", "suppliers.nama", "users.name")
            ->join('users', "barang_masuk.penerima", "=", "users.id")
            ->join('barang', "barang_masuk.barang_id", "=", "barang.id")
            ->join('suppliers', "barang_masuk.supplier_id", "=", "suppliers.id")
            ->whereBetween('barang_masuk.created_at', [$dari, $sampai])
            ->get();
    }
}
