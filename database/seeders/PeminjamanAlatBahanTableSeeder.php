<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class PeminjamanAlatBahanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('peminjaman_alat_bahan')->delete();
        
        
        
    }
}