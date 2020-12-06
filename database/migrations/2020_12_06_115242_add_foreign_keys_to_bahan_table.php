<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bahan', function (Blueprint $table) {
            $table->foreign('ID_LEMARI', 'FK_DISIMPAN2')->references('ID_LEMARI')->on('lemari')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bahan', function (Blueprint $table) {
            $table->dropForeign('FK_DISIMPAN2');
        });
    }
}
