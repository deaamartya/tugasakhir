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
            $table->char('ID_MAPEL', 5)->index('FK_BAGIAN_DARI_2');
            $table->string('JUDUL_PRAKTIKUM', 100);
        });

        DB::unprepared("CREATE TRIGGER `auto_id_praktikum` BEFORE INSERT ON `praktikum` FOR EACH ROW 
            BEGIN
                SELECT SUBSTRING((MAX(`ID_PRAKTIKUM`)),2,9) INTO @total FROM praktikum;
                IF (@total >= 1) THEN
                    SET new.ID_PRAKTIKUM = CONCAT('P',LPAD(@total+1,8,'0'));
                ELSE
                    SET new.ID_PRAKTIKUM = CONCAT('P',LPAD(1,8,'0'));
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
