<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class JenisKelasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jenis_kelas')->delete();
        
        
        
    }
}