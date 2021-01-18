<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'created_at' => '2021-01-17 18:48:54',
                'data' => '{"ID_PEMINJAMAN":"P00000000000001"}',
                'id' => '52535239-81d7-4952-8f1e-e2a114563051',
                'notifiable_id' => 6,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\SuccessPenjadwalanUlang',
                'updated_at' => '2021-01-17 18:48:54',
            ),
            1 => 
            array (
                'created_at' => '2021-01-17 16:07:36',
                'data' => '{"ID_PEMINJAMAN":"P00000000000001"}',
                'id' => 'c21b209b-cf7b-4c23-8984-ee3d5a6130d3',
                'notifiable_id' => 3,
                'notifiable_type' => 'App\\Models\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\RequestPenjadwalanUlang',
                'updated_at' => '2021-01-17 16:07:36',
            ),
        ));
        
        
    }
}