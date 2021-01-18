<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePraktikumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('praktikum', function (Blueprint $table) {
            $table->char('ID_PRAKTIKUM', 10)->primary();
            $table->integer('ID_LABORATORIUM')->index('FK_BAGIAN_DARI');
            $table->char('ID_MAPEL', 5)->index('FK_BAGIAN_DARI_2');
            $table->char('ID_KELAS', 10)->index('FK_DILAKUKAN');
            $table->string('NAMA_PRAKTIKUM', 100);
        });

        DB::unprepared("CREATE TRIGGER `auto_id_praktikum` BEFORE INSERT ON `praktikum` FOR EACH ROW 
            BEGIN
                SELECT COUNT(`ID_PRAKTIKUM`) INTO @total FROM praktikum WHERE `ID_LABORATORIUM` = new.ID_LABORATORIUM;
                IF (@total >= 1) THEN
                    SET new.ID_PRAKTIKUM = CONCAT('P',new.ID_LABORATORIUM,LPAD(@total+1,8,'0'));
                ELSE
                    SET new.ID_PRAKTIKUM = CONCAT('P',new.ID_LABORATORIUM,LPAD(1,8,'0'));
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
        DB::unprepared('DROP TRIGGER `auto_id_praktikum`');
        Schema::dropIfExists('praktikum');
    }
}
