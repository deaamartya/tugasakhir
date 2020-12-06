<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanAlatBahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_alat_bahan', function (Blueprint $table) {
            $table->integer('ID_PEMINJAMAN', true);
            $table->integer('ID_RUANG_LABORATORIUM')->index('FK_MENGGUNAKAN');
            $table->char('ID_PRAKTIKUM', 10)->index('FK_MEMILIKI');
            $table->date('TANGGAL_PEMINJAMAN');
            $table->string('STATUS_PEMINJAMAN', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman_alat_bahan');
    }
}
