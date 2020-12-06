<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat', function (Blueprint $table) {
            $table->string('ID_ALAT', 16)->primary();
            $table->string('ID_KATALOG_ALAT', 15)->index('FK_BAGIAN_DARI_6');
            $table->integer('ID_LEMARI')->index('FK_DISIMPAN_DALAM');
            $table->integer('ID_MERK_TIPE')->index('FK_MEMILIKI_7');
            $table->string('UKURAN', 20);
            $table->integer('JUMLAH_BAGUS');
            $table->integer('JUMLAH_RUSAK');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alat');
    }
}
