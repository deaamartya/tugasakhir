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
        
        \DB::table('perubahan_jadwal_peminjaman')->insert(array (
            0 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000001',
                'ID_PERUBAHAN_JADWAL' => 'PJ0000000000001',
                'ID_USER' => 6,
                'JAM_MULAI_BARU' => '08:30',
                'JAM_SELESAI_BARU' => '09:00',
                'PESAN' => 'Minta dimundurkan 1 minggu',
                'STATUS_PERUBAHAN' => 0,
                'TANGGAL_BARU' => '0000-00-00',
            ),
        ));
        
        
    }
}