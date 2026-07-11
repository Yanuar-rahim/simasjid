<?php

use App\Models\Kegiatan;
use App\Models\Pengumuman;
use App\Models\User;

test('authenticated user home displays active kegiatan and pengumuman from database', function () {
    $user = User::factory()->create();

    $kegiatan = Kegiatan::factory()->create([
        'judul' => 'Kajian Ba\'da Maghrib',
        'status' => 'Aktif',
    ]);

    Kegiatan::factory()->create([
        'judul' => 'Kegiatan Draft',
        'status' => 'Draft',
    ]);

    $pengumuman = Pengumuman::factory()->create([
        'judul' => 'Jadwal Sholat Idul Adha',
        'status' => 'Aktif',
    ]);

    Pengumuman::factory()->create([
        'judul' => 'Pengumuman Draft',
        'status' => 'Draft',
    ]);

    $response = $this->actingAs($user)->get(route('user.home'));

    $response->assertSuccessful();
    $response->assertSee($kegiatan->judul);
    $response->assertSee($pengumuman->judul);
    $response->assertDontSee('Kegiatan Draft');
    $response->assertDontSee('Pengumuman Draft');
});

test('guest cannot access user home page', function () {
    $this->get(route('user.home'))->assertRedirect(route('login'));
});
