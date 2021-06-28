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
            $table->char('ID_KELAS', 10)->primary();
            $table->integer('ID_TAHUN_AKADEMIK')->index('FK_DILAKSANAKAN_PADA');
            $table->char('ID_MAPEL',5)->index('FK_MAPEL');
            $table->integer('ID_USER')->index('FK_MENGAJAR');
            $table->integer('ID_JENIS_KELAS')->index('FK_MERUPAKAN_2');
        });
        DB::unprepared("CREATE TRIGGER `auto_id_kelas` BEFORE INSERT ON `kelas` FOR EACH ROW 
            BEGIN
                SELECT SUBSTRING((MAX(`ID_KELAS`)),2,9) INTO @total FROM kelas;
                IF (@total >= 1) THEN
                    SET new.ID_KELAS = CONCAT('K',LPAD(@total+1,9,'0'));
                ELSE
                    SET new.ID_KELAS = CONCAT('K',LPAD(1,9,'0'));
                END IF;
            END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `auto_id_kelas`');
        Schema::dropIfExists('kelas');
    }
}
