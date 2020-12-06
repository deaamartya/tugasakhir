<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPeminjamanAlatBahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjaman_alat_bahan', function (Blueprint $table) {
            $table->foreign('ID_PRAKTIKUM', 'FK_MEMILIKI')->references('ID_PRAKTIKUM')->on('praktikum')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_RUANG_LABORATORIUM', 'FK_MENGGUNAKAN')->references('ID_RUANG_LABORATORIUM')->on('ruang_laboratorium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminjaman_alat_bahan', function (Blueprint $table) {
            $table->dropForeign('FK_MEMILIKI');
            $table->dropForeign('FK_MENGGUNAKAN');
        });
    }
}
