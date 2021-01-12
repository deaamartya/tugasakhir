<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class TipeUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipe_user')->delete();
        \DB::table('tipe_user')->insert(
            [
                'ID_TIPE_USER' => 1,
                'NAMA_TIPE_USER' => 'Admin',
                'ID_LABORATORIUM' => null
        ]);
        \DB::table('tipe_user')->insert(
            [
                'ID_TIPE_USER' => 2,
                'NAMA_TIPE_USER' => 'Pengelola Lab Kimia',
                'ID_LABORATORIUM' => 2
            ]);
        \DB::table('tipe_user')->insert(
            [
                'ID_TIPE_USER' => 3,
                'NAMA_TIPE_USER' => 'Pengelola Lab Fisika',
                'ID_LABORATORIUM' => 1
            ]);
        \DB::table('tipe_user')->insert(
            [
                'ID_TIPE_USER' => 4,
                'NAMA_TIPE_USER' => 'Pengelola Lab Biologi',
                'ID_LABORATORIUM' => 3
            ]);
        \DB::table('tipe_user')->insert(
            [
                'ID_TIPE_USER' => 5,
                'NAMA_TIPE_USER' => 'Guru',
                'ID_LABORATORIUM' => null
            ]);
        
    }
}