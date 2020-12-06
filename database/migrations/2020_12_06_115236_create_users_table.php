<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('ID_USER', true);
            $table->integer('ID_TIPE_USER')->index('FK_MERUPAKAN');
            $table->string('USERNAME', 16);
            $table->string('PASSWORD');
            $table->string('PATH_FOTO')->nullable();
            $table->string('NAMA_LENGKAP', 60);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
