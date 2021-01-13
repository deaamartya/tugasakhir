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
                'ID_MAPEL' => 'M0001',
                'NAMA_MAPEL' => 'Fisika X',
            ),
            1 => 
            array (
                'ID_MAPEL' => 'M0002',
                'NAMA_MAPEL' => 'Fisika XI',
            ),
            2 => 
            array (
                'ID_MAPEL' => 'M0003',
                'NAMA_MAPEL' => 'Fisika XII',
            ),
            3 => 
            array (
                'ID_MAPEL' => 'M0004',
                'NAMA_MAPEL' => 'Kimia X',
            ),
            4 => 
            array (
                'ID_MAPEL' => 'M0005',
                'NAMA_MAPEL' => 'Kimia XI',
            ),
            5 => 
            array (
                'ID_MAPEL' => 'M0006',
                'NAMA_MAPEL' => 'Kimia XII',
            ),
            6 => 
            array (
                'ID_MAPEL' => 'M0007',
                'NAMA_MAPEL' => 'Biologi X',
            ),
            7 => 
            array (
                'ID_MAPEL' => 'M0008',
                'NAMA_MAPEL' => 'Biologi XI',
            ),
            8 => 
            array (
                'ID_MAPEL' => 'M0009',
                'NAMA_MAPEL' => 'Biologi XII',
            ),
        ));
        
        
    }
}