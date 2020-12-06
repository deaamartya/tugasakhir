<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRuangLaboratoriumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ruang_laboratorium', function (Blueprint $table) {
            $table->foreign('ID_LABORATORIUM', 'FK_BAGIAN_DARI_3')->references('ID_LABORATORIUM')->on('laboratorium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ruang_laboratorium', function (Blueprint $table) {
            $table->dropForeign('FK_BAGIAN_DARI_3');
        });
    }
}
