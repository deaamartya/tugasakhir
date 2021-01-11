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
    }
}