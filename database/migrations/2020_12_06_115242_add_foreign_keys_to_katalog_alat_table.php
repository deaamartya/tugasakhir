<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToKatalogAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('katalog_alat', function (Blueprint $table) {
            $table->foreign('ID_KATEGORI_ALAT', 'FK_BAGIAN_DARI_4')->references('ID_KATEGORI_ALAT')->on('kategori_alat')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('katalog_alat', function (Blueprint $table) {
            $table->dropForeign('FK_BAGIAN_DARI_4');
        });
    }
}
