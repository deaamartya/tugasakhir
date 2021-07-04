<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class BahanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bahan')->delete();
        
        \DB::table('bahan')->insert(array (
            0 => 
            array (
                'ID_BAHAN' => 'B001',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN' => 'Kertas saring',
            ),
            1 => 
            array (
                'ID_BAHAN' => 'B002',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN' => 'Lakmus merah',
            ),
            2 => 
            array (
                'ID_BAHAN' => 'B003',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN' => 'Lakmus biru',
            ),
            3 => 
            array (
                'ID_BAHAN' => 'B004',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN' => 'Indicator universal',
            ),
            4 => 
            array (
                'ID_BAHAN' => 'L1/B001',
                'ID_LEMARI' => 11,
                'NAMA_BAHAN' => 'Kertas grafik/millimeter',
            ),
            5 => 
            array (
                'ID_BAHAN' => 'L1/B002',
                'ID_LEMARI' => 11,
                'NAMA_BAHAN' => 'Kertas grafik/millimeter 2cm',
            ),
        ));
        
        
    }
}