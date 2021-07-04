<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class BahanKimiaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bahan_kimia')->delete();
        
        \DB::table('bahan_kimia')->insert(array (
            0 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/011',
                'ID_KATALOG_BAHAN' => 'BN/01',
                'ID_LEMARI' => 10,
                'NAMA_BAHAN_KIMIA' => 'Natrium',
                'RUMUS' => 'Na',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            1 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/012',
                'ID_KATALOG_BAHAN' => 'BN/01',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN_KIMIA' => 'Natrium',
                'RUMUS' => 'Na',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            2 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/013',
                'ID_KATALOG_BAHAN' => 'BN/01',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN_KIMIA' => 'Natrium Hidroksida',
                'RUMUS' => 'NaOH',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            3 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/014',
                'ID_KATALOG_BAHAN' => 'BN/01',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN_KIMIA' => 'Natrium Klorida',
                'RUMUS' => 'NaCl',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            4 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/015',
                'ID_KATALOG_BAHAN' => 'BN/01',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN_KIMIA' => 'Natrium Tiosulfat',
                'RUMUS' => 'Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub>',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            5 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/016',
                'ID_KATALOG_BAHAN' => 'BN/01',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN_KIMIA' => 'Natrium Sulfat',
                'RUMUS' => 'Na<sub>2</sub>SO<sub>4</sub>',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            6 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/017',
                'ID_KATALOG_BAHAN' => 'BN/01',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN_KIMIA' => 'Natrium Sulfit',
                'RUMUS' => 'Na<sub>2</sub>SO<sub>3</sub>',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            7 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/018',
                'ID_KATALOG_BAHAN' => 'BN/01',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN_KIMIA' => 'Natrium Hidrogen Fosfat',
                'RUMUS' => 'Na<sub>2</sub>HPO<sub>4</sub>.2H<sub>2</sub>O',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            8 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/019',
                'ID_KATALOG_BAHAN' => 'BN/01',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN_KIMIA' => 'Natrium Oksalat',
            'RUMUS' => '(COONa)<sub>2</sub>',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            9 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/111',
                'ID_KATALOG_BAHAN' => 'BN/11',
                'ID_LEMARI' => 8,
            'NAMA_BAHAN_KIMIA' => 'Tembaga (II) Sulfat',
                'RUMUS' => 'CuSO<sub>4</sub>',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            10 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/121',
                'ID_KATALOG_BAHAN' => 'BN/12',
                'ID_LEMARI' => 3,
            'NAMA_BAHAN_KIMIA' => 'Seng (II) Sulfat',
                'RUMUS' => 'ZnSO<font class="font5"><sub>4</sub></font>',
                'WUJUD' => 'Padat',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            11 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/151',
                'ID_KATALOG_BAHAN' => 'BN/15',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN_KIMIA' => 'Aseton',
                'RUMUS' => 'C<sub>3</sub>H<sub>6</sub>O',
                'WUJUD' => 'Cair',
                'SPESIFIKASI_BAHAN' => 1,
            ),
            12 => 
            array (
                'ID_BAHAN_KIMIA' => 'BN/152',
                'ID_KATALOG_BAHAN' => 'BN/15',
                'ID_LEMARI' => 7,
                'NAMA_BAHAN_KIMIA' => 'Etanol',
                'RUMUS' => 'C<sub>2</sub>H<sub>5</sub>OH',
                'WUJUD' => 'Cair',
                'SPESIFIKASI_BAHAN' => 1,
            ),
        ));
        
        
    }
}