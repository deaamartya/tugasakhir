<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan_barang', function (Blueprint $table) {
            $table->char('ID_PENGADAAN', 15)->primary();
            $table->timestamp('created_at');
        });

        DB::unprepared("CREATE TRIGGER `auto_id_pengadaan` BEFORE INSERT ON `pengadaan_barang` FOR EACH ROW 
            BEGIN
                SELECT SUBSTRING((MAX(`ID_PENGADAAN`)),3,13) INTO @total FROM pengadaan_barang;
                IF (@total >= 1) THEN
                    SET new.ID_PENGADAAN = CONCAT('PD',LPAD(@total+1,13,'0'));
                ELSE
                    SET new.ID_PENGADAAN = CONCAT('PD',LPAD(1,13,'0'));
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
        DB::unprepared('DROP TRIGGER `auto_id_pengadaan`');
        Schema::dropIfExists('pengadaan_barang');
    }
}
