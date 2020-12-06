<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHistoriStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('histori_stok', function (Blueprint $table) {
            $table->foreign('ID_TIPE', 'FK_MERUPAKAN_4')->references('ID_TIPE')->on('tipe')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('histori_stok', function (Blueprint $table) {
            $table->dropForeign('FK_MERUPAKAN_4');
        });
    }
}
