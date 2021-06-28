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
                'ID_MAPEL' => 'M0001',
                'JUDUL_PRAKTIKUM' => 'PEMBIASAN PADA PRISMA',
            ),
        ));
        
        
    }
}