<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class PraktikumTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('praktikum')->delete();
        
        \DB::table('praktikum')->insert(array (
            0 => 
            array (
                'ID_PRAKTIKUM' => 'P000000001',
                'ID_MAPEL' => 'M0001',
                'JUDUL_PRAKTIKUM' => 'PEMBIASAN PADA PRISMA',
            ),
            1 => 
            array (
                'ID_PRAKTIKUM' => 'P000000002',
                'ID_MAPEL' => 'M0004',
                'JUDUL_PRAKTIKUM' => 'Kepolaran Larutan',
            ),
            2 => 
            array (
                'ID_PRAKTIKUM' => 'P000000003',
                'ID_MAPEL' => 'M0005',
                'JUDUL_PRAKTIKUM' => 'Menentukan Reaksi Eksoterm dan Endoterm berdasarkan Percobaan Sederhana',
            ),
            3 => 
            array (
                'ID_PRAKTIKUM' => 'P000000004',
                'ID_MAPEL' => 'M0006',
                'JUDUL_PRAKTIKUM' => 'Sel Volta Sederhana',
            ),
        ));
        
        
    }
}