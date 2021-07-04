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
                'id' => '3966a186-2187-4b90-958f-389502f54d3d',
                'type' => 'App\\Notifications\\RequestPenjadwalanUlang',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 3,
                'data' => '{"ID_PEMINJAMAN":"P00000000000002","ID_USER":41}',
                'read_at' => '2021-07-04 17:21:08',
                'created_at' => '2021-07-04 17:19:46',
                'updated_at' => '2021-07-04 17:19:46',
            ),
            1 => 
            array (
                'id' => 'dba465f2-76ce-4606-bef9-f005cb5a6500',
                'type' => 'App\\Notifications\\SuccessPenjadwalanUlang',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 41,
                'data' => '{"ID_PEMINJAMAN":"P00000000000002","ID_USER":3}',
                'read_at' => NULL,
                'created_at' => '2021-07-04 17:27:11',
                'updated_at' => '2021-07-04 17:27:11',
            ),
            2 => 
            array (
                'id' => 'e460ad7c-9120-41c5-b3d2-e6e5b4314276',
                'type' => 'App\\Notifications\\RequestPenjadwalanUlang',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 3,
                'data' => '{"ID_PEMINJAMAN":"P00000000000013","ID_USER":41}',
                'read_at' => NULL,
                'created_at' => '2021-07-04 17:13:45',
                'updated_at' => '2021-07-04 17:13:45',
            ),
        ));
    }
}