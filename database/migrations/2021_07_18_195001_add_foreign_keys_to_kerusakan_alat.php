<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToKerusakanAlat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kerusakan_alat', function (Blueprint $table) {
            $table->foreign('ID_KELAS', 'FK_KELAS')->references('ID_KELAS')->on('kelas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_PEMINJAMAN', 'FK_PEMINJAMAN')->references('ID_PEMINJAMAN')->on('peminjaman_alat_bahan')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_ALAT', 'FK_ALAT')->references('ID_ALAT')->on('alat')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kerusakan_alat', function (Blueprint $table) {
            $table->dropForeign('FK_KELAS');
            $table->dropForeign('FK_PEMINJAMAN');
            $table->dropForeign('FK_ALAT');
        });
    }
}
