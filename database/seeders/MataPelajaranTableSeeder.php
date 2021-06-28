<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class MataPelajaranTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mata_pelajaran')->delete();
        
        \DB::table('mata_pelajaran')->insert(array (
            0 => 
            array (
                'ID_LABORATORIUM' => 1,
                'NAMA_MAPEL' => 'Fisika X',
            ),
            1 => 
            array (
                'ID_LABORATORIUM' => 1,
                'NAMA_MAPEL' => 'Fisika XI',
            ),
            2 => 
            array (
                'ID_LABORATORIUM' => 1,
                'NAMA_MAPEL' => 'Fisika XII',
            ),
            3 => 
            array (
                'ID_LABORATORIUM' => 2,
                'NAMA_MAPEL' => 'Kimia X',
            ),
            4 => 
            array (
                'ID_LABORATORIUM' => 2,
                'NAMA_MAPEL' => 'Kimia XI',
            ),
            5 => 
            array (
                'ID_LABORATORIUM' => 2,
                'NAMA_MAPEL' => 'Kimia XII',
            ),
            6 => 
            array (
                'ID_LABORATORIUM' => 3,
                'NAMA_MAPEL' => 'Biologi X',
            ),
            7 => 
            array (
                'ID_LABORATORIUM' => 3,
                'NAMA_MAPEL' => 'Biologi XI',
            ),
            8 => 
            array (
                'ID_LABORATORIUM' => 3,
                'NAMA_MAPEL' => 'Biologi XII',
            ),
        ));
        
        
    }
}