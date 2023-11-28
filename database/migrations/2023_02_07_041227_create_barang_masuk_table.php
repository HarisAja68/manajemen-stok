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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barang')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('supplier_id')->constrained('suppliers')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('penerima')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('jumlah');
            $table->integer('jumlah_sebelumnya');
            $table->integer('total_stok');
            $table->date('tgl_masuk');
            $table->string('foto_nota');
            $table->text('keterangan');
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
        Schema::dropIfExists('barang_masuk');
    }
};
