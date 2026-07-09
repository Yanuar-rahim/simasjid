<?php

namespace Database\Factories;

use App\Models\Kegiatan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kegiatan>
 */
class KegiatanFactory extends Factory
{
    protected $model = Kegiatan::class;

    public function definition(): array
    {
        $judul = fake()->sentence(rand(3, 6));

        return [
            'judul'      => $judul,
            'slug'       => Str::slug($judul . '-' . fake()->unique()->numberBetween(1, 9999)),
            'gambar'     => 'kegiatan/default.jpg',
            'tanggal'    => fake()->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'jam'        => fake()->time('H:i:s'),
            'lokasi'     => fake()->randomElement([
                'Masjid Agung',
                'Masjid Raya',
                'Aula Masjid',
                'Halaman Masjid',
                'Ruang Kajian',
            ]),
            'pemateri'   => fake()->name(),
            'status'     => fake()->randomElement([
                'Aktif',
                'Draft',
            ]),
            'deskripsi'  => fake()->paragraphs(5, true),
        ];
    }
}