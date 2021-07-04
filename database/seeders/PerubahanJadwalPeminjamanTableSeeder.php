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
                'ID_PERUBAHAN_JADWAL' => 'PJ0000000000001',
                'ID_PEMINJAMAN' => 'P00000000000013',
                'ID_USER' => 41,
                'TANGGAL_BARU' => '2021-07-27',
                'JAM_MULAI_BARU' => NULL,
                'JAM_SELESAI_BARU' => NULL,
                'PESAN' => 'Materi belum sampai, mohon diundur 1 minggu. Terimakasih',
                'STATUS_PERUBAHAN' => 0,
            ),
            1 => 
            array (
                'ID_PERUBAHAN_JADWAL' => 'PJ0000000000002',
                'ID_PEMINJAMAN' => 'P00000000000002',
                'ID_USER' => 41,
                'TANGGAL_BARU' => NULL,
                'JAM_MULAI_BARU' => NULL,
                'JAM_SELESAI_BARU' => NULL,
                'PESAN' => 'Mohon diundur karena saya ada acara di tgl tersebut',
                'STATUS_PERUBAHAN' => 1,
            ),
        ));
        
        
    }
}