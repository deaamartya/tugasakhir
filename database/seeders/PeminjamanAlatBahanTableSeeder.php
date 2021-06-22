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
        
        \DB::table('peminjaman_alat_bahan')->insert(array (
            0 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000001',
                'ID_PRAKTIKUM' => 'P100000001',
                'ID_RUANG_LABORATORIUM' => 2,
                'JAM_MULAI' => '08:40',
                'JAM_SELESAI' => '09:00',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
                'TANGGAL_PEMINJAMAN' => date('Y-m-d'),
            ),
        ));
        
        
    }
}