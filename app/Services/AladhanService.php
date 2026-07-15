<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AladhanService
{
    public function getJadwal()
    {
        return Cache::remember('jadwal_sholat_baubau', now()->addHours(12), function () {

            $response = Http::get(
                'https://api.aladhan.com/v1/timingsByCity',
                [
                    'city' => 'Baubau',
                    'country' => 'Indonesia',
                    'method' => 11,
                ]
            );

            if (!$response->successful()) {
                return null;
            }

            return $response->json()['data']['timings'];
        });
    }
}
