<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class MerkTipeAlatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('merk_tipe_alat')->delete();
        
        \DB::table('merk_tipe_alat')->insert(array (
            0 => 
            array (
                'ID_MERK_TIPE' => 1,
                'NAMA_MERK_TIPE' => 'Iwaki Pyrex',
            ),
            1 => 
            array (
                'ID_MERK_TIPE' => 2,
            'NAMA_MERK_TIPE' => '(Non Merk)',
            ),
            2 => 
            array (
                'ID_MERK_TIPE' => 3,
                'NAMA_MERK_TIPE' => 'Duran',
            ),
            3 => 
            array (
                'ID_MERK_TIPE' => 4,
                'NAMA_MERK_TIPE' => 'Herma',
            ),
            4 => 
            array (
                'ID_MERK_TIPE' => 5,
                'NAMA_MERK_TIPE' => 'Kayu',
            ),
            5 => 
            array (
                'ID_MERK_TIPE' => 7,
                'NAMA_MERK_TIPE' => 'Besi',
            ),
        ));
        
        
    }
}