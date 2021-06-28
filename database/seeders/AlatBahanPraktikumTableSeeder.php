<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class AlatBahanPraktikumTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('alat_bahan_praktikum')->delete();
        
        \DB::table('alat_bahan_praktikum')->insert(array (
            0 => 
            array (
                'ID_ALAT_BAHAN' => 'BN/011',
                'ID_PRAKTIKUM' => 'P000000001',
                'ID_TIPE' => 3,
                'JUMLAH' => 10,
            ),
            1 => 
            array (
                'ID_ALAT_BAHAN' => 'KGE11/0501',
                'ID_PRAKTIKUM' => 'P000000001',
                'ID_TIPE' => 1,
                'JUMLAH' => 5,
            ),
            2 => 
            array (
                'ID_ALAT_BAHAN' => 'L1/B001',
                'ID_PRAKTIKUM' => 'P000000001',
                'ID_TIPE' => 2,
                'JUMLAH' => 3,
            ),
        ));
        
        
    }
}