<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLemariTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lemari', function (Blueprint $table) {
            $table->integer('ID_LEMARI', true);
            $table->integer('ID_LABORATORIUM')->index('FK_MILIK3');
            $table->string('NAMA_LEMARI', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lemari');
    }
}
