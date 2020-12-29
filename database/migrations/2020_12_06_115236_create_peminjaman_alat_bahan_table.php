<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanAlatBahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_alat_bahan', function (Blueprint $table) {
            $table->string('ID_PEMINJAMAN', 15)->primary();
            $table->integer('ID_RUANG_LABORATORIUM')->index('FK_MENGGUNAKAN');
            $table->char('ID_PRAKTIKUM', 10)->index('FK_MEMILIKI');
            $table->date('TANGGAL_PEMINJAMAN');
            $table->string('STATUS_PEMINJAMAN', 30);
        });

        DB::unprepared("CREATE TRIGGER `auto_id_peminjaman` BEFORE INSERT ON `peminjaman_alat_bahan` FOR EACH ROW 
            BEGIN
                SELECT SUBSTRING((MAX(`ID_PEMINJAMAN`)),2,14) INTO @total FROM peminjaman_alat_bahan;
                IF (@total >= 1) THEN
                    SET new.ID_PEMINJAMAN = CONCAT('P',LPAD(@total+1,14,'0'));
                ELSE
                    SET new.ID_PEMINJAMAN = CONCAT('P',LPAD(1,14,'0'));
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
        DB::unprepared('DROP TRIGGER `auto_id_peminjaman`');
        Schema::dropIfExists('peminjaman_alat_bahan');
    }
}
