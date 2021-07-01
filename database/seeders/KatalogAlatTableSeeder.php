<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class KatalogAlatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('katalog_alat')->delete();
        
        \DB::table('katalog_alat')->insert(array (
            0 => 
            array (
                'ID_KATALOG_ALAT' => 'JS',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'J-shape',
                'UKURAN' => '',
            ),
            1 => 
            array (
                'ID_KATALOG_ALAT' => 'KAB32',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Tabung U',
                'UKURAN' => 'Ǿ 20mm X 150',
            ),
            2 => 
            array (
                'ID_KATALOG_ALAT' => 'KAN52',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Sendok Pijar',
                'UKURAN' => '',
            ),
            3 => 
            array (
                'ID_KATALOG_ALAT' => 'KBR',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Klem Buret',
                'UKURAN' => '',
            ),
            4 => 
            array (
                'ID_KATALOG_ALAT' => 'KBR30/050',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Buret',
                'UKURAN' => '50 ml',
            ),
            5 => 
            array (
                'ID_KATALOG_ALAT' => 'KCA45/012',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Cawan Petri',
                'UKURAN' => '',
            ),
            6 => 
            array (
                'ID_KATALOG_ALAT' => 'KCR15/075',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Corong Kaca',
                'UKURAN' => 'Ǿ75mm',
            ),
            7 => 
            array (
                'ID_KATALOG_ALAT' => 'KCR35',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Corong Polipropilen',
                'UKURAN' => '',
            ),
            8 => 
            array (
                'ID_KATALOG_ALAT' => 'KGE11/050',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Gelas Kimia Kaca',
                'UKURAN' => '50 ml',
            ),
            9 => 
            array (
                'ID_KATALOG_ALAT' => 'KGE11/100',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Gelas Kimia Kaca',
                'UKURAN' => '100 ml',
            ),
            10 => 
            array (
                'ID_KATALOG_ALAT' => 'KGE11/1000',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Gelas Kimia Kaca',
                'UKURAN' => '1000 ml',
            ),
            11 => 
            array (
                'ID_KATALOG_ALAT' => 'KGE11/150',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Gelas Kimia Kaca',
                'UKURAN' => '150 ml',
            ),
            12 => 
            array (
                'ID_KATALOG_ALAT' => 'KGE11/250',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Gelas Kimia Kaca',
                'UKURAN' => '250 ml',
            ),
            13 => 
            array (
                'ID_KATALOG_ALAT' => 'KGE11/500',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Gelas Kimia Kaca',
                'UKURAN' => '500 ml',
            ),
            14 => 
            array (
                'ID_KATALOG_ALAT' => 'KKA55',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Kaki Tiga',
                'UKURAN' => '',
            ),
            15 => 
            array (
                'ID_KATALOG_ALAT' => 'KKA64/010',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Kasa',
                'UKURAN' => '',
            ),
            16 => 
            array (
                'ID_KATALOG_ALAT' => 'KKA70/010',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Segitiga Porselen',
                'UKURAN' => '',
            ),
            17 => 
            array (
                'ID_KATALOG_ALAT' => 'KKR65/017',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Krus Porselen',
                'UKURAN' => '',
            ),
            18 => 
            array (
                'ID_KATALOG_ALAT' => 'KLA45/100',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Labu Erlenmeyer',
                'UKURAN' => '100 ml',
            ),
            19 => 
            array (
                'ID_KATALOG_ALAT' => 'KLA45/1000',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Labu Erlenmeyer',
                'UKURAN' => '1000 ml',
            ),
            20 => 
            array (
                'ID_KATALOG_ALAT' => 'KLA45/250',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Labu Erlenmeyer',
                'UKURAN' => '250 ml',
            ),
            21 => 
            array (
                'ID_KATALOG_ALAT' => 'KLA45/500',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Labu Erlenmeyer',
                'UKURAN' => '500 ml',
            ),
            22 => 
            array (
                'ID_KATALOG_ALAT' => 'KLA55/100',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Labu ukur',
                'UKURAN' => '100 ml',
            ),
            23 => 
            array (
                'ID_KATALOG_ALAT' => 'KLA55/1000',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Labu ukur',
                'UKURAN' => '1000 ml',
            ),
            24 => 
            array (
                'ID_KATALOG_ALAT' => 'KLE45/012',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Lempeng/Pelat Tetes',
                'UKURAN' => '',
            ),
            25 => 
            array (
                'ID_KATALOG_ALAT' => 'KLM25',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Lumpang dan alu',
                'UKURAN' => '',
            ),
            26 => 
            array (
                'ID_KATALOG_ALAT' => 'KPN26/125',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Cawan Penguap',
                'UKURAN' => '',
            ),
            27 => 
            array (
                'ID_KATALOG_ALAT' => 'KPP70/010',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Pipet tetes',
                'UKURAN' => '',
            ),
            28 => 
            array (
                'ID_KATALOG_ALAT' => 'KPP75/005',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Pipet ukur',
                'UKURAN' => '5 ml',
            ),
            29 => 
            array (
                'ID_KATALOG_ALAT' => 'KPP75/010',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Pipet ukur',
                'UKURAN' => '10 ml',
            ),
            30 => 
            array (
                'ID_KATALOG_ALAT' => 'KPP75/050',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Pipet ukur',
                'UKURAN' => '50 ml',
            ),
            31 => 
            array (
                'ID_KATALOG_ALAT' => 'KPP82/010',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Pipet gondok',
                'UKURAN' => '10 ml',
            ),
            32 => 
            array (
                'ID_KATALOG_ALAT' => 'KPP82/025',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Pipet gondok',
                'UKURAN' => '25 ml',
            ),
            33 => 
            array (
                'ID_KATALOG_ALAT' => 'KSL40/010',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Silinder ukur',
                'UKURAN' => '10 ml',
            ),
            34 => 
            array (
                'ID_KATALOG_ALAT' => 'KSL40/025',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Silinder ukur',
                'UKURAN' => '25 ml',
            ),
            35 => 
            array (
                'ID_KATALOG_ALAT' => 'KSL40/100',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Silinder ukur',
                'UKURAN' => '100 ml',
            ),
            36 => 
            array (
                'ID_KATALOG_ALAT' => 'KSL40/1000',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Silinder ukur',
                'UKURAN' => '1000 ml',
            ),
            37 => 
            array (
                'ID_KATALOG_ALAT' => 'KSL40/250',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Silinder ukur',
                'UKURAN' => '250 ml',
            ),
            38 => 
            array (
                'ID_KATALOG_ALAT' => 'KSL40/500',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Silinder ukur',
                'UKURAN' => '500 ml',
            ),
            39 => 
            array (
                'ID_KATALOG_ALAT' => 'KSM24/008',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Sumbat karet',
                'UKURAN' => 'Ǿ 8mm',
            ),
            40 => 
            array (
                'ID_KATALOG_ALAT' => 'KSM24/012',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Sumbat karet',
                'UKURAN' => 'Ǿ 12mm',
            ),
            41 => 
            array (
                'ID_KATALOG_ALAT' => 'KSM24/014',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Sumbat karet',
                'UKURAN' => 'Ǿ 14mm',
            ),
            42 => 
            array (
                'ID_KATALOG_ALAT' => 'KSM24/024',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Sumbat karet',
                'UKURAN' => 'Ǿ 24mm',
            ),
            43 => 
            array (
                'ID_KATALOG_ALAT' => 'KSM24/028',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Sumbat karet',
                'UKURAN' => 'Ǿ 28mm',
            ),
            44 => 
            array (
                'ID_KATALOG_ALAT' => 'KSM36/023',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Sumbat karet',
                'UKURAN' => '1 lb, Ǿ 23mm',
            ),
            45 => 
            array (
                'ID_KATALOG_ALAT' => 'KSM36/026',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Sumbat karet',
                'UKURAN' => '1 lb, Ǿ 26mm',
            ),
            46 => 
            array (
                'ID_KATALOG_ALAT' => 'KSM48/025',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Sumbat karet',
                'UKURAN' => '2 lb, Ǿ 25mm',
            ),
            47 => 
            array (
                'ID_KATALOG_ALAT' => 'KST34',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Klem Universal',
                'UKURAN' => '',
            ),
            48 => 
            array (
                'ID_KATALOG_ALAT' => 'KST36',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Boss Head',
                'UKURAN' => '',
            ),
            49 => 
            array (
                'ID_KATALOG_ALAT' => 'KTA40/010',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Tabung Reaksi',
                'UKURAN' => '10x75 mm',
            ),
            50 => 
            array (
                'ID_KATALOG_ALAT' => 'KTA40/012',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Tabung Reaksi',
                'UKURAN' => '12x100 mm',
            ),
            51 => 
            array (
                'ID_KATALOG_ALAT' => 'KTA40/016',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Tabung Reaksi',
                'UKURAN' => '16x150 mm',
            ),
            52 => 
            array (
                'ID_KATALOG_ALAT' => 'KTA40/025',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Tabung Reaksi',
                'UKURAN' => 'Ǿ 25mm',
            ),
            53 => 
            array (
                'ID_KATALOG_ALAT' => 'KTA85/010',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Penjepit Tabung',
                'UKURAN' => '',
            ),
            54 => 
            array (
                'ID_KATALOG_ALAT' => 'KTA91',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Rak Tabung Reaksi',
                'UKURAN' => '',
            ),
            55 => 
            array (
                'ID_KATALOG_ALAT' => 'KTA95',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Tang Krus',
                'UKURAN' => '',
            ),
            56 => 
            array (
                'ID_KATALOG_ALAT' => 'KTE25/110',
                'ID_KATEGORI_ALAT' => 5,
                'NAMA_ALAT' => 'Termometer ',
                'UKURAN' => '-10-110C',
            ),
            57 => 
            array (
                'ID_KATALOG_ALAT' => 'PF',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Pipet Filler',
                'UKURAN' => '',
            ),
            58 => 
            array (
                'ID_KATALOG_ALAT' => 'PK',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Pipa kaca',
                'UKURAN' => '',
            ),
            59 => 
            array (
                'ID_KATALOG_ALAT' => 'TABY',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Tabung Y',
                'UKURAN' => '',
            ),
            60 => 
            array (
                'ID_KATALOG_ALAT' => 'VKBS28',
                'ID_KATEGORI_ALAT' => 4,
                'NAMA_ALAT' => 'Pembakar Spiritus',
                'UKURAN' => '',
            ),
        ));
        
        
    }
}