<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class TahunAkademikTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tahun_akademik')->delete();
        for($i=0;$i<10;$i++)
        {
            $tahun = 2020+$i;
            $tahun_2 = $tahun++;
            for($j=0;$j<2;$j++){
                $string = ($j == 0) ? $tahun_2."/".$tahun." Gasal" : $tahun_2."/".$tahun." Genap";
                $data_tahun_akademik[] = [
                    "TAHUN_AKADEMIK" => $string
                    ];
            }
        }
        \DB::table('tahun_akademik')->insert($data_tahun_akademik);
    }
}