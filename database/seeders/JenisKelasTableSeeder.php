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
            for($i=1;$i<13;$i++){
                $data[] = [
                    "NAMA_JENIS_KELAS" => $angkatan." MIPA ".$i
                ];
            }
        }
        
        \DB::table('jenis_kelas')->insert($data);
        
    }
}