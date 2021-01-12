<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class KatalogAlatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('katalog_alat')->delete();
        
        \DB::table('katalog_alat')->insert(array (
            0 => 
            array (
                'ID_KATALOG_ALAT' => 'KGE11/050',
                'ID_KATEGORI_ALAT' => 1,
                'NAMA_ALAT' => 'Gelas Kimia Kaca',
                'UKURAN' => '50 ml',
            ),
            1 => 
            array (
                'ID_KATALOG_ALAT' => 'KGE11/100',
                'ID_KATEGORI_ALAT' => 1,
                'NAMA_ALAT' => 'Gelas Kimia Kaca',
                'UKURAN' => '100 ml',
            ),
            2 => 
            array (
                'ID_KATALOG_ALAT' => 'KGE11/1000',
                'ID_KATEGORI_ALAT' => 1,
                'NAMA_ALAT' => 'Gelas Kimia Kaca',
                'UKURAN' => '1000 ml',
            ),
            3 => 
            array (
                'ID_KATALOG_ALAT' => 'KGE11/150',
                'ID_KATEGORI_ALAT' => 1,
                'NAMA_ALAT' => 'Gelas Kimia Kaca',
                'UKURAN' => '150 ml',
            ),
            4 => 
            array (
                'ID_KATALOG_ALAT' => 'KGE11/250',
                'ID_KATEGORI_ALAT' => 1,
                'NAMA_ALAT' => 'Gelas Kimia Kaca',
                'UKURAN' => '250 ml',
            ),
        ));
        
        
    }
}