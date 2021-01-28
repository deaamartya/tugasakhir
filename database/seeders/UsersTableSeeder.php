<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        //user Admin
        \DB::table('users')->insert([
            'ID_TIPE_USER' => 1,
            'USERNAME' => "admin",
            'PASSWORD' => bcrypt('admin'),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => 'Admin',
            'ID_LABORATORIUM' => null,
        ]);
        
        //user Pengelola Lab Kimia
        \DB::table('users')->insert([
            'ID_TIPE_USER' => 2,
            'USERNAME' => "labkimia",
            'PASSWORD' => bcrypt('admin'),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => 'Pengelola Lab Kimia',
            'ID_LABORATORIUM' => 2,
        ]);

        //user Pengelola Lab Fisika
        \DB::table('users')->insert([
            'ID_TIPE_USER' => 3,
            'USERNAME' => "labfisika",
            'PASSWORD' => bcrypt('admin'),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => 'Pengelola Lab Fisika',
            'ID_LABORATORIUM' => 1,
        ]);

        //user Pengelola Lab Biologi
        \DB::table('users')->insert([
            'ID_TIPE_USER' => 4,
            'USERNAME' => "labbiologi",
            'PASSWORD' => bcrypt('admin'),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => 'Pengelola Lab Biologi',
            'ID_LABORATORIUM' => 3,
        ]);

        //user Guru
        \DB::table('users')->insert([
            'ID_TIPE_USER' => 5,
            'USERNAME' => "gurukimia",
            'PASSWORD' => bcrypt('admin'),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => 'Nama Guru Kimia',
            'ID_LABORATORIUM' => 2,
        ]);

        //user Guru
        \DB::table('users')->insert([
            'ID_TIPE_USER' => 5,
            'USERNAME' => "gurufisika",
            'PASSWORD' => bcrypt('admin'),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => 'Nama Guru Fisika',
            'ID_LABORATORIUM' => 1,
        ]);

        //user Guru
        \DB::table('users')->insert([
            'ID_TIPE_USER' => 5,
            'USERNAME' => "gurubiologi",
            'PASSWORD' => bcrypt('admin'),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => 'Nama Guru Biologi',
            'ID_LABORATORIUM' => 3,
        ]);
        
    }
}