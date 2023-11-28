<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BarangKeluarModel extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'yg_mengeluarkan', 'id');
    }
    public static function generateNoPo()
    {
        $kode_max = DB::select("SELECT MAX(RIGHT(no_keluar,4)) as kode_max FROM barang_keluar");
        if ($kode_max) {
            $kode_max =  collect($kode_max)->pluck('kode_max')->toArray()[0];
            $kode_interval =  (int) $kode_max + 1;
        } else {
            $kode_interval =  1;
        }
        return 'PO-' . str_pad($kode_interval, 4, '0', STR_PAD_LEFT);
    }
}
