<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
            color: #222;
        }

        h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px;
            font-size: 11px;
        }

        th {
            background: #f3f4f6;
            text-align: center;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .periode {
            margin: 10px 0 20px;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $masjid->nama_masjid }}</h2>
        <div>{{ $masjid->alamat }}</div>
        <div>
            {{ $masjid->telepon }}
            |
            {{ $masjid->email }}
        </div>
        <h3>LAPORAN KEGIATAN</h3>
    </div>
    <div class="periode">
        @if($mulai && $selesai)
        Periode :
        {{ \Carbon\Carbon::parse($mulai)->translatedFormat('d F Y') }}
        -
        {{ \Carbon\Carbon::parse($selesai)->translatedFormat('d F Y') }}
        @else
        Periode :
        Seluruh Data
        @endif
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Pemateri</th>
                <th>Lokasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatan as $item)
            <tr>
                <td class="center">
                    {{ $loop->iteration }}
                </td>
                <td class="center">
                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                </td>
                <td>
                    {{ $item->judul }}
                </td>
                <td>
                    {{ $item->pemateri }}
                </td>
                <td>
                    {{ $item->lokasi }}
                </td>
                <td class="center">
                    {{ ucfirst($item->status) }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="center">
                    Tidak ada data.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="footer">
        Dicetak pada
        {{ $tanggalCetak->translatedFormat('d F Y H:i') }}
    </div>
</body>
</html>