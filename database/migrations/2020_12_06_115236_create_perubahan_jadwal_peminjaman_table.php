<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerubahanJadwalPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perubahan_jadwal_peminjaman', function (Blueprint $table) {
            $table->string('ID_PERUBAHAN_JADWAL', 15)->primary();
            $table->string('ID_PEMINJAMAN')->index('FK_PERUBAHAN_JADWAL');
            $table->integer('ID_USER')->index('FK_DIPROSES');
            $table->date('TANGGAL_LAMA');
            $table->date('TANGGAL_BARU');
            $table->text('PESAN');
            $table->boolean('STATUS_PERUBAHAN');
        });

        DB::unprepared("CREATE TRIGGER `auto_id_perubahan_jadwal` BEFORE INSERT ON `perubahan_jadwal_peminjaman` FOR EACH ROW 
            BEGIN
                SELECT SUBSTRING((MAX(`ID_PERUBAHAN_JADWAL`)),2,13) INTO @total FROM perubahan_jadwal_peminjaman;
                IF (@total >= 1) THEN
                    SET new.ID_PERUBAHAN_JADWAL = CONCAT('PJ',LPAD(@total+1,13,'0'));
                ELSE
                    SET new.ID_PERUBAHAN_JADWAL = CONCAT('PJ',LPAD(1,13,'0'));
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
        DB::unprepared('DROP TRIGGER `auto_id_perubahan_jadwal`');
        Schema::dropIfExists('perubahan_jadwal_peminjaman');
    }
}
