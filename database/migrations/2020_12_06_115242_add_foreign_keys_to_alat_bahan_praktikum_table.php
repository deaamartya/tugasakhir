<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAlatBahanPraktikumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alat_bahan_praktikum', function (Blueprint $table) {
            $table->foreign('ID_PRAKTIKUM', 'FK_MEMBUTUHKAN')->references('ID_PRAKTIKUM')->on('praktikum')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_TIPE', 'FK_MERUPAKAN_3')->references('ID_TIPE')->on('tipe')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alat_bahan_praktikum', function (Blueprint $table) {
            $table->dropForeign('FK_MEMBUTUHKAN');
            $table->dropForeign('FK_MERUPAKAN_3');
        });
    }
}
