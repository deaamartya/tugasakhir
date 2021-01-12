<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_user', function (Blueprint $table) {
            $table->integer('ID_TIPE_USER', true);
            $table->string('NAMA_TIPE_USER', 50);
            $table->integer('ID_LABORATORIUM')->index('FK_LABORATORIUM')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_user');
    }
}
