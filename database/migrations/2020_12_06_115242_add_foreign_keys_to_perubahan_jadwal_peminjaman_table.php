<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPerubahanJadwalPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perubahan_jadwal_peminjaman', function (Blueprint $table) {
            $table->foreign('ID_USER', 'FK_DIPROSES')->references('ID_USER')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_PEMINJAMAN', 'FK_PERUBAHAN_JADWAL')->references('ID_PEMINJAMAN')->on('peminjaman_alat_bahan')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perubahan_jadwal_peminjaman', function (Blueprint $table) {
            $table->dropForeign('FK_DIPROSES');
            $table->dropForeign('FK_PERUBAHAN_JADWAL');
        });
    }
}
