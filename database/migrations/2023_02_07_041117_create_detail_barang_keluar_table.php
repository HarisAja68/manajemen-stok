<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_keluar_id')->constrained('barang_keluar')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('barang_id')->constrained('barang')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('jumlah');
            $table->integer('sisa_stok');
            $table->integer('jumlah_sebelumnya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_barang_keluar');
    }
};
