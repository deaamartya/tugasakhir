<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanKimiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_kimia', function (Blueprint $table) {
            $table->string('ID_BAHAN_KIMIA', 10)->primary();
            $table->string('ID_KATALOG_BAHAN', 20)->index('FK_BAGIAN_DARI_7');
            $table->integer('ID_LEMARI')->index('FK_DISIMPAN3');
            $table->text('RUMUS');
            $table->string('WUJUD',30);
            $table->boolean('SPESIFIKASI_BAHAN')->comment('0: Pro Analis, 1: Teknis');
        });

        DB::unprepared("CREATE TRIGGER `auto_id_bahan_kimia` BEFORE INSERT ON `bahan_kimia` FOR EACH ROW 
            BEGIN
                SELECT COUNT(`ID_BAHAN_KIMIA`) INTO @total FROM bahan_kimia WHERE `ID_KATALOG_BAHAN` = new.ID_KATALOG_BAHAN;
                IF (@total >= 1) THEN
                    SET new.ID_BAHAN_KIMIA = CONCAT(new.ID_KATALOG_BAHAN,@total+1);
                ELSE
                    SET new.ID_BAHAN_KIMIA = CONCAT(new.ID_KATALOG_BAHAN,1);
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
        DB::unprepared('DROP TRIGGER `auto_id_bahan_kimia`');
        Schema::dropIfExists('bahan_kimia');
    }
}
