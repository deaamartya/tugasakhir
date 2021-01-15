<?php

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
                'ID_PRAKTIKUM' => 'P1000000000000000001',
                'ID_LABORATORIUM' => 1,
                'ID_MAPEL' => 'M0001',
                'ID_KELAS' => 'K000000004',
                'NAMA_PRAKTIKUM' => 'PEMBIASAN PADA PRISMA',
            ),
            1 => 
            array (
                'ID_PRAKTIKUM' => 'P1000000000000000002',
                'ID_LABORATORIUM' => 1,
                'ID_MAPEL' => 'M0001',
                'ID_KELAS' => 'K000000010',
                'NAMA_PRAKTIKUM' => 'PEMBIASAN PADA PRISMA',
            ),
            2 => 
            array (
                'ID_PRAKTIKUM' => 'P1000000000000000003',
                'ID_LABORATORIUM' => 1,
                'ID_MAPEL' => 'M0001',
                'ID_KELAS' => 'K000000011',
                'NAMA_PRAKTIKUM' => 'PEMBIASAN PADA PRISMA',
            ),
        ));
        
        
    }
}