<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('ID_TIPE_USER', 'FK_MERUPAKAN')->references('ID_TIPE_USER')->on('tipe_user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_LABORATORIUM', 'FK_LABORATORIUM')->references('ID_LABORATORIUM')->on('laboratorium')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('FK_MERUPAKAN');
            $table->dropForeign('FK_LABORATORIUM');
        });
    }
}
