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
            4 => 
            array (
                'ID_HISTORI' => 'H00000000000006',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/013',
                'TIMESTAMP' => '2021-07-04 12:30:29',
                'JUMLAH_MASUK' => 1500.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1500.0,
                'KETERANGAN' => 'Stok awal',
            ),
            5 => 
            array (
                'ID_HISTORI' => 'H00000000000007',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/014',
                'TIMESTAMP' => '2021-07-04 12:31:11',
                'JUMLAH_MASUK' => 750.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 750.0,
                'KETERANGAN' => 'Stok awal',
            ),
            6 => 
            array (
                'ID_HISTORI' => 'H00000000000008',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/015',
                'TIMESTAMP' => '2021-07-04 12:31:56',
                'JUMLAH_MASUK' => 800.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 800.0,
                'KETERANGAN' => 'Stok awal',
            ),
            7 => 
            array (
                'ID_HISTORI' => 'H00000000000009',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/016',
                'TIMESTAMP' => '2021-07-04 12:32:27',
                'JUMLAH_MASUK' => 1800.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1800.0,
                'KETERANGAN' => 'Stok awal',
            ),
            8 => 
            array (
                'ID_HISTORI' => 'H00000000000010',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/017',
                'TIMESTAMP' => '2021-07-04 12:33:04',
                'JUMLAH_MASUK' => 450.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 450.0,
                'KETERANGAN' => 'Stok awal',
            ),
            9 => 
            array (
                'ID_HISTORI' => 'H00000000000011',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/018',
                'TIMESTAMP' => '2021-07-04 12:36:12',
                'JUMLAH_MASUK' => 500.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 500.0,
                'KETERANGAN' => 'Stok awal',
            ),
            10 => 
            array (
                'ID_HISTORI' => 'H00000000000012',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/151',
                'TIMESTAMP' => '2021-07-04 12:40:23',
                'JUMLAH_MASUK' => 1000.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok awal',
            ),
            11 => 
            array (
                'ID_HISTORI' => 'H00000000000013',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/019',
                'TIMESTAMP' => '2021-07-04 12:42:40',
                'JUMLAH_MASUK' => 4000.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 4000.0,
                'KETERANGAN' => 'Stok awal',
            ),
            12 => 
            array (
                'ID_HISTORI' => 'H00000000000014',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/152',
                'TIMESTAMP' => '2021-07-04 12:44:53',
                'JUMLAH_MASUK' => 1000.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok awal',
            ),
            13 => 
            array (
                'ID_HISTORI' => 'H00000000000015',
                'ID_TIPE' => 2,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'B005',
                'TIMESTAMP' => '2021-07-04 15:02:35',
                'JUMLAH_MASUK' => 100.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 100.0,
                'KETERANGAN' => 'Stok awal',
            ),
            14 => 
            array (
                'ID_HISTORI' => 'H00000000000016',
                'ID_TIPE' => 2,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'B006',
                'TIMESTAMP' => '2021-07-04 15:02:48',
                'JUMLAH_MASUK' => 1000.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok awal',
            ),
            15 => 
            array (
                'ID_HISTORI' => 'H00000000000017',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/111',
                'TIMESTAMP' => '2021-07-04 15:16:36',
                'JUMLAH_MASUK' => 1700.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1700.0,
                'KETERANGAN' => 'Stok awal',
            ),
            16 => 
            array (
                'ID_HISTORI' => 'H00000000000018',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/121',
                'TIMESTAMP' => '2021-07-04 15:18:36',
                'JUMLAH_MASUK' => 500.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 500.0,
                'KETERANGAN' => 'Stok awal',
            ),
            17 => 
            array (
                'ID_HISTORI' => 'H00000000000066',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/014',
                'TIMESTAMP' => '2021-07-07 20:59:05',
                'JUMLAH_MASUK' => 1000.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => NULL,
                'STOK' => 900.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            18 => 
            array (
                'ID_HISTORI' => 'H00000000000067',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/151',
                'TIMESTAMP' => '2021-07-07 20:59:16',
                'JUMLAH_MASUK' => 500.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => NULL,
                'STOK' => 420.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
        ));
        
        
    }
}