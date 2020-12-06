<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangLaboratoriumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruang_laboratorium', function (Blueprint $table) {
            $table->integer('ID_RUANG_LABORATORIUM', true);
            $table->integer('ID_LABORATORIUM')->index('FK_BAGIAN_DARI_3');
            $table->string('NAMA_RUANG_LABORATORIUM', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruang_laboratorium');
    }
}
