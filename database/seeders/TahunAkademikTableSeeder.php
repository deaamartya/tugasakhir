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
                $string = ($j == 0) ? $tahun."/".$tahun_2." Ganjil" : $tahun."/".$tahun_2." Genap";
                $data[] = [
                    "TAHUN_AKADEMIK" => $string
                    ];
            }
        }
        \DB::table('tahun_akademik')->insert($data);
    }
}