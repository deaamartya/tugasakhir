<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToKatalogBahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('katalog_bahan', function (Blueprint $table) {
            $table->foreign('ID_LABORATORIUM', 'FK_MILIK_2')->references('ID_LABORATORIUM')->on('laboratorium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('katalog_bahan', function (Blueprint $table) {
            $table->dropForeign('FK_MILIK_2');
        });
    }
}
