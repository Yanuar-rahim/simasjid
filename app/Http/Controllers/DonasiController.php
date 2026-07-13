<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class DonasiController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_donasi' => 'required',
            'nominal' => 'required|numeric|min:1000',
        ]);

        $orderId = 'DONASI-'.time();

        $donasi = Donasi::create([
            'user_id' => Auth::id(),
            'order_id' => $orderId,
            'nama_donatur' => Auth::user()->name,
            'email' => Auth::user()->email,
            'no_hp' => Auth::user()->phone ?? '',
            'jenis_donasi' => $request->jenis_donasi,
            'nominal' => (int) $request->nominal,
            'pesan' => $request->pesan,
            'status' => 'Menunggu',
            'tanggal' => now(),
        ]);

        $configuredBaseUrl = env('MIDTRANS_NOTIFICATION_URL');
        $appUrl = config('app.url');

        if ($configuredBaseUrl) {
            $notificationUrl = rtrim($configuredBaseUrl, '/').'/home/donasi/notification';
        } elseif ($appUrl && ! str_contains($appUrl, 'localhost') && ! str_contains($appUrl, '127.0.0.1')) {
            $notificationUrl = rtrim($appUrl, '/').'/home/donasi/notification';
        } else {
            $notificationUrl = $request->getSchemeAndHttpHost().$request->getBaseUrl().'/home/donasi/notification';
        }

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $request->nominal,
            ],
            'notification_url' => $notificationUrl,
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone ?? '',
            ],
            'item_details' => [[
                'id' => $donasi->id,
                'price' => (int) $request->nominal,
                'quantity' => 1,
                'name' => $request->jenis_donasi,
            ]],

            'callbacks' => [
                'finish' => route('user.riwayat'),
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $donasi->update([
            'snap_token' => $snapToken,
        ]);

        return view('home.donasi.index', [
            'snapToken' => $snapToken,
            'orderId' => $orderId,
        ])->with('success', 'Silakan lanjutkan pembayaran melalui Midtrans.');
    }

    public function notification(Request $request)
    {
        $payload = $request->all();

        Log::info('Midtrans notification received', ['payload' => $payload]);

        $orderId = $payload['order_id'] ?? $payload['merchant_order_id'] ?? $payload['external_id'] ?? null;

        if (empty($orderId)) {
            Log::warning('Midtrans notification missing order id', ['payload' => $payload]);

            return response()->json(['status' => 'invalid'], 200);
        }

        $donasi = Donasi::where('order_id', $orderId)->first();

        if (! $donasi) {
            Log::warning('Midtrans notification order not found', ['order_id' => $orderId]);

            return response()->json([
                'status' => 'ignored',
                'message' => 'Order not found, callback accepted for logging.',
                'order_id' => $orderId,
            ], 200);
        }

        $status = $payload['transaction_status'] ?? $payload['status_code'] ?? null;
        $mappedStatus = match ($status) {
            'settlement', 'capture', '200' => 'Diterima',
            'pending', '201' => 'Menunggu',
            default => 'Ditolak',
        };

        $donasi->update([
            'transaction_id' => $payload['transaction_id'] ?? null,
            'payment_type' => $payload['payment_type'] ?? null,
            'transaction_status' => $status,
            'transaction_time' => $payload['transaction_time'] ?? null,
            'status' => $mappedStatus,
            'metode' => $payload['payment_type'] ?? $donasi->metode,
        ]);

        return response()->json([
            'status' => 'ok',
            'order_id' => $orderId,
            'donation_status' => $mappedStatus,
        ], 200);
    }

    public function notificationPage()
    {
        return view('home.donasi.notification', [
            'orderId' => null,
            'status' => null,
            'payload' => [],
        ]);
    }
}
