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

        // Data Tahun Akademik
        $data_tahun_akademik = [];
        $index = 1;
        for($i=0;$i<10;$i++)
        {
            $tahun = 2020+$i;
            $tahun_2 = $tahun++;
            for($j=0;$j<2;$j++){
                $string = ($j == 0) ? $tahun_2."/".$tahun." Gasal" : $tahun_2."/".$tahun." Genap";
                array_push($data_tahun_akademik,$index);
                $index++;
            }
        }

        // 0 - 2 Fisika, 3 - 5 Kimia, 6 - 8 Biologi
        $data_mapel = ['M0001','M0002','M0003','M0004','M0005','M0006','M0007','M0008','M0009'];

        // Kelas X = 0 - 11, Kelas XI = 12 - 23, Kelas XII = 24 - 35
        // ID GURU = 5 - 95. Fisika ( 5 - 34 ) Kimia ( 35 -  64 ) Biologi ( 65 - 95 )

        $data_kelas = [];

        // Setiap tahun akademik
        foreach($data_tahun_akademik as $t)
        {
            // Setiap Mapel Angkatan ( FISIKA X, dst )
            for($i=0;$i<9;$i++)
            {
                // Setiap jenis kelas per angkatan
                for($j=1;$j<13;$j++)
                {
                    // Penentuan ID GURU
                    if($i < 3) {
                        $i_guru = rand(5,10);
                    } else if($i < 6) { 
                        $i_guru = rand(40,45);
                        } else if($i < 9) {
                            $i_guru = rand(70,75);
                            }
                    
                    //  Penentuan ID Jenis Kelas
                    if($i == 0 || $i == 3 || $i == 6) {
                        $kali = 0;
                    } else if($i == 1 || $i == 4 || $i == 7) {
                        $kali = 1;
                        } else if( $i == 2 || $i == 5 || $i == 8 ) {
                            $kali = 2;
                            }
                    
                    // Isi Data Kelas
                    $data_kelas[] = [
                        'ID_TAHUN_AKADEMIK' => $t,
                        'ID_MAPEL' => $data_mapel[$i],
                        'ID_USER' => $i_guru,
                        'ID_JENIS_KELAS' => intval((12*$kali)+$j),
                    ];
                }
            }
        }
        
        \DB::table('kelas')->insert($data_kelas);
        
    }
}