<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaboratoriumTableSeeder::class);
        $this->call(TipeUserTableSeeder::class);
        // $this->call(RuangLaboratoriumTableSeeder::class);
        // $this->call(LemariTableSeeder::class);

        // $this->call(TahunAkademikTableSeeder::class);
        $this->call(TipeTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(JenisKelasTableSeeder::class);
        // $this->call(MataPelajaranTableSeeder::class);
        // $this->call(KelasTableSeeder::class);

        // $this->call(KategoriAlatTableSeeder::class);
        // $this->call(KatalogAlatTableSeeder::class);
        // $this->call(KatalogBahanTableSeeder::class);
        // $this->call(MerkTipeAlatTableSeeder::class);

        // $this->call(AlatTableSeeder::class);
        // $this->call(BahanTableSeeder::class);
        // $this->call(BahanKimiaTableSeeder::class);
        // $this->call(PraktikumTableSeeder::class);

        // $this->call(AlatBahanPraktikumTableSeeder::class);
        
        // $this->call(PeminjamanAlatBahanTableSeeder::class);
        // $this->call(PerubahanJadwalPeminjamanTableSeeder::class);

        // $this->call(HistoriStokTableSeeder::class);
        // $this->call(NotificationsTableSeeder::class);
    }
}
