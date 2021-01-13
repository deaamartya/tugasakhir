<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class KelasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kelas')->delete();
        
        \DB::table('kelas')->insert(array (
            0 => 
            array (
                'ID_KELAS' => 'K000000001',
                'ID_TAHUN_AKADEMIK' => 2,
                'ID_MAPEL' => 'M0004',
                'ID_USER' => 5,
                'ID_JENIS_KELAS' => 1,
            ),
            1 => 
            array (
                'ID_KELAS' => 'K000000002',
                'ID_TAHUN_AKADEMIK' => 2,
                'ID_MAPEL' => 'M0005',
                'ID_USER' => 5,
                'ID_JENIS_KELAS' => 12,
            ),
            2 => 
            array (
                'ID_KELAS' => 'K000000003',
                'ID_TAHUN_AKADEMIK' => 2,
                'ID_MAPEL' => 'M0006',
                'ID_USER' => 5,
                'ID_JENIS_KELAS' => 23,
            ),
            3 => 
            array (
                'ID_KELAS' => 'K000000004',
                'ID_TAHUN_AKADEMIK' => 2,
                'ID_MAPEL' => 'M0001',
                'ID_USER' => 6,
                'ID_JENIS_KELAS' => 1,
            ),
            4 => 
            array (
                'ID_KELAS' => 'K000000005',
                'ID_TAHUN_AKADEMIK' => 2,
                'ID_MAPEL' => 'M0002',
                'ID_USER' => 6,
                'ID_JENIS_KELAS' => 12,
            ),
            5 => 
            array (
                'ID_KELAS' => 'K000000006',
                'ID_TAHUN_AKADEMIK' => 2,
                'ID_MAPEL' => 'M0003',
                'ID_USER' => 6,
                'ID_JENIS_KELAS' => 23,
            ),
            6 => 
            array (
                'ID_KELAS' => 'K000000007',
                'ID_TAHUN_AKADEMIK' => 2,
                'ID_MAPEL' => 'M0007',
                'ID_USER' => 7,
                'ID_JENIS_KELAS' => 1,
            ),
            7 => 
            array (
                'ID_KELAS' => 'K000000008',
                'ID_TAHUN_AKADEMIK' => 2,
                'ID_MAPEL' => 'M0008',
                'ID_USER' => 7,
                'ID_JENIS_KELAS' => 12,
            ),
            8 => 
            array (
                'ID_KELAS' => 'K000000009',
                'ID_TAHUN_AKADEMIK' => 2,
                'ID_MAPEL' => 'M0009',
                'ID_USER' => 7,
                'ID_JENIS_KELAS' => 23,
            ),
            9 => 
            array (
                'ID_KELAS' => 'K000000010',
                'ID_TAHUN_AKADEMIK' => 2,
                'ID_MAPEL' => 'M0001',
                'ID_USER' => 6,
                'ID_JENIS_KELAS' => 2,
            ),
            10 => 
            array (
                'ID_KELAS' => 'K000000011',
                'ID_TAHUN_AKADEMIK' => 2,
                'ID_MAPEL' => 'M0001',
                'ID_USER' => 6,
                'ID_JENIS_KELAS' => 3,
            ),
        ));
        
        
    }
}