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
        \DB::table('mata_pelajaran')->insert([
            0 => [
                "NAMA_MAPEL" => 'Kimia'
            ],
            1 => [
                "NAMA_MAPEL" => 'Fisika'
            ],
            2 => [
                "NAMA_MAPEL" => 'Biologi'
            ],
        ]);
        
    }
}