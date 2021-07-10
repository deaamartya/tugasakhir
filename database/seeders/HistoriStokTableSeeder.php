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
                'ID_HISTORI' => 'H00000000000005',
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
                'ID_HISTORI' => 'H00000000000006',
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
                'ID_HISTORI' => 'H00000000000007',
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
                'ID_HISTORI' => 'H00000000000008',
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
                'ID_HISTORI' => 'H00000000000009',
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
                'ID_HISTORI' => 'H00000000000010',
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
                'ID_HISTORI' => 'H00000000000011',
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
                'ID_HISTORI' => 'H00000000000012',
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
                'ID_HISTORI' => 'H00000000000013',
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
                'ID_HISTORI' => 'H00000000000014',
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
                'ID_HISTORI' => 'H00000000000015',
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
                'ID_HISTORI' => 'H00000000000016',
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
                'ID_HISTORI' => 'H00000000000017',
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
                'ID_HISTORI' => 'H00000000000018',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/014',
                'TIMESTAMP' => '2021-07-07 20:59:05',
                'JUMLAH_MASUK' => 1000.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => NULL,
                'STOK' => 1750.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            18 => 
            array (
                'ID_HISTORI' => 'H00000000000019',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/151',
                'TIMESTAMP' => '2021-07-07 20:59:16',
                'JUMLAH_MASUK' => 500.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => NULL,
                'STOK' => 1500.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            19 => 
            array (
                'ID_HISTORI' => 'H00000000000020',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'JS1',
                'TIMESTAMP' => '2021-07-07 21:10:10',
                'JUMLAH_MASUK' => 50.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1050.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            20 => 
            array (
                'ID_HISTORI' => 'H00000000000021',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'JS1',
                'TIMESTAMP' => '2021-07-07 21:10:10',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            21 => 
            array (
                'ID_HISTORI' => 'H00000000000022',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KAB321',
                'TIMESTAMP' => '2021-07-07 21:10:19',
                'JUMLAH_MASUK' => 100.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1100.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            22 => 
            array (
                'ID_HISTORI' => 'H00000000000023',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KAB321',
                'TIMESTAMP' => '2021-07-07 21:10:19',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            23 => 
            array (
                'ID_HISTORI' => 'H00000000000024',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KAB322',
                'TIMESTAMP' => '2021-07-07 21:10:36',
                'JUMLAH_MASUK' => 90.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1090.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            24 => 
            array (
                'ID_HISTORI' => 'H00000000000025',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KAB322',
                'TIMESTAMP' => '2021-07-07 21:10:36',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            25 => 
            array (
                'ID_HISTORI' => 'H00000000000026',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KAB323',
                'TIMESTAMP' => '2021-07-07 21:10:42',
                'JUMLAH_MASUK' => 120.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1120.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            26 => 
            array (
                'ID_HISTORI' => 'H00000000000027',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KAB323',
                'TIMESTAMP' => '2021-07-07 21:10:42',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            27 => 
            array (
                'ID_HISTORI' => 'H00000000000028',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KAN521',
                'TIMESTAMP' => '2021-07-07 21:10:52',
                'JUMLAH_MASUK' => 47.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1047.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            28 => 
            array (
                'ID_HISTORI' => 'H00000000000029',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KAN521',
                'TIMESTAMP' => '2021-07-07 21:10:52',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            29 => 
            array (
                'ID_HISTORI' => 'H00000000000030',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KBR1',
                'TIMESTAMP' => '2021-07-07 21:11:00',
                'JUMLAH_MASUK' => 37.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1037.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            30 => 
            array (
                'ID_HISTORI' => 'H00000000000031',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KBR1',
                'TIMESTAMP' => '2021-07-07 21:11:00',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            31 => 
            array (
                'ID_HISTORI' => 'H00000000000032',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KBR30/0501',
                'TIMESTAMP' => '2021-07-07 21:11:07',
                'JUMLAH_MASUK' => 90.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1090.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            32 => 
            array (
                'ID_HISTORI' => 'H00000000000033',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KBR30/0501',
                'TIMESTAMP' => '2021-07-07 21:11:07',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            33 => 
            array (
                'ID_HISTORI' => 'H00000000000034',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KCR15/0751',
                'TIMESTAMP' => '2021-07-07 21:11:19',
                'JUMLAH_MASUK' => 190.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1190.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            34 => 
            array (
                'ID_HISTORI' => 'H00000000000035',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KCR15/0751',
                'TIMESTAMP' => '2021-07-07 21:11:19',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            35 => 
            array (
                'ID_HISTORI' => 'H00000000000036',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KGE11/0501',
                'TIMESTAMP' => '2021-07-07 21:11:34',
                'JUMLAH_MASUK' => 53.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1053.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            36 => 
            array (
                'ID_HISTORI' => 'H00000000000037',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KGE11/0501',
                'TIMESTAMP' => '2021-07-07 21:11:34',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            37 => 
            array (
                'ID_HISTORI' => 'H00000000000038',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KGE11/0502',
                'TIMESTAMP' => '2021-07-07 21:11:45',
                'JUMLAH_MASUK' => 68.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1068.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            38 => 
            array (
                'ID_HISTORI' => 'H00000000000039',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KGE11/0502',
                'TIMESTAMP' => '2021-07-07 21:11:45',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            39 => 
            array (
                'ID_HISTORI' => 'H00000000000040',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KTE25/1101',
                'TIMESTAMP' => '2021-07-07 21:12:00',
                'JUMLAH_MASUK' => 242.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1242.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            40 => 
            array (
                'ID_HISTORI' => 'H00000000000041',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'KTE25/1101',
                'TIMESTAMP' => '2021-07-07 21:12:00',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            41 => 
            array (
                'ID_HISTORI' => 'H00000000000042',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'BN/014',
                'TIMESTAMP' => '2021-07-07 21:13:51',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 50.0,
                'KONDISI' => NULL,
                'STOK' => 1700.0,
                'KETERANGAN' => 'Stok keluar untuk praktikum',
            ),
            42 => 
            array (
                'ID_HISTORI' => 'H00000000000043',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'BN/151',
                'TIMESTAMP' => '2021-07-07 21:13:51',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 50.0,
                'KONDISI' => NULL,
                'STOK' => 1450.0,
                'KETERANGAN' => 'Stok keluar untuk praktikum',
            ),
            43 => 
            array (
                'ID_HISTORI' => 'H00000000000044',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KCR15/0751',
                'TIMESTAMP' => '2021-07-07 21:13:51',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 15.0,
                'KONDISI' => 1,
                'STOK' => 1175.0,
                'KETERANGAN' => 'Stok keluar untuk praktikum',
            ),
            44 => 
            array (
                'ID_HISTORI' => 'H00000000000045',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KGE11/0501',
                'TIMESTAMP' => '2021-07-07 21:13:51',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 10.0,
                'KONDISI' => 1,
                'STOK' => 1043.0,
                'KETERANGAN' => 'Stok keluar untuk praktikum',
            ),
            45 => 
            array (
                'ID_HISTORI' => 'H00000000000046',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KGE11/0502',
                'TIMESTAMP' => '2021-07-07 21:13:51',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 25.0,
                'KONDISI' => 1,
                'STOK' => 1043.0,
                'KETERANGAN' => 'Stok keluar untuk praktikum',
            ),
            46 => 
            array (
                'ID_HISTORI' => 'H00000000000047',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KTE25/1101',
                'TIMESTAMP' => '2021-07-07 21:13:51',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 20.0,
                'KONDISI' => 1,
                'STOK' => 1222.0,
                'KETERANGAN' => 'Stok keluar untuk praktikum',
            ),
            47 => 
            array (
                'ID_HISTORI' => 'H00000000000048',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'BN/014',
                'TIMESTAMP' => '2021-07-07 21:23:24',
                'JUMLAH_MASUK' => 50.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => NULL,
                'STOK' => 1750.0,
                'KETERANGAN' => 'Stok masuk sisa dari praktikum',
            ),
            48 => 
            array (
                'ID_HISTORI' => 'H00000000000049',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'BN/151',
                'TIMESTAMP' => '2021-07-07 21:23:24',
                'JUMLAH_MASUK' => 50.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => NULL,
                'STOK' => 1500.0,
                'KETERANGAN' => 'Stok masuk sisa dari praktikum',
            ),
            49 => 
            array (
                'ID_HISTORI' => 'H00000000000050',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KCR15/0751',
                'TIMESTAMP' => '2021-07-07 21:23:24',
                'JUMLAH_MASUK' => 15.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1190.0,
                'KETERANGAN' => 'Stok masuk setelah praktikum',
            ),
            50 => 
            array (
                'ID_HISTORI' => 'H00000000000051',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KCR15/0751',
                'TIMESTAMP' => '2021-07-07 21:23:24',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => NULL,
            ),
            51 => 
            array (
                'ID_HISTORI' => 'H00000000000052',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KGE11/0501',
                'TIMESTAMP' => '2021-07-07 21:23:24',
                'JUMLAH_MASUK' => 10.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1053.0,
                'KETERANGAN' => 'Stok masuk setelah praktikum',
            ),
            52 => 
            array (
                'ID_HISTORI' => 'H00000000000053',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KGE11/0501',
                'TIMESTAMP' => '2021-07-07 21:23:24',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => NULL,
            ),
            53 => 
            array (
                'ID_HISTORI' => 'H00000000000054',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KGE11/0502',
                'TIMESTAMP' => '2021-07-07 21:23:24',
                'JUMLAH_MASUK' => 24.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1067.0,
                'KETERANGAN' => 'Stok masuk setelah praktikum',
            ),
            54 => 
            array (
                'ID_HISTORI' => 'H00000000000055',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KGE11/0502',
                'TIMESTAMP' => '2021-07-07 21:23:24',
                'JUMLAH_MASUK' => 1.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1001.0,
                'KETERANGAN' => 'Jatuh saat praktikum',
            ),
            55 => 
            array (
                'ID_HISTORI' => 'H00000000000056',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KTE25/1101',
                'TIMESTAMP' => '2021-07-07 21:23:24',
                'JUMLAH_MASUK' => 20.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1242.0,
                'KETERANGAN' => 'Stok masuk setelah praktikum',
            ),
            56 => 
            array (
                'ID_HISTORI' => 'H00000000000057',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => 'P00000000000013',
                'ID_ALAT_BAHAN' => 'KTE25/1101',
                'TIMESTAMP' => '2021-07-07 21:23:24',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => NULL,
            ),
            57 => 
            array (
                'ID_HISTORI' => 'H00000000000058',
                'ID_TIPE' => 3,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'BN/013',
                'TIMESTAMP' => '2021-07-07 21:36:10',
                'JUMLAH_MASUK' => 20.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => NULL,
                'STOK' => 1520.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            58 => 
            array (
                'ID_HISTORI' => 'H00000000000059',
                'ID_TIPE' => 2,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'B001',
                'TIMESTAMP' => '2021-07-07 21:37:21',
                'JUMLAH_MASUK' => 82.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => NULL,
                'STOK' => 182.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            59 => 
            array (
                'ID_HISTORI' => 'H00000000000060',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'JS1',
                'TIMESTAMP' => '2021-07-07 21:38:17',
                'JUMLAH_MASUK' => 35.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 1,
                'STOK' => 1085.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            60 => 
            array (
                'ID_HISTORI' => 'H00000000000061',
                'ID_TIPE' => 1,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'JS1',
                'TIMESTAMP' => '2021-07-07 21:38:17',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 0.0,
                'KONDISI' => 0,
                'STOK' => 1000.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            61 => 
            array (
                'ID_HISTORI' => 'H00000000000062',
                'ID_TIPE' => 2,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'B006',
                'TIMESTAMP' => '2021-07-10 16:53:56',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 900.0,
                'KONDISI' => NULL,
                'STOK' => 100.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            62 => 
            array (
                'ID_HISTORI' => 'H00000000000063',
                'ID_TIPE' => 2,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'B006',
                'TIMESTAMP' => '2021-07-10 16:54:07',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 90.0,
                'KONDISI' => NULL,
                'STOK' => 10.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            63 => 
            array (
                'ID_HISTORI' => 'H00000000000064',
                'ID_TIPE' => 2,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'B006',
                'TIMESTAMP' => '2021-07-10 16:54:21',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 2.0,
                'KONDISI' => NULL,
                'STOK' => 8.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
            64 => 
            array (
                'ID_HISTORI' => 'H00000000000065',
                'ID_TIPE' => 2,
                'ID_TRANSAKSI' => NULL,
                'ID_ALAT_BAHAN' => 'B006',
                'TIMESTAMP' => '2021-07-10 16:54:32',
                'JUMLAH_MASUK' => 0.0,
                'JUMLAH_KELUAR' => 8.0,
                'KONDISI' => NULL,
                'STOK' => 0.0,
                'KETERANGAN' => 'Stok tambahan dari pengadaan',
            ),
        ));
        
        
    }
}