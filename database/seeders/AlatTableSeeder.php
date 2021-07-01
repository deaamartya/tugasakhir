<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class AlatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('alat')->delete();
        
        \DB::table('alat')->insert(array (
            0 => 
            array (
                'ID_ALAT' => 'JS1',
                'ID_KATALOG_ALAT' => 'JS',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            1 => 
            array (
                'ID_ALAT' => 'KAB321',
                'ID_KATALOG_ALAT' => 'KAB32',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            2 => 
            array (
                'ID_ALAT' => 'KAB322',
                'ID_KATALOG_ALAT' => 'KAB32',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            3 => 
            array (
                'ID_ALAT' => 'KAB323',
                'ID_KATALOG_ALAT' => 'KAB32',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            4 => 
            array (
                'ID_ALAT' => 'KAN521',
                'ID_KATALOG_ALAT' => 'KAN52',
                'ID_LEMARI' => 6,
                'ID_MERK_TIPE' => 2,
            ),
            5 => 
            array (
                'ID_ALAT' => 'KBR1',
                'ID_KATALOG_ALAT' => 'KBR',
                'ID_LEMARI' => 6,
                'ID_MERK_TIPE' => 2,
            ),
            6 => 
            array (
                'ID_ALAT' => 'KBR30/0501',
                'ID_KATALOG_ALAT' => 'KBR30/050',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 10,
            ),
            7 => 
            array (
                'ID_ALAT' => 'KCA45/0121',
                'ID_KATALOG_ALAT' => 'KCA45/012',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            8 => 
            array (
                'ID_ALAT' => 'KCR15/0751',
                'ID_KATALOG_ALAT' => 'KCR15/075',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            9 => 
            array (
                'ID_ALAT' => 'KCR351',
                'ID_KATALOG_ALAT' => 'KCR35',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            10 => 
            array (
                'ID_ALAT' => 'KGE11/0501',
                'ID_KATALOG_ALAT' => 'KGE11/050',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 1,
            ),
            11 => 
            array (
                'ID_ALAT' => 'KGE11/0502',
                'ID_KATALOG_ALAT' => 'KGE11/050',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 2,
            ),
            12 => 
            array (
                'ID_ALAT' => 'KGE11/0503',
                'ID_KATALOG_ALAT' => 'KGE11/050',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 3,
            ),
            13 => 
            array (
                'ID_ALAT' => 'KGE11/10001',
                'ID_KATALOG_ALAT' => 'KGE11/1000',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 2,
            ),
            14 => 
            array (
                'ID_ALAT' => 'KGE11/1001',
                'ID_KATALOG_ALAT' => 'KGE11/100',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 1,
            ),
            15 => 
            array (
                'ID_ALAT' => 'KGE11/1002',
                'ID_KATALOG_ALAT' => 'KGE11/100',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 2,
            ),
            16 => 
            array (
                'ID_ALAT' => 'KGE11/1003',
                'ID_KATALOG_ALAT' => 'KGE11/100',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 4,
            ),
            17 => 
            array (
                'ID_ALAT' => 'KGE11/1004',
                'ID_KATALOG_ALAT' => 'KGE11/100',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 3,
            ),
            18 => 
            array (
                'ID_ALAT' => 'KGE11/1501',
                'ID_KATALOG_ALAT' => 'KGE11/150',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 1,
            ),
            19 => 
            array (
                'ID_ALAT' => 'KGE11/2501',
                'ID_KATALOG_ALAT' => 'KGE11/250',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 1,
            ),
            20 => 
            array (
                'ID_ALAT' => 'KGE11/2502',
                'ID_KATALOG_ALAT' => 'KGE11/250',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 3,
            ),
            21 => 
            array (
                'ID_ALAT' => 'KGE11/2503',
                'ID_KATALOG_ALAT' => 'KGE11/250',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 2,
            ),
            22 => 
            array (
                'ID_ALAT' => 'KGE11/5001',
                'ID_KATALOG_ALAT' => 'KGE11/500',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 4,
            ),
            23 => 
            array (
                'ID_ALAT' => 'KGE11/5002',
                'ID_KATALOG_ALAT' => 'KGE11/500',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 2,
            ),
            24 => 
            array (
                'ID_ALAT' => 'KKA551',
                'ID_KATALOG_ALAT' => 'KKA55',
                'ID_LEMARI' => 6,
                'ID_MERK_TIPE' => 2,
            ),
            25 => 
            array (
                'ID_ALAT' => 'KKA64/0101',
                'ID_KATALOG_ALAT' => 'KKA64/010',
                'ID_LEMARI' => 6,
                'ID_MERK_TIPE' => 2,
            ),
            26 => 
            array (
                'ID_ALAT' => 'KKA70/0101',
                'ID_KATALOG_ALAT' => 'KKA70/010',
                'ID_LEMARI' => 6,
                'ID_MERK_TIPE' => 2,
            ),
            27 => 
            array (
                'ID_ALAT' => 'KKR65/0171',
                'ID_KATALOG_ALAT' => 'KKR65/017',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            28 => 
            array (
                'ID_ALAT' => 'KLA45/10001',
                'ID_KATALOG_ALAT' => 'KLA45/1000',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 1,
            ),
            29 => 
            array (
                'ID_ALAT' => 'KLA45/1001',
                'ID_KATALOG_ALAT' => 'KLA45/100',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 7,
            ),
            30 => 
            array (
                'ID_ALAT' => 'KLA45/1002',
                'ID_KATALOG_ALAT' => 'KLA45/100',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 2,
            ),
            31 => 
            array (
                'ID_ALAT' => 'KLA45/1003',
                'ID_KATALOG_ALAT' => 'KLA45/100',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 1,
            ),
            32 => 
            array (
                'ID_ALAT' => 'KLA45/1004',
                'ID_KATALOG_ALAT' => 'KLA45/100',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 3,
            ),
            33 => 
            array (
                'ID_ALAT' => 'KLA45/2501',
                'ID_KATALOG_ALAT' => 'KLA45/250',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 1,
            ),
            34 => 
            array (
                'ID_ALAT' => 'KLA45/2502',
                'ID_KATALOG_ALAT' => 'KLA45/250',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 2,
            ),
            35 => 
            array (
                'ID_ALAT' => 'KLA45/2503',
                'ID_KATALOG_ALAT' => 'KLA45/250',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 3,
            ),
            36 => 
            array (
                'ID_ALAT' => 'KLA45/5001',
                'ID_KATALOG_ALAT' => 'KLA45/500',
                'ID_LEMARI' => 3,
                'ID_MERK_TIPE' => 1,
            ),
            37 => 
            array (
                'ID_ALAT' => 'KLA55/10001',
                'ID_KATALOG_ALAT' => 'KLA55/1000',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            38 => 
            array (
                'ID_ALAT' => 'KLA55/1001',
                'ID_KATALOG_ALAT' => 'KLA55/100',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 1,
            ),
            39 => 
            array (
                'ID_ALAT' => 'KLE45/0121',
                'ID_KATALOG_ALAT' => 'KLE45/012',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            40 => 
            array (
                'ID_ALAT' => 'KLM251',
                'ID_KATALOG_ALAT' => 'KLM25',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            41 => 
            array (
                'ID_ALAT' => 'KPN26/1251',
                'ID_KATALOG_ALAT' => 'KPN26/125',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            42 => 
            array (
                'ID_ALAT' => 'KPP70/0101',
                'ID_KATALOG_ALAT' => 'KPP70/010',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            43 => 
            array (
                'ID_ALAT' => 'KPP75/0051',
                'ID_KATALOG_ALAT' => 'KPP75/005',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            44 => 
            array (
                'ID_ALAT' => 'KPP75/0101',
                'ID_KATALOG_ALAT' => 'KPP75/010',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            45 => 
            array (
                'ID_ALAT' => 'KPP75/0501',
                'ID_KATALOG_ALAT' => 'KPP75/050',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            46 => 
            array (
                'ID_ALAT' => 'KPP82/0101',
                'ID_KATALOG_ALAT' => 'KPP82/010',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            47 => 
            array (
                'ID_ALAT' => 'KPP82/0251',
                'ID_KATALOG_ALAT' => 'KPP82/025',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            48 => 
            array (
                'ID_ALAT' => 'KSL40/0101',
                'ID_KATALOG_ALAT' => 'KSL40/010',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 1,
            ),
            49 => 
            array (
                'ID_ALAT' => 'KSL40/0102',
                'ID_KATALOG_ALAT' => 'KSL40/010',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            50 => 
            array (
                'ID_ALAT' => 'KSL40/0251',
                'ID_KATALOG_ALAT' => 'KSL40/025',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 1,
            ),
            51 => 
            array (
                'ID_ALAT' => 'KSL40/0252',
                'ID_KATALOG_ALAT' => 'KSL40/025',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 7,
            ),
            52 => 
            array (
                'ID_ALAT' => 'KSL40/10001',
                'ID_KATALOG_ALAT' => 'KSL40/1000',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            53 => 
            array (
                'ID_ALAT' => 'KSL40/1001',
                'ID_KATALOG_ALAT' => 'KSL40/100',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            54 => 
            array (
                'ID_ALAT' => 'KSL40/2501',
                'ID_KATALOG_ALAT' => 'KSL40/250',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            55 => 
            array (
                'ID_ALAT' => 'KSL40/5001',
                'ID_KATALOG_ALAT' => 'KSL40/500',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            56 => 
            array (
                'ID_ALAT' => 'KSM24/0081',
                'ID_KATALOG_ALAT' => 'KSM24/008',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            57 => 
            array (
                'ID_ALAT' => 'KSM24/0121',
                'ID_KATALOG_ALAT' => 'KSM24/012',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            58 => 
            array (
                'ID_ALAT' => 'KSM24/0141',
                'ID_KATALOG_ALAT' => 'KSM24/014',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            59 => 
            array (
                'ID_ALAT' => 'KSM24/0241',
                'ID_KATALOG_ALAT' => 'KSM24/024',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            60 => 
            array (
                'ID_ALAT' => 'KSM24/0281',
                'ID_KATALOG_ALAT' => 'KSM24/028',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            61 => 
            array (
                'ID_ALAT' => 'KSM36/0231',
                'ID_KATALOG_ALAT' => 'KSM36/023',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            62 => 
            array (
                'ID_ALAT' => 'KSM36/0261',
                'ID_KATALOG_ALAT' => 'KSM36/026',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            63 => 
            array (
                'ID_ALAT' => 'KSM48/0251',
                'ID_KATALOG_ALAT' => 'KSM48/025',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            64 => 
            array (
                'ID_ALAT' => 'KST341',
                'ID_KATALOG_ALAT' => 'KST34',
                'ID_LEMARI' => 6,
                'ID_MERK_TIPE' => 2,
            ),
            65 => 
            array (
                'ID_ALAT' => 'KST361',
                'ID_KATALOG_ALAT' => 'KST36',
                'ID_LEMARI' => 6,
                'ID_MERK_TIPE' => 2,
            ),
            66 => 
            array (
                'ID_ALAT' => 'KTA40/0101',
                'ID_KATALOG_ALAT' => 'KTA40/010',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            67 => 
            array (
                'ID_ALAT' => 'KTA40/0102',
                'ID_KATALOG_ALAT' => 'KTA40/010',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            68 => 
            array (
                'ID_ALAT' => 'KTA40/0121',
                'ID_KATALOG_ALAT' => 'KTA40/012',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            69 => 
            array (
                'ID_ALAT' => 'KTA40/0161',
                'ID_KATALOG_ALAT' => 'KTA40/016',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 1,
            ),
            70 => 
            array (
                'ID_ALAT' => 'KTA40/0251',
                'ID_KATALOG_ALAT' => 'KTA40/025',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            71 => 
            array (
                'ID_ALAT' => 'KTA85/0101',
                'ID_KATALOG_ALAT' => 'KTA85/010',
                'ID_LEMARI' => 6,
                'ID_MERK_TIPE' => 5,
            ),
            72 => 
            array (
                'ID_ALAT' => 'KTA85/0102',
                'ID_KATALOG_ALAT' => 'KTA85/010',
                'ID_LEMARI' => 6,
                'ID_MERK_TIPE' => 6,
            ),
            73 => 
            array (
                'ID_ALAT' => 'KTA911',
                'ID_KATALOG_ALAT' => 'KTA91',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 5,
            ),
            74 => 
            array (
                'ID_ALAT' => 'KTA951',
                'ID_KATALOG_ALAT' => 'KTA95',
                'ID_LEMARI' => 6,
                'ID_MERK_TIPE' => 2,
            ),
            75 => 
            array (
                'ID_ALAT' => 'KTE25/1101',
                'ID_KATALOG_ALAT' => 'KTE25/110',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 8,
            ),
            76 => 
            array (
                'ID_ALAT' => 'KTE25/1102',
                'ID_KATALOG_ALAT' => 'KTE25/110',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 9,
            ),
            77 => 
            array (
                'ID_ALAT' => 'PF1',
                'ID_KATALOG_ALAT' => 'PF',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 10,
            ),
            78 => 
            array (
                'ID_ALAT' => 'PK1',
                'ID_KATALOG_ALAT' => 'PK',
                'ID_LEMARI' => 5,
                'ID_MERK_TIPE' => 2,
            ),
            79 => 
            array (
                'ID_ALAT' => 'TABY1',
                'ID_KATALOG_ALAT' => 'TABY',
                'ID_LEMARI' => 4,
                'ID_MERK_TIPE' => 2,
            ),
            80 => 
            array (
                'ID_ALAT' => 'VKBS281',
                'ID_KATALOG_ALAT' => 'VKBS28',
                'ID_LEMARI' => 6,
                'ID_MERK_TIPE' => 2,
            ),
        ));
        
        
    }
}