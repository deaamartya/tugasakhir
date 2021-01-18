<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPeminjamanAlatBahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_peminjaman_alat_bahan', function (Blueprint $table) {
            $table->string('ID_PEMINJAMAN', 15)->index('FK_MENGGUNAKAN_5');
            $table->integer('ID_TIPE')->index('FK_MERUPAKAN_5');
            $table->string('ID_ALAT_BAHAN',20);
            $table->string('JUMLAH_PINJAM',20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_peminjaman_alat_bahan');
    }
}
