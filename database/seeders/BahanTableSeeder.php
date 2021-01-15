<?php

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
                'ID_BAHAN' => 'L1/B001',
                'ID_LEMARI' => 11,
                'NAMA_BAHAN' => 'Kertas grafik/millimeter',
                'JUMLAH' => 100,
            ),
            1 => 
            array (
                'ID_BAHAN' => 'L1/B002',
                'ID_LEMARI' => 11,
                'NAMA_BAHAN' => 'Kertas grafik/millimeter 2cm',
                'JUMLAH' => 1000,
            ),
        ));
        
        
    }
}