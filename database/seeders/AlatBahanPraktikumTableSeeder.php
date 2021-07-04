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
                'ID_TIPE' => 3,
                'ID_PRAKTIKUM' => 'P000000001',
                'JUMLAH' => 10,
            ),
            1 => 
            array (
                'ID_ALAT_BAHAN' => 'KGE11/0501',
                'ID_TIPE' => 1,
                'ID_PRAKTIKUM' => 'P000000001',
                'JUMLAH' => 5,
            ),
            2 => 
            array (
                'ID_ALAT_BAHAN' => 'L1/B001',
                'ID_TIPE' => 2,
                'ID_PRAKTIKUM' => 'P000000001',
                'JUMLAH' => 3,
            ),
            3 => 
            array (
                'ID_ALAT_BAHAN' => 'BN/151',
                'ID_TIPE' => 3,
                'ID_PRAKTIKUM' => 'P000000002',
                'JUMLAH' => 10,
            ),
            4 => 
            array (
                'ID_ALAT_BAHAN' => 'BN/152',
                'ID_TIPE' => 3,
                'ID_PRAKTIKUM' => 'P000000002',
                'JUMLAH' => 10,
            ),
            5 => 
            array (
                'ID_ALAT_BAHAN' => 'KBR30/0501',
                'ID_TIPE' => 1,
                'ID_PRAKTIKUM' => 'P000000002',
                'JUMLAH' => 4,
            ),
            6 => 
            array (
                'ID_ALAT_BAHAN' => 'KGE11/0501',
                'ID_TIPE' => 1,
                'ID_PRAKTIKUM' => 'P000000002',
                'JUMLAH' => 2,
            ),
            7 => 
            array (
                'ID_ALAT_BAHAN' => 'KGE11/0503',
                'ID_TIPE' => 1,
                'ID_PRAKTIKUM' => 'P000000002',
                'JUMLAH' => 2,
            ),
            8 => 
            array (
                'ID_ALAT_BAHAN' => 'BN/014',
                'ID_TIPE' => 3,
                'ID_PRAKTIKUM' => 'P000000003',
                'JUMLAH' => 10,
            ),
            9 => 
            array (
                'ID_ALAT_BAHAN' => 'BN/151',
                'ID_TIPE' => 3,
                'ID_PRAKTIKUM' => 'P000000003',
                'JUMLAH' => 10,
            ),
            10 => 
            array (
                'ID_ALAT_BAHAN' => 'KCR15/0751',
                'ID_TIPE' => 1,
                'ID_PRAKTIKUM' => 'P000000003',
                'JUMLAH' => 1,
            ),
            11 => 
            array (
                'ID_ALAT_BAHAN' => 'KGE11/0501',
                'ID_TIPE' => 1,
                'ID_PRAKTIKUM' => 'P000000003',
                'JUMLAH' => 1,
            ),
            12 => 
            array (
                'ID_ALAT_BAHAN' => 'KGE11/0502',
                'ID_TIPE' => 1,
                'ID_PRAKTIKUM' => 'P000000003',
                'JUMLAH' => 1,
            ),
            13 => 
            array (
                'ID_ALAT_BAHAN' => 'KTE25/1101',
                'ID_TIPE' => 1,
                'ID_PRAKTIKUM' => 'P000000003',
                'JUMLAH' => 1,
            ),
            14 => 
            array (
                'ID_ALAT_BAHAN' => 'BN/111',
                'ID_TIPE' => 3,
                'ID_PRAKTIKUM' => 'P000000004',
                'JUMLAH' => 10,
            ),
            15 => 
            array (
                'ID_ALAT_BAHAN' => 'BN/121',
                'ID_TIPE' => 3,
                'ID_PRAKTIKUM' => 'P000000004',
                'JUMLAH' => 10,
            ),
            16 => 
            array (
                'ID_ALAT_BAHAN' => 'KGE11/0501',
                'ID_TIPE' => 1,
                'ID_PRAKTIKUM' => 'P000000004',
                'JUMLAH' => 1,
            ),
            17 => 
            array (
                'ID_ALAT_BAHAN' => 'KGE11/0503',
                'ID_TIPE' => 1,
                'ID_PRAKTIKUM' => 'P000000004',
                'JUMLAH' => 1,
            ),
        ));
        
        
    }
}