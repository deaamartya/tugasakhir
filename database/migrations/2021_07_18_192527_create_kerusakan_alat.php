<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerusakanAlat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerusakan_alat', function (Blueprint $table) {
            $table->char('ID_KERUSAKAN', 15)->primary();
            $table->char('ID_KELAS', 10)->index('FK_KELAS');
            $table->text('KETERANGAN_RUSAK');
            $table->boolean('STATUS');
        });

        DB::unprepared("CREATE TRIGGER `auto_id_kerusakan` BEFORE INSERT ON `kerusakan_alat` FOR EACH ROW 
            BEGIN
                SELECT SUBSTRING((MAX(`ID_KERUSAKAN`)),3,13) INTO @total FROM kerusakan_alat;
                IF (@total >= 1) THEN
                    SET new.ID_KERUSAKAN = CONCAT('KR',LPAD(@total+1,13,'0'));
                ELSE
                    SET new.ID_KERUSAKAN = CONCAT('KR',LPAD(1,13,'0'));
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
        DB::unprepared('DROP TRIGGER `auto_id_kerusakan`');
        Schema::dropIfExists('kerusakan_alat');
    }
}
