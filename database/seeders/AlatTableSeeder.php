<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class AlatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('alat')->delete();
        
        \DB::table('alat')->insert(array (
            0 => 
            array (
                'ID_ALAT' => 'KGE11/0501',
                'ID_KATALOG_ALAT' => 'KGE11/050',
                'ID_LEMARI' => 1,
                'ID_MERK_TIPE' => 1,
                'JUMLAH_BAGUS' => 8,
                'JUMLAH_RUSAK' => 0,
            ),
            1 => 
            array (
                'ID_ALAT' => 'KGE11/0502',
                'ID_KATALOG_ALAT' => 'KGE11/050',
                'ID_LEMARI' => 1,
                'ID_MERK_TIPE' => 2,
                'JUMLAH_BAGUS' => 8,
                'JUMLAH_RUSAK' => 0,
            ),
            2 => 
            array (
                'ID_ALAT' => 'KGE11/0503',
                'ID_KATALOG_ALAT' => 'KGE11/050',
                'ID_LEMARI' => 1,
                'ID_MERK_TIPE' => 3,
                'JUMLAH_BAGUS' => 8,
                'JUMLAH_RUSAK' => 0,
            ),
        ));
        
        
    }
}