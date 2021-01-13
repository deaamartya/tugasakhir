<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanKimiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_kimia', function (Blueprint $table) {
            $table->string('ID_BAHAN_KIMIA', 10)->primary();
            $table->string('ID_KATALOG_BAHAN', 20)->index('FK_BAGIAN_DARI_7');
            $table->integer('ID_LEMARI')->index('FK_DISIMPAN3');
            $table->string('RUMUS', 40);
            $table->string('WUJUD', 30);
            $table->float('JUMLAH_BAHAN_KIMIA', 10, 0);
            $table->boolean('SPESIFIKASI_BAHAN');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahan_kimia');
    }
}
