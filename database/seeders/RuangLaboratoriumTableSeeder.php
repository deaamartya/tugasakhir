<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class RuangLaboratoriumTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ruang_laboratorium')->delete();
        
        \DB::table('ruang_laboratorium')->insert(array (
            0 => 
            array (
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_LABORATORIUM' => 2,
                'NAMA_RUANG_LABORATORIUM' => 'Ruang Lab. Kimia 1',
            ),
            1 => 
            array (
                'ID_RUANG_LABORATORIUM' => 2,
                'ID_LABORATORIUM' => 1,
                'NAMA_RUANG_LABORATORIUM' => 'Ruang Lab. Fisika 1',
            ),
            2 => 
            array (
                'ID_RUANG_LABORATORIUM' => 3,
                'ID_LABORATORIUM' => 3,
                'NAMA_RUANG_LABORATORIUM' => 'Ruang Lab. Biologi 1',
            ),
        ));
        
        
    }
}