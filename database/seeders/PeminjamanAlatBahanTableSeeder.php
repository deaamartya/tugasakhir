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
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000254',
                'ID_PRAKTIKUM' => 'P000000002',
                'TANGGAL_PEMINJAMAN' => '2021-07-30',
                'JAM_MULAI' => '07:40',
                'JAM_SELESAI' => '09:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            1 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000002',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000259',
                'ID_PRAKTIKUM' => 'P000000002',
                'TANGGAL_PEMINJAMAN' => '2021-08-06',
                'JAM_MULAI' => '09:41',
                'JAM_SELESAI' => '11:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            2 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000003',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000260',
                'ID_PRAKTIKUM' => 'P000000002',
                'TANGGAL_PEMINJAMAN' => '2021-07-30',
                'JAM_MULAI' => '13:00',
                'JAM_SELESAI' => '15:00',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            3 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000004',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000257',
                'ID_PRAKTIKUM' => 'P000000002',
                'TANGGAL_PEMINJAMAN' => '2021-07-31',
                'JAM_MULAI' => '07:00',
                'JAM_SELESAI' => '09:00',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            4 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000005',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000253',
                'ID_PRAKTIKUM' => 'P000000002',
                'TANGGAL_PEMINJAMAN' => '2021-08-01',
                'JAM_MULAI' => '07:00',
                'JAM_SELESAI' => '09:00',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            5 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000006',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000256',
                'ID_PRAKTIKUM' => 'P000000002',
                'TANGGAL_PEMINJAMAN' => '2021-08-01',
                'JAM_MULAI' => '09:01',
                'JAM_SELESAI' => '10:20',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            6 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000007',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000258',
                'ID_PRAKTIKUM' => 'P000000002',
                'TANGGAL_PEMINJAMAN' => '2021-08-02',
                'JAM_MULAI' => '11:00',
                'JAM_SELESAI' => '13:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            7 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000008',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000256',
                'ID_PRAKTIKUM' => 'P000000002',
                'TANGGAL_PEMINJAMAN' => '2021-08-03',
                'JAM_MULAI' => '09:00',
                'JAM_SELESAI' => '10:20',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            8 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000009',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000271',
                'ID_PRAKTIKUM' => 'P000000003',
                'TANGGAL_PEMINJAMAN' => '2021-07-22',
                'JAM_MULAI' => '08:20',
                'JAM_SELESAI' => '09:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            9 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000010',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000268',
                'ID_PRAKTIKUM' => 'P000000003',
                'TANGGAL_PEMINJAMAN' => '2021-07-22',
                'JAM_MULAI' => '11:00',
                'JAM_SELESAI' => '13:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            10 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000011',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000269',
                'ID_PRAKTIKUM' => 'P000000003',
                'TANGGAL_PEMINJAMAN' => '2021-07-19',
                'JAM_MULAI' => '08:20',
                'JAM_SELESAI' => '09:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            11 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000012',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000267',
                'ID_PRAKTIKUM' => 'P000000003',
                'TANGGAL_PEMINJAMAN' => '2021-07-19',
                'JAM_MULAI' => '12:20',
                'JAM_SELESAI' => '13:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            12 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000013',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000265',
                'ID_PRAKTIKUM' => 'P000000003',
                'TANGGAL_PEMINJAMAN' => '2021-07-20',
                'JAM_MULAI' => '09:40',
                'JAM_SELESAI' => '11:00',
                'STATUS_PEMINJAMAN' => 'SUDAH DIKEMBALIKAN',
            ),
            13 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000014',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000272',
                'ID_PRAKTIKUM' => 'P000000003',
                'TANGGAL_PEMINJAMAN' => '2021-07-21',
                'JAM_MULAI' => '08:20',
                'JAM_SELESAI' => '09:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            14 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000015',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000270',
                'ID_PRAKTIKUM' => 'P000000003',
                'TANGGAL_PEMINJAMAN' => '2021-07-21',
                'JAM_MULAI' => '11:00',
                'JAM_SELESAI' => '13:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            15 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000016',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000266',
                'ID_PRAKTIKUM' => 'P000000003',
                'TANGGAL_PEMINJAMAN' => '2021-07-24',
                'JAM_MULAI' => '07:40',
                'JAM_SELESAI' => '09:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            16 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000017',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000277',
                'ID_PRAKTIKUM' => 'P000000004',
                'TANGGAL_PEMINJAMAN' => '2021-07-28',
                'JAM_MULAI' => '09:40',
                'JAM_SELESAI' => '10:20',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            17 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000018',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000280',
                'ID_PRAKTIKUM' => 'P000000004',
                'TANGGAL_PEMINJAMAN' => '2021-07-26',
                'JAM_MULAI' => '12:20',
                'JAM_SELESAI' => '13:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            18 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000019',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000278',
                'ID_PRAKTIKUM' => 'P000000004',
                'TANGGAL_PEMINJAMAN' => '2021-07-27',
                'JAM_MULAI' => '08:20',
                'JAM_SELESAI' => '09:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            19 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000020',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000283',
                'ID_PRAKTIKUM' => 'P000000004',
                'TANGGAL_PEMINJAMAN' => '2021-07-27',
                'JAM_MULAI' => '09:41',
                'JAM_SELESAI' => '11:40',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            20 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000021',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000279',
                'ID_PRAKTIKUM' => 'P000000004',
                'TANGGAL_PEMINJAMAN' => '2021-07-28',
                'JAM_MULAI' => '11:00',
                'JAM_SELESAI' => '13:00',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            21 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000022',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000281',
                'ID_PRAKTIKUM' => 'P000000004',
                'TANGGAL_PEMINJAMAN' => '2021-07-29',
                'JAM_MULAI' => '07:00',
                'JAM_SELESAI' => '09:00',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
            22 => 
            array (
                'ID_PEMINJAMAN' => 'P00000000000023',
                'ID_RUANG_LABORATORIUM' => 1,
                'ID_KELAS' => 'K000000282',
                'ID_PRAKTIKUM' => 'P000000004',
                'TANGGAL_PEMINJAMAN' => '2021-08-01',
                'JAM_MULAI' => '10:21',
                'JAM_SELESAI' => '12:20',
                'STATUS_PEMINJAMAN' => 'MENUNGGU KONFIRMASI',
            ),
        ));
        
        
    }
}