<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_stok', function (Blueprint $table) {
            $table->string('ID_HISTORI', 15)->primary();
            $table->integer('ID_TIPE')->index('FK_MERUPAKAN_4');
            $table->string('ID_ALAT_BAHAN', 20)->nullable();
            $table->dateTime('TIMESTAMP');
            $table->integer('JUMLAH_MASUK');
            $table->integer('JUMLAH_KELUAR');
            $table->boolean('KONDISI')->nullable();
            $table->integer('STOK');
            $table->text('KETERANGAN')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histori_stok');
    }
}
