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

                        $timings = $response->json()['data']['timings'];

                        foreach ($timings as $key => $value) {
                            $timings[$key] = substr($value, 0, 5);
                        }

                        return $timings;
                    }
                } catch (\Exception $e) {

                    Log::error($e->getMessage());
                }

                // fallback jika API mati
                return [
                    'Fajr'    => '04:45',
                    'Dhuhr'   => '12:05',
                    'Asr'     => '15:20',
                    'Maghrib' => '18:05',
                    'Isha'    => '19:15',
                ];
            }
        );
    }
}
