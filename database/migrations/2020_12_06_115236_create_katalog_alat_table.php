<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKatalogAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('katalog_alat', function (Blueprint $table) {
            $table->string('ID_KATALOG_ALAT', 15)->primary();
            $table->integer('ID_KATEGORI_ALAT')->index('FK_BAGIAN_DARI_4');
            $table->string('NAMA_ALAT', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('katalog_alat');
    }
}
