<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class HistoriStokTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('histori_stok')->delete();
        
        \DB::table('histori_stok')->insert(array (
            0 => 
            array (
                'ID_HISTORI' => 'H00000000000001',
                'ID_TIPE' => 2,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'B001',
                'TIMESTAMP' => '2021-07-04 12:14:55',
                'JUMLAH_MASUK' => 100.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 100.0,
                'KETERANGAN' => 'Stok awal',
            ),
            1 => 
            array (
                'ID_HISTORI' => 'H00000000000002',
                'ID_TIPE' => 2,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'B002',
                'TIMESTAMP' => '2021-07-04 12:16:25',
                'JUMLAH_MASUK' => 100.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 100.0,
                'KETERANGAN' => 'Stok awal',
            ),
            2 => 
            array (
                'ID_HISTORI' => 'H00000000000003',
                'ID_TIPE' => 2,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'B003',
                'TIMESTAMP' => '2021-07-04 12:16:43',
                'JUMLAH_MASUK' => 100.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 100.0,
                'KETERANGAN' => 'Stok awal',
            ),
            3 => 
            array (
                'ID_HISTORI' => 'H00000000000004',
                'ID_TIPE' => 2,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'B004',
                'TIMESTAMP' => '2021-07-04 12:17:24',
                'JUMLAH_MASUK' => 100.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 100.0,
                'KETERANGAN' => 'Stok awal',
            ),
        ));
        
        
    }
}