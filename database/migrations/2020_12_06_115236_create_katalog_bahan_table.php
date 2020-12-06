<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKatalogBahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('katalog_bahan', function (Blueprint $table) {
            $table->string('ID_KATALOG_BAHAN', 20)->primary();
            $table->integer('ID_LABORATORIUM')->index('FK_MILIK_2');
            $table->string('NAMA_KATALOG_BAHAN', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('katalog_bahan');
    }
}
