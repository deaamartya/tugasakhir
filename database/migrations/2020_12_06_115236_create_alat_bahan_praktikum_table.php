<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatBahanPraktikumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat_bahan_praktikum', function (Blueprint $table) {
            $table->integer('ID_TIPE')->index('FK_MERUPAKAN_3');
            $table->char('ID_PRAKTIKUM', 10);
            $table->string('ID_ALAT_BAHAN', 20);
            $table->integer('JUMLAH');
            $table->primary(['ID_PRAKTIKUM', 'ID_ALAT_BAHAN']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alat_bahan_praktikum');
    }
}
