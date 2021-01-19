<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class LemariTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lemari')->delete();
        
        \DB::table('lemari')->insert(array (
            0 => 
            array (
                'ID_LEMARI' => 1,
                'ID_LABORATORIUM' => 1,
                'NAMA_LEMARI' => 'A1',
            ),
            1 => 
            array (
                'ID_LEMARI' => 2,
                'ID_LABORATORIUM' => 1,
                'NAMA_LEMARI' => 'C1',
            ),
            2 => 
            array (
                'ID_LEMARI' => 3,
                'ID_LABORATORIUM' => 2,
                'NAMA_LEMARI' => 'A1',
            ),
            3 => 
            array (
                'ID_LEMARI' => 4,
                'ID_LABORATORIUM' => 2,
                'NAMA_LEMARI' => 'A2',
            ),
            4 => 
            array (
                'ID_LEMARI' => 5,
                'ID_LABORATORIUM' => 2,
                'NAMA_LEMARI' => 'A3',
            ),
            5 => 
            array (
                'ID_LEMARI' => 6,
                'ID_LABORATORIUM' => 2,
                'NAMA_LEMARI' => 'A4',
            ),
            6 => 
            array (
                'ID_LEMARI' => 7,
                'ID_LABORATORIUM' => 2,
                'NAMA_LEMARI' => 'A5',
            ),
            7 => 
            array (
                'ID_LEMARI' => 8,
                'ID_LABORATORIUM' => 2,
                'NAMA_LEMARI' => 'A6',
            ),
            8 => 
            array (
                'ID_LEMARI' => 9,
                'ID_LABORATORIUM' => 2,
                'NAMA_LEMARI' => 'A7',
            ),
            9 => 
            array (
                'ID_LEMARI' => 10,
                'ID_LABORATORIUM' => 1,
                'NAMA_LEMARI' => 'A5',
            ),
            10 => 
            array (
                'ID_LEMARI' => 11,
                'ID_LABORATORIUM' => 1,
                'NAMA_LEMARI' => 'A7',
            ),
        ));
        
        
    }
}