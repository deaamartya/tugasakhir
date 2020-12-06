<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->char('ID_KELAS', 5)->primary();
            $table->integer('ID_TAHUN_AKADEMIK')->index('FK_DILAKSANAKAN_PADA');
            $table->integer('ID_USER')->index('FK_MENGAJAR');
            $table->integer('ID_JENIS_KELAS')->index('FK_MERUPAKAN_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
