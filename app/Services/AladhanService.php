<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AladhanService
{
    public function getJadwal()
    {
        return Cache::remember(
            'jadwal_sholat_baubau',
            now()->addHours(6),
            function () {

                try {

                    $response = Http::timeout(5)
                        ->retry(1, 500)
                        ->get(
                            'https://api.aladhan.com/v1/timingsByCity',
                            [
                                'city' => 'Baubau',
                                'country' => 'Indonesia',
                                'method' => 11
                            ]
                        );

                    if ($response->successful()) {

                        return $response->json()['data']['timings'];
                    }
                } catch (\Exception $e) {

                    Log::error($e->getMessage());
                }

                // fallback jika API mati
                return [
                    'Fajr'    => '-',
                    'Dhuhr'   => '-',
                    'Asr'     => '-',
                    'Maghrib' => '-',
                    'Isha'    => '-',
                ];
            }
        );
    }
}
