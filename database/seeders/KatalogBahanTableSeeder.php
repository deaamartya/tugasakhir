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
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Natrium',
            ),
            1 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/02',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Kalium',
            ),
            2 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/03',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Magnesium',
            ),
            3 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/04',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Kalsium',
            ),
            4 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/05',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Stronsium',
            ),
            5 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/06',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Barium',
            ),
            6 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/07',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Alumunium',
            ),
            7 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/08',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Belerang',
            ),
            8 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/09',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Besi',
            ),
            9 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/10',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Nikel',
            ),
            10 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/11',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Tembaga',
            ),
            11 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/12',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Seng',
            ),
            12 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/13',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Timah',
            ),
            13 => 
            array (
                'ID_KATALOG_BAHAN' => 'BN/14',
                'ID_LABORATORIUM' => 2,
                'NAMA_KATALOG_BAHAN' => 'Timbal',
            ),
        ));
        
        
    }
}