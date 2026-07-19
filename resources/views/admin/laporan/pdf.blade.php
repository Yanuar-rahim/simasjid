<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        body {
            margin: 20px;
            color: #1e293b;
        }

        h1,
        h2,
        h3,
        p {
            margin: 0;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #059669;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 22px;
            font-weight: bold;
        }

        .header h2 {
            font-size: 18px;
            margin-top: 6px;
        }

        .header p {
            margin-top: 4px;
            color: #555;
        }

        .periode {
            margin-bottom: 18px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #059669;
            color: white;
            border: 1px solid #cccccc;
            padding: 8px;
            text-align: center;
        }

        td {
            border: 1px solid #cccccc;
            padding: 7px;
            vertical-align: top;
        }

        td.center {
            text-align: center;
        }

        td.right {
            text-align: right;
        }

        .summary {
            margin-top: 18px;
            width: 40%;
            float: right;
        }

        .summary td {
            padding: 8px;
        }

        .summary .title {
            font-weight: bold;
            background: #ecfdf5;
        }

        .footer {
            clear: both;
            margin-top: 70px;
            text-align: right;
            color: #666;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN KEUANGAN MASJID</h1>
        <h2>{{ $masjid->nama_masjid ?? '-' }}</h2>
        <p>
            {{ $masjid->alamat ?? '-' }}
        </p>
        <p>
            Telp :
            {{ $masjid->telepon ?? '-' }}
            |
            Email :
            {{ $masjid->email ?? '-' }}
        </p>
    </div>
    <div class="periode">
        <strong>Periode :</strong>
        @if($mulai && $selesai)
        {{ \Carbon\Carbon::parse($mulai)->translatedFormat('d F Y') }}
        s/d
        {{ \Carbon\Carbon::parse($selesai)->translatedFormat('d F Y') }}
        @else
        Seluruh Data
        @endif
    </div>
    <table>
        <thead>
            <tr>
                <th width="6%">No</th>
                <th width="15%">Tanggal</th>
                <th width="18%">Jenis</th>
                <th width="20%">Kategori</th>
                <th>Keterangan</th>
                <th width="18%">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach($pemasukan as $item)
            <tr>
                <td class="center">{{ $no++ }}</td>
                <td class="center">
                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                </td>
                <td>Pemasukan</td>
                <td>{{ $item->sumber }}</td>
                <td>{{ $item->keterangan }}</td>
                <td class="right">
                    Rp {{ number_format($item->nominal,0,',','.') }}
                </td>
            </tr>
            @endforeach
            @foreach($pengeluaran as $item)
            <tr>
                <td class="center">{{ $no++ }}</td>
                <td class="center">
                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                </td>
                <td>Pengeluaran</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->keterangan }}</td>
                <td class="right">
                    Rp {{ number_format($item->nominal,0,',','.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table class="summary">
        <tr>
            <td class="title">
                Total Pemasukan
            </td>
            <td class="right">
                Rp {{ number_format($totalPemasukan,0,',','.') }}
            </td>
        </tr>
        <tr>
            <td class="title">
                Total Pengeluaran
            </td>
            <td class="right">
                Rp {{ number_format($totalPengeluaran,0,',','.') }}
            </td>
        </tr>
        <tr>
            <td class="title">
                Saldo Akhir
            </td>
            <td class="right">
                <strong>
                    Rp {{ number_format($saldo,0,',','.') }}
                </strong>
            </td>
        </tr>
    </table>
    <div class="footer">
        Dicetak pada
        {{ now()->translatedFormat('d F Y H:i') }}
    </div>
</body>
</html>