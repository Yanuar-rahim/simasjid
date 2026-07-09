<?php

namespace Database\Factories;

use App\Models\Pengumuman;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengumuman>
 */
class PengumumanFactory extends Factory
{
    protected $model = Pengumuman::class;

    public function definition(): array
    {
        $judul = fake()->randomElement([
            'Jadwal Shalat Idul Adha',
            'Kajian Rutin Pekanan',
            'Pendaftaran Qurban',
            'Kerja Bakti Masjid',
            'Pengajian Akbar',
            'Santunan Anak Yatim',
            'Buka Puasa Bersama',
            'Peringatan Isra Mi’raj',
            'Laporan Keuangan Bulanan',
            'Penerimaan Zakat Fitrah',
            'Pendaftaran Remaja Masjid',
            'Seminar Pendidikan Islam',
            'Pelatihan Tahsin Al-Qur\'an',
            'Musyawarah Pengurus Masjid',
            'Informasi Libur Kajian'
        ]);

        return [
            'judul' => $judul,

            'slug' => Str::slug(
                $judul . '-' . fake()->unique()->numberBetween(100, 9999)
            ),

            'gambar' => 'pengumuman/default.jpg',

            'kategori' => fake()->randomElement([
                'Kajian',
                'Pengumuman',
                'Kegiatan',
                'Keuangan',
                'Sosial',
                'Ibadah'
            ]),

            'status' => fake()->randomElement([
                'Aktif',
                'Draft'
            ]),

            'isi' => fake()->paragraphs(6, true),
        ];
    }
}