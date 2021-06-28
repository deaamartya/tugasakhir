<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat', function (Blueprint $table) {
            $table->string('ID_ALAT', 20)->primary();
            $table->string('ID_KATALOG_ALAT', 15)->index('FK_BAGIAN_DARI_6');
            $table->integer('ID_LEMARI')->index('FK_DISIMPAN_DALAM');
            $table->integer('ID_MERK_TIPE')->index('FK_MEMILIKI_7');
        });

        DB::unprepared("CREATE TRIGGER `auto_id_alat` BEFORE INSERT ON `alat` FOR EACH ROW 
            BEGIN
                SELECT COUNT(`ID_ALAT`) INTO @total FROM alat WHERE `ID_KATALOG_ALAT` = new.ID_KATALOG_ALAT;
                IF (@total >= 1) THEN
                    SET new.ID_ALAT = CONCAT(new.ID_KATALOG_ALAT,@total+1);
                ELSE
                    SET new.ID_ALAT = CONCAT(new.ID_KATALOG_ALAT,1);
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
        DB::unprepared('DROP TRIGGER `auto_id_alat`');
        Schema::dropIfExists('alat');
    }
}
