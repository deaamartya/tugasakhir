<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePraktikumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('praktikum', function (Blueprint $table) {
            $table->char('ID_PRAKTIKUM', 10)->primary();
            $table->integer('ID_LABORATORIUM')->index('FK_BAGIAN_DARI');
            $table->char('ID_MAPEL', 5)->index('FK_BAGIAN_DARI_2');
            $table->char('ID_KELAS', 5)->index('FK_DILAKUKAN');
            $table->string('NAMA_PRAKTIKUM', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('praktikum');
    }
}
