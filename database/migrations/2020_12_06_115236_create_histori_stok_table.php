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
            $table->string('ID_ALAT_BAHAN', 20)->nullable();
            $table->dateTime('TIMESTAMP')->useCurrent();
            $table->integer('JUMLAH_MASUK');
            $table->integer('JUMLAH_KELUAR');
            $table->boolean('KONDISI')->nullable();
            $table->integer('STOK')->nullable();
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
                    IF(new.KONDISI = 1) THEN
                        SELECT `JUMLAH_BAGUS` INTO @stok FROM alat WHERE `ID_ALAT`=new.ID_ALAT_BAHAN;
                        SET new.STOK = @stok+new.JUMLAH_MASUK-new.JUMLAH_KELUAR;
                        UPDATE `alat` SET `JUMLAH_BAGUS` = @stok+new.JUMLAH_MASUK-new.JUMLAH_KELUAR WHERE `ID_ALAT` = new.ID_ALAT_BAHAN;
                    ELSE
                        SELECT `JUMLAH_RUSAK` INTO @stok FROM alat WHERE `ID_ALAT`=new.ID_ALAT_BAHAN;
                        SET new.STOK = @stok+new.JUMLAH_MASUK-new.JUMLAH_KELUAR;
                        UPDATE `alat` SET `JUMLAH_RUSAK` = @stok+new.JUMLAH_MASUK-new.JUMLAH_KELUAR WHERE `ID_ALAT` = new.ID_ALAT_BAHAN;
                    END IF;
                ELSEIF (new.ID_TIPE = 2) THEN
                    SELECT `JUMLAH` INTO @stok FROM bahan WHERE `ID_BAHAN` = new.ID_ALAT_BAHAN;
                    SET new.STOK = @stok+new.JUMLAH_MASUK-new.JUMLAH_KELUAR;
                    UPDATE `bahan` SET `JUMLAH` = @stok+new.JUMLAH_MASUK-new.JUMLAH_KELUAR WHERE `ID_BAHAN` = new.ID_ALAT_BAHAN;
                ELSEIF (new.ID_TIPE = 3) THEN
                    SELECT `JUMLAH_BAHAN_KIMIA` INTO @stok FROM bahan_kimia WHERE `ID_BAHAN_KIMIA` = new.ID_ALAT_BAHAN;
                    SET new.STOK = @stok+new.JUMLAH_MASUK-new.JUMLAH_KELUAR;
                    UPDATE `bahan_kimia` SET `JUMLAH_BAHAN_KIMIA` = @stok+new.JUMLAH_MASUK-new.JUMLAH_KELUAR WHERE `ID_BAHAN_KIMIA` = new.ID_ALAT_BAHAN;
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
