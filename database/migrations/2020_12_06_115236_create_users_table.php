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
            $table->string('username', 16)->unique();
            $table->string('password');
            $table->string('PATH_FOTO')->nullable();
            $table->string('NAMA_LENGKAP', 60);
            $table->integer('ID_LABORATORIUM')->index('FK_LABORATORIUM')->nullable();
            $table->boolean('ONLINE')->default(0);
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
