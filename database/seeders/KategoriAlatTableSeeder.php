<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class KategoriAlatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kategori_alat')->delete();
        
        \DB::table('kategori_alat')->insert(array (
            0 => 
            array (
                'ID_KATEGORI_ALAT' => 1,
                'ID_LABORATORIUM' => 1,
                'NAMA_KATEGORI' => 'I',
            ),
            1 => 
            array (
                'ID_KATEGORI_ALAT' => 6,
                'ID_LABORATORIUM' => 1,
                'NAMA_KATEGORI' => 'II',
            ),
            2 => 
            array (
                'ID_KATEGORI_ALAT' => 7,
                'ID_LABORATORIUM' => 1,
                'NAMA_KATEGORI' => 'III',
            ),
        ));
        
        
    }
}