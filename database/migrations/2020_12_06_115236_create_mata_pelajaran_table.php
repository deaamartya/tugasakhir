<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataPelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_pelajaran', function (Blueprint $table) {
            $table->char('ID_MAPEL', 5)->primary();
            $table->string('NAMA_MAPEL', 50);
        });

        DB::unprepared("CREATE TRIGGER `auto_id_mapel` BEFORE INSERT ON `mata_pelajaran` FOR EACH ROW 
            BEGIN
                SELECT SUBSTRING((MAX(`ID_MAPEL`)),2,4) INTO @total FROM mata_pelajaran;
                IF (@total >= 1) THEN
                    SET new.ID_MAPEL = CONCAT('M',LPAD(@total+1,4,'0'));
                ELSE
                    SET new.ID_MAPEL = CONCAT('M',LPAD(1,4,'0'));
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
        DB::unprepared('DROP TRIGGER `auto_id_mapel`');
        Schema::dropIfExists('mata_pelajaran');
    }
}
