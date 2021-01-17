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
                'ID_PRAKTIKUM' => 'P1000000000000000001',
                'ID_RUANG_LABORATORIUM' => 2,
                'JAM_MULAI' => '08:00',
                'JAM_SELESAI' => '09:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
                'TANGGAL_PEMINJAMAN' => '2021-01-17',
            ),
            1 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000002',
                'ID_PRAKTIKUM' => 'P1000000000000000003',
                'ID_RUANG_LABORATORIUM' => 2,
                'JAM_MULAI' => '09:30',
                'JAM_SELESAI' => '10:00',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
                'TANGGAL_PEMINJAMAN' => '2021-01-18',
            ),
        ));
        
        
    }
}