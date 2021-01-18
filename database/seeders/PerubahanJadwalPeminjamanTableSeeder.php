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
                'JAM_MULAI_BARU' => NULL,
                'JAM_SELESAI_BARU' => NULL,
                'PESAN' => 'Diundur 1 minggu karena materi belum sampai',
                'STATUS_PERUBAHAN' => 1,
                'TANGGAL_BARU' => '2021-01-25',
            ),
        ));
        
        
    }
}