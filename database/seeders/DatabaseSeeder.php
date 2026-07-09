<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Kegiatan::factory(20)->create();

        Pengumuman::factory(20)->create();
    }
}
