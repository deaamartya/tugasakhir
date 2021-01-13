<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class KatalogBahanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('katalog_bahan')->delete();
        
        \DB::table('katalog_bahan')->insert(array (
            0 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/01',
                'ID_LABORATORIUM' => 1,
                'NAMA_KATALOG_BAHAN' => 'Natrium',
            ),
            1 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/02',
                'ID_LABORATORIUM' => 1,
                'NAMA_KATALOG_BAHAN' => 'Natrium Hidroksida',
            ),
            2 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/03',
                'ID_LABORATORIUM' => 1,
                'NAMA_KATALOG_BAHAN' => 'Natrium Klorida',
            ),
            3 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/04',
                'ID_LABORATORIUM' => 1,
                'NAMA_KATALOG_BAHAN' => 'Natrium Tiosulfat',
            ),
        ));
        
    }
}