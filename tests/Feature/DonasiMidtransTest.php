<?php

use App\Models\Donasi;
use App\Models\User;

it('creates a Midtrans payment transaction for a donation', function () {
    $user = User::factory()->create([
        'phone' => '081234567890',
    ]);

    $this->actingAs($user);

    $mock = Mockery::mock('alias:Midtrans\\Snap');
    $expectedNotificationUrl = $this->app['request']->getSchemeAndHttpHost().'/home/donasi/notification';
    $mock->shouldReceive('getSnapToken')->once()->withArgs(function ($params) use ($expectedNotificationUrl) {
        expect($params['notification_url'])->toBe($expectedNotificationUrl);

        return true;
    })->andReturn('snap-token-123');

    $response = $this->post(route('user.donasi.store'), [
        'jenis_donasi' => 'Infak',
        'nominal' => 50000,
        'pesan' => 'Semoga bermanfaat',
    ]);

    $response->assertStatus(200);
    $response->assertViewHas('snapToken', 'snap-token-123');

    $this->assertDatabaseHas('donasis', [
        'user_id' => $user->id,
        'jenis_donasi' => 'Infak',
        'nominal' => 50000,
        'status' => 'Menunggu',
        'snap_token' => 'snap-token-123',
    ]);
});

it('persists Midtrans notification payload into the donation record', function () {
    $user = User::factory()->create();

    $donasi = Donasi::factory()->create([
        'user_id' => $user->id,
        'order_id' => 'DONASI-123',
        'nama_donatur' => $user->name,
        'email' => $user->email,
        'no_hp' => $user->phone ?? '',
        'jenis_donasi' => 'Infak',
        'nominal' => 50000,
        'status' => 'Menunggu',
        'tanggal' => now(),
    ]);

    $response = $this->post(route('user.donasi.notification'), [
        'order_id' => 'DONASI-123',
        'transaction_id' => 'txn-001',
        'transaction_status' => 'settlement',
        'payment_type' => 'bank_transfer',
        'transaction_time' => '2024-01-01 10:00:00',
    ]);

    $response->assertStatus(200);
    $response->assertJsonPath('status', 'ok');

    $this->assertDatabaseHas('donasis', [
        'id' => $donasi->id,
        'transaction_id' => 'txn-001',
        'payment_type' => 'bank_transfer',
        'transaction_status' => 'settlement',
        'status' => 'Diterima',
        'metode' => 'bank_transfer',
    ]);
});

it('returns a successful response when the callback order is not found', function () {
    $response = $this->post(route('user.donasi.notification'), [
        'order_id' => 'DONASI-UNKNOWN',
        'transaction_status' => 'settlement',
    ]);

    $response->assertStatus(200);
    $response->assertJsonPath('status', 'ignored');
});
