<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class HistoriStokTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('histori_stok')->delete();
    }
}