<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('ID_TAHUN_AKADEMIK', 'FK_DILAKSANAKAN_PADA')->references('ID_TAHUN_AKADEMIK')->on('tahun_akademik')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_USER', 'FK_MENGAJAR')->references('ID_USER')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_JENIS_KELAS', 'FK_MERUPAKAN_2')->references('ID_JENIS_KELAS')->on('jenis_kelas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('ID_MAPEL', 'FK_MAPEL')->references('ID_MAPEL')->on('mata_pelajaran')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign('FK_DILAKSANAKAN_PADA');
            $table->dropForeign('FK_MENGAJAR');
            $table->dropForeign('FK_MERUPAKAN_2');
            $table->dropForeign('FK_MAPEL');
        });
    }
}
