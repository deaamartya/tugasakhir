<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTipeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipe_user', function (Blueprint $table) {
            $table->foreign('ID_LABORATORIUM', 'FK_LABORATORIUM')->references('ID_LABORATORIUM')->on('laboratorium')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipe_user', function (Blueprint $table) {
            $table->dropForeign('FK_LABORATORIUM');
        });
    }
}
