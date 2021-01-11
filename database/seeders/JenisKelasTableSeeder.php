<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class JenisKelasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('jenis_kelas')->delete();
        for($k=0;$k<3;$k++){
            if($k == 0){
                $angkatan = "X";
            }
            else if($k == 1){
                $angkatan = "XI";
            }
            else if($k == 2){
                $angkatan = "XII";
            }
            for($i=1;$i<9;$i++){
                $data[] = [
                    "NAMA_JENIS_KELAS" => $angkatan." MIPA ".$i
                ];
            }
            for($i=1;$i<3;$i++){
                $data[] = [
                    "NAMA_JENIS_KELAS" => $angkatan." IIS ".$i
                ];
            }
            $data[] = [
                "NAMA_JENIS_KELAS" => $angkatan." IBB 1"
            ];
        }
        
        \DB::table('jenis_kelas')->insert($data);
        
    }
}