<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBahanKimiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bahan_kimia', function (Blueprint $table) {
            $table->foreign('ID_KATALOG_BAHAN', 'FK_BAGIAN_DARI_7')->references('ID_KATALOG_BAHAN')->on('katalog_bahan')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_LEMARI', 'FK_DISIMPAN3')->references('ID_LEMARI')->on('lemari')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bahan_kimia', function (Blueprint $table) {
            $table->dropForeign('FK_BAGIAN_DARI_7');
            $table->dropForeign('FK_DISIMPAN3');
        });
    }
}
