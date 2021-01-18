<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDetailPeminjamanAlatBahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_peminjaman_alat_bahan', function (Blueprint $table) {
            $table->foreign('ID_PEMINJAMAN', 'FK_MENGGUNAKAN_5')->references('ID_PEMINJAMAN')->on('peminjaman_alat_bahan')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('ID_TIPE', 'FK_MERUPAKAN_5')->references('ID_TIPE')->on('tipe')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_peminjaman_alat_bahan', function (Blueprint $table) {
            $table->dropForeign('FK_MENGGUNAKAN_5');
            $table->dropForeign('FK_MERUPAKAN_5');
        });
    }
}
