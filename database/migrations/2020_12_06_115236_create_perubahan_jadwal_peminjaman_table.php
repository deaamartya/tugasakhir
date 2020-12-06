<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerubahanJadwalPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perubahan_jadwal_peminjaman', function (Blueprint $table) {
            $table->integer('ID_PERUBAHAN_JADWAL', true);
            $table->integer('ID_PEMINJAMAN')->index('FK_PERUBAHAN_JADWAL');
            $table->integer('ID_USER')->index('FK_DIPROSES');
            $table->date('TANGGAL_LAMA');
            $table->date('TANGGAL_BARU');
            $table->text('PESAN');
            $table->boolean('STATUS_PERUBAHAN');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perubahan_jadwal_peminjaman');
    }
}
