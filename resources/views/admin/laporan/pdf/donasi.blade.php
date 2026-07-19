<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #065F46;
        }

        .subtitle {
            text-align:center;
            margin-top:5px;
            font-size:14px;
        }

        .periode {
            text-align: center;
            margin-top: 8px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #059669;
            color: #fff;
            border: 1px solid #666;
            padding: 9px;
            font-size: 12px;
        }

        td {
            border: 1px solid #888;
            padding: 7px;
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .total {
            font-weight: bold;
            background: #D1FAE5;
            font-size: 13px;
        }

        .nama-masjid {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 8px;
        }

        tbody tr:nth-child(even) {
            background: #F8FAFC;
        }

        .footer {
            margin-top: 40px;
            width: 100%;
        }

        .footer td {
            border: none;
        }
    </style>
</head>

<body>
    <div class="title">
        LAPORAN DONASI MASJID
    </div>
    <div class="nama-masjid">
        {{ $masjid->nama_masjid ?? '-' }}
    </div>
    <div class="subtitle">
        {{ $masjid->alamat ?? '-' }}
    </div>
    <div class="subtitle">
        Telp :
        {{ $masjid->telepon ?? '-' }}
        |
        Email :
        {{ $masjid->email ?? '-' }}
    </div>
    <div class="periode">
        @if($mulai && $selesai)
        Periode :
        {{ \Carbon\Carbon::parse($mulai)->translatedFormat('d F Y') }}
        s/d
        {{ \Carbon\Carbon::parse($selesai)->translatedFormat('d F Y') }}
        @else
        Periode :
        Seluruh Data
        @endif
    </div>
    <hr style="border:1px solid #444; margin-bottom:18px;">
    <table>
        <thead>
            <tr>
                <th width="6%">No</th>
                <th width="15%">Tanggal</th>
                <th width="24%">Donatur</th>
                <th width="18%">Jenis Donasi</th>
                <th width="12%">Metode</th>
                <th width="10%">Status</th>
                <th width="15%">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donasi as $item)
            <tr>
                <td class="text-center">
                    {{ $loop->iteration }}
                </td>
                <td class="text-center">
                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                </td>
                <td>
                    {{ $item->nama_donatur }}
                </td>
                <td>
                    {{ $item->jenis_donasi }}
                </td>
                <td class="text-center">
                    {{ strtoupper($item->metode) }}
                </td>
                <td class="text-center">
                    @switch($item->transaction_status)
                    @case('settlement')
                    Berhasil
                    @break
                    @case('pending')
                    Pending
                    @break
                    @case('expire')
                    Expired
                    @break
                    @case('deny')
                    Ditolak
                    @break
                    @case('cancel')
                    Dibatalkan
                    @break
                    @default
                    {{ ucfirst($item->transaction_status) }}
                    @endswitch
                </td>
                <td class="text-right">
                    Rp {{ number_format($item->nominal,0,',','.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">
                    Tidak ada data donasi.
                </td>
            </tr>
            @endforelse
            <tr class="total">
                <td colspan="6" class="text-right">
                    TOTAL DONASI
                </td>
                <td class="text-right">
                    Rp {{ number_format($totalDonasi,0,',','.') }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="footer">
        <tr>
            <td width="60%"></td>
            <td class="text-center">
                Baubau,
                {{ $tanggalCetak->translatedFormat('d F Y') }}
                <br><br>
                Mengetahui,
                <br><br><br><br><br>
                <b>
                    {{ $masjid->ketua_takmir ?? 'Ketua Takmir' }}
                </b>
            </td>
        </tr>
    </table>
</body>
</html>