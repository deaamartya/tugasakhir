<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_alat', function (Blueprint $table) {
            $table->integer('ID_KATEGORI_ALAT', true);
            $table->integer('ID_LABORATORIUM')->index('FK_MILIK');
            $table->string('NAMA_KATEGORI', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_alat');
    }
}
