<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class KategoriAlatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('kategori_alat')->delete();

        $data_lab = ["1","2","3"];
        $data_kategori_alat = ["I","II","III"];

        $data = [];

        $i=0;$j=0;
        foreach($data_lab as $l){
            foreach($data_kategori_alat as $k){
                $data[] = [
                    'ID_LABORATORIUM' => $l,
                    'NAMA_KATEGORI' => $k,
                ];
            }
        }

        \DB::table('kategori_alat')->insert($data);
        
    }
}