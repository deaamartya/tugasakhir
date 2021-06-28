<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_stok', function (Blueprint $table) {
            $table->string('ID_HISTORI', 15)->primary();
            $table->integer('ID_TIPE')->index('FK_MERUPAKAN_4');
            $table->char('ID_TRANSAKSI',15)->nullable();
            $table->string('ID_ALAT_BAHAN', 20)->nullable();
            $table->dateTime('TIMESTAMP')->useCurrent();
            $table->integer('JUMLAH_MASUK');
            $table->integer('JUMLAH_KELUAR');
            $table->boolean('KONDISI')->nullable();
            $table->integer('STOK');
            $table->text('KETERANGAN')->nullable();
        });

        DB::unprepared("CREATE TRIGGER `update_stok` BEFORE INSERT ON `histori_stok` FOR EACH ROW 
            BEGIN
                SELECT SUBSTRING((MAX(`ID_HISTORI`)),2,14) INTO @total FROM `histori_stok`;
                IF (@total >= 1) THEN
                    SET new.ID_HISTORI = CONCAT('H',LPAD(@total+1,14,'0'));
                ELSE
                    SET new.ID_HISTORI = CONCAT('H',LPAD(1,14,'0'));
                END IF;

                IF (new.ID_TIPE = 1) THEN
                    SELECT `STOK` INTO @stok from histori_stok WHERE `ID_ALAT_BAHAN` = new.ID_ALAT_BAHAN AND KONDISI = new.KONDISI ORDER BY TIMESTAMP DESC LIMIT 1;
                    SET new.STOK = @stok+new.JUMLAH_MASUK-new.JUMLAH_KELUAR;
                ELSEIF (new.ID_TIPE > 1) THEN
                    SELECT `STOK` INTO @stok from histori_stok WHERE `ID_ALAT_BAHAN` = new.ID_ALAT_BAHAN ORDER BY TIMESTAMP DESC LIMIT 1;
                    SET new.STOK = @stok+new.JUMLAH_MASUK-new.JUMLAH_KELUAR;
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
        DB::unprepared('DROP TRIGGER `update_stok`');
        Schema::dropIfExists('histori_stok');
    }
}
