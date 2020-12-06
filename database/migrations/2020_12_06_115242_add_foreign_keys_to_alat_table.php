<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->foreign('ID_KATALOG_ALAT', 'FK_BAGIAN_DARI_6')->references('ID_KATALOG_ALAT')->on('katalog_alat')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_LEMARI', 'FK_DISIMPAN_DALAM')->references('ID_LEMARI')->on('lemari')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_MERK_TIPE', 'FK_MEMILIKI_7')->references('ID_MERK_TIPE')->on('merk_tipe_alat')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->dropForeign('FK_BAGIAN_DARI_6');
            $table->dropForeign('FK_DISIMPAN_DALAM');
            $table->dropForeign('FK_MEMILIKI_7');
        });
    }
}
