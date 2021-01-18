<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class TipeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipe')->delete();
        
        \DB::table('tipe')->insert(array (
            0 => 
            array (
                'ID_TIPE' => 1,
                'NAMA_TIPE' => 'Alat',
            ),
            1 => 
            array (
                'ID_TIPE' => 2,
                'NAMA_TIPE' => 'Bahan',
            ),
            2 => 
            array (
                'ID_TIPE' => 3,
                'NAMA_TIPE' => 'Bahan Kimia',
            ),
        ));
        
        
    }
}