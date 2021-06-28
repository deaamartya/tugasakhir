<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class BahanKimiaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bahan_kimia')->delete();
        
        \DB::table('bahan_kimia')->insert(array (
            0 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/011',
                'ID_KATALOG_BAHAN' => 'BN/01',
                'ID_LEMARI' => 10,
                'RUMUS' => 'Na',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
        ));
        
        
    }
}