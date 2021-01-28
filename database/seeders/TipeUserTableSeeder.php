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
                'NAMA_TIPE_USER' => 'Admin'
        ]);
        \DB::table('tipe_user')->insert(
            [
                'ID_TIPE_USER' => 2,
                'NAMA_TIPE_USER' => 'Pengelola Lab Kimia'
            ]);
        \DB::table('tipe_user')->insert(
            [
                'ID_TIPE_USER' => 3,
                'NAMA_TIPE_USER' => 'Pengelola Lab Fisika'
            ]);
        \DB::table('tipe_user')->insert(
            [
                'ID_TIPE_USER' => 4,
                'NAMA_TIPE_USER' => 'Pengelola Lab Biologi'
            ]);
        \DB::table('tipe_user')->insert(
            [
                'ID_TIPE_USER' => 5,
                'NAMA_TIPE_USER' => 'Guru'
            ]);
        
    }
}