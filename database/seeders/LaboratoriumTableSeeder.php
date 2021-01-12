<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class LaboratoriumTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('laboratorium')->delete();
        
        \DB::table('laboratorium')->insert(array (
            0 => 
            array (
                'ID_LABORATORIUM' => 1,
                'NAMA_LABORATORIUM' => 'Lab Fisika',
            ),
            1 => 
            array (
                'ID_LABORATORIUM' => 2,
                'NAMA_LABORATORIUM' => 'Lab Kimia',
            ),
            2 => 
            array (
                'ID_LABORATORIUM' => 3,
                'NAMA_LABORATORIUM' => 'Lab Biologi',
            ),
        ));
        
    }
}