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

        $data_user = [];

        //user Admin
        $data_user[] = [
            'ID_TIPE_USER' => 1,
            'USERNAME' => "admin",
            'PASSWORD' => bcrypt('admin'),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => 'Admin',
            'ID_LABORATORIUM' => null,
        ];

        //user Pengelola Lab Fisika
        $data_user[] = [
            'ID_TIPE_USER' => 3,
            'USERNAME' => "labfisika",
            'PASSWORD' => bcrypt('admin'),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => 'Pengelola Lab Fisika',
            'ID_LABORATORIUM' => 1,
        ];
        
        //user Pengelola Lab Kimia
        $data_user[] = [
            'ID_TIPE_USER' => 2,
            'USERNAME' => "labkimia",
            'PASSWORD' => bcrypt('admin'),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => 'Pengelola Lab Kimia',
            'ID_LABORATORIUM' => 2,
        ];
        
        //user Pengelola Lab Biologi
        $data_user[] = [
            'ID_TIPE_USER' => 4,
            'USERNAME' => "labbiologi",
            'PASSWORD' => bcrypt('admin'),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => 'Pengelola Lab Biologi',
            'ID_LABORATORIUM' => 3,
        ];

        // Data Guru SMAN 3 SIDOARJO
        $nama_guru = ['Ariani Dwi Wulandari','Asnan Wahyudi','Bambang Wahyudi','Bertha Puspitasari,S.Pd','Chotamul Laily','Chusnawirya Kurnia Devi','Dede Yayah Rokayah','Deni Ainur Rokhim','Desy Chrisnawati, Sh. M.Pd','Dewi Prajna Paramita','Dhana Noviyana','Didik Marsumi','Dony Ardhianto','Dra. Minarsih','Dra. Munawaroh Noor','Dra. Sri Mudjajanti, M.Pd','Drs,H. Achmad Nadhif S,M.Pdi','Drs. Digdo Santoso,M.Pd','Drs. H. Subagyo,M.Si','Drs. Nur Irfan','Elfandari Anindito Kartika Putri','Endang Sasiati','Endang Sulistiyowati','Endang Susilawati','Erna Arista','Evie Nilam Sari','Farida Dwi Susanti','Fatimah Almansyuroh','Fatkurochim','Feby Dasa Eka Putri','Fitri Puspasari, S.Pd','Fx. Sugiarto','Hajar Ahmad Santoso','Hendri Joelianto','Hernadhi Firmansyah','Hikmah Nafidah','Hudiya Agung Priyanto','Inanik Lumiati','Izzatul Fajriyah, S.Pd','Johannis Evertson Tasi','Karimullah, S.Pdi','Karina Rubiyanti, S.Pd','Krisnaningsih','Kuroikun Isah','Kusumaning Indrayati','Lailuz Rizky Muntadliroh','Lies Lien Maryanti','Lisa Maharani','M. Fahrudin','M.Misbah','Maliki Thohir','Miftakhul Jannah','Miftakhul Nafik','Muhammad Aziz','Mutthoharoh Nur Imamah','Ngenawati Bru Barus','Nisa Rachmi Istiqomah','Nurul Avivah, S.Pd','Pangestuti','R Irvin Adikara','Rachmad Wahyu Djatmiko','Rasyid Saleh Hutagalung','Ratih Kusmaharti','Reny Kusumawati','Ria Oktaviastuti, S.Pd','Rini Hermiwati','Riski Dyah Khorniati','Rizki Dyah Khorniati','Rr. Indah Susilowati','Sailatul Ilmiyah M.Pd','Sarni','Setyo Wibowo','Slamet Amuji','Sri Hariwati','Sri Iswahyuni Widayati','Sri Rahayuningsih','Sri Wahyuning Ari','Sri Wulandari','Suharsi','Sunarmi','Suparti','Sutomo','Sutrisno','Suwantini','Syaiful Arif','Tutik Dwi Ujiani','Ulfin Ni Matur Rohmah','Wahyu Susilowati','Widiati','Windarwatiningsih','Yetty Poniruswati, S.Pd'];

        $username_guru = ['arianidwiw','asnanwahyu','bambangwah','berthapusp','chotamulla','chusnawiry','dedeyayahr','deniainurr','desychrisn','dewiprajna','dhananoviy','didikmarsu','donyardhia','draminarsi','dramunawar','drasrimudj','drshachmad','drsdigdosa','drshsubagy','drsnurirfa','elfandaria','endangsasi','endangsuli','endangsusi','ernaarista','evienilams','faridadwis','fatimahalm','fatkurochi','febydasaek','fitripuspa','fxsugiarto','hajarahmad','hendrijoel','hernadhifi','hikmahnafi','hudiyaagun','inaniklumi','izzatulfaj','johannisev','karimullah','karinarubi','krisnaning','kuroikunis','kusumaning','lailuzrizk','lieslienma','lisamahara','mfahrudin','mmisbah','malikithoh','miftakhulj','miftakhuln','muhammadaz','mutthoharo','ngenawatib','nisarachmi','nurulaviva','pangestuti','rirvinadik','rachmadwah','rasyidsale','ratihkusma','renykusuma','riaoktavia','rinihermiw','riskidyahk','rizkidyahk','rrindahsus','sailatulil','sarni','setyowibow','slametamuj','srihariwat','sriiswahyu','srirahayun','sriwahyuni','sriwulanda','suharsi','sunarmi','suparti','sutomo','sutrisno','suwantini','syaifulari','tutikdwiuj','ulfinnimat','wahyususil','widiati','windarwati','yettyponir'];

        // Data Guru Fisika
        for($i = 0; $i<30; $i++){
            $data_user[] = [
                'ID_TIPE_USER' => 5,
                'USERNAME' => $username_guru[$i],
                'PASSWORD' => bcrypt($username_guru[$i]),
                'PATH_FOTO' => null,
                'NAMA_LENGKAP' => $nama_guru[$i],
                'ID_LABORATORIUM' => 1,
            ];
        }
        
        // Data Guru Kimia
        for($i = 30; $i<60; $i++){
            $data_user[] = [
                'ID_TIPE_USER' => 5,
                'USERNAME' => $username_guru[$i],
                'PASSWORD' => bcrypt($username_guru[$i]),
                'PATH_FOTO' => null,
                'NAMA_LENGKAP' => $nama_guru[$i],
                'ID_LABORATORIUM' => 2,
            ];
        }

        // Data Guru Biologi
        for($i = 60; $i<89; $i++){
            $data_user[] = [
                'ID_TIPE_USER' => 5,
                'USERNAME' => $username_guru[$i],
                'PASSWORD' => bcrypt($username_guru[$i]),
                'PATH_FOTO' => null,
                'NAMA_LENGKAP' => $nama_guru[$i],
                'ID_LABORATORIUM' => 3,
            ];
        }

        // User Kepala Laboratorium
        $data_user[] = [
            'ID_TIPE_USER' => 6,
            'USERNAME' => $username_guru[89],
            'PASSWORD' => bcrypt($username_guru[89]),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => $nama_guru[89],
            'ID_LABORATORIUM' => null,
        ];

        // User WAKA Sarpras
        $data_user[] = [
            'ID_TIPE_USER' => 7,
            'USERNAME' => $username_guru[90],
            'PASSWORD' => bcrypt($username_guru[90]),
            'PATH_FOTO' => null,
            'NAMA_LENGKAP' => $nama_guru[90],
            'ID_LABORATORIUM' => null,
        ];

        //insert seluruh user
        \DB::table('users')->insert($data_user);
    }
}