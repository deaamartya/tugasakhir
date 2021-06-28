<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPraktikumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('praktikum', function (Blueprint $table) {
            $table->foreign('ID_MAPEL', 'FK_BAGIAN_DARI_2')->references('ID_MAPEL')->on('mata_pelajaran')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('praktikum', function (Blueprint $table) {
            $table->dropForeign('FK_BAGIAN_DARI');
            $table->dropForeign('FK_BAGIAN_DARI_2');
            $table->dropForeign('FK_DILAKUKAN');
        });
    }
}
