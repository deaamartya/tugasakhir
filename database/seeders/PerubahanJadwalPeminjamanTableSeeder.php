<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class PerubahanJadwalPeminjamanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('perubahan_jadwal_peminjaman')->delete();
        
        
    }
}