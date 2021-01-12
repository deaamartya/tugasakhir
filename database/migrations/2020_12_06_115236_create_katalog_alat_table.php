<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKatalogAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('katalog_alat', function (Blueprint $table) {
            $table->string('ID_KATALOG_ALAT', 15)->primary();
            $table->integer('ID_KATEGORI_ALAT')->index('FK_BAGIAN_DARI_4');
            $table->string('NAMA_ALAT', 100);
        });

        DB::unprepared("CREATE TRIGGER `auto_id_katalog` BEFORE INSERT ON `katalog_alat` FOR EACH ROW 
            BEGIN
                SELECT SUBSTRING((MAX(`ID_KATALOG_ALAT`)),2,14) INTO @total FROM katalog_alat;
                IF (@total >= 1) THEN
                    SET new.ID_KATALOG_ALAT = CONCAT('K',LPAD(@total+1,14,'0'));
                ELSE
                    SET new.ID_KATALOG_ALAT = CONCAT('K',LPAD(1,14,'0'));
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
        DB::unprepared('DROP TRIGGER `auto_id_katalog`');
        Schema::dropIfExists('katalog_alat');
    }
}
