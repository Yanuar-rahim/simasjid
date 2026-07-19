<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size:11px;
            color:#222;
            margin:25px;
        }

        .header{
            text-align:center;  
            border-bottom:3px solid #059669;
            padding-bottom:12px;
            margin-bottom:20px;
        }

        .title{
            font-size:22px;
            font-weight:bold;
            color:#059669;
            letter-spacing:.5px;
        }

        .subtitle{
            font-size:18px;
            font-weight:bold;
            margin-top:4px;
        }

        .address{
            font-size:11px;
            color:#555;
            margin-top:3px;
        }

        .periode{
            margin:20px 0;
            padding:10px 14px;
            background:#F3F4F6;
            border-left:5px solid #059669;
            font-weight:bold;
        }

        h3{
            margin-top:30px;
            margin-bottom:12px;
            color:#059669;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:#059669;
            color:#fff;
            border:1px solid #000;
            padding:8px;
            text-align:center;
            font-size:11px;
        }

        table td{
            border:1px solid #000;
            padding:7px;
        }

        .text-center{
            text-align:center;
        }

        .text-right{
            text-align:right;
        }

        .empty{
            padding:15px;
            text-align:center;
            color:#777;
        }

        .summary{
            margin-top:30px;
            width:40%;
            margin-left:auto;
            border-collapse:collapse;
        }

        .summary td{
            border:1px solid #000;
            padding:8px;
        }

        .summary tr:first-child{
            background:#ECFDF5;
        }

        .summary tr:nth-child(2){
            background:#FEF2F2;
        }

        .summary tr:last-child{
            background:#059669;
            color:white;
            font-weight:bold;
            font-size:12px;
        }

        .footer{
            margin-top:70px;
            text-align:right;
            font-size:11px;
            color:#666;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="title">
        LAPORAN KEUANGAN MASJID
    </div>
    <div class="subtitle">
        {{ $masjid?->nama_masjid ?? '-' }}
    </div>
    <div class="address">
        {{ $masjid?->alamat }}
    </div>
    <div class="address">
        Telp :
        {{ $masjid?->telepon }}
        |
        Email :
        {{ $masjid?->email }}
    </div>
</div>
<div class="periode">
    Periode :
    @if($mulai && $selesai)
        {{ \Carbon\Carbon::parse($mulai)->translatedFormat('d F Y') }}
        s/d
        {{ \Carbon\Carbon::parse($selesai)->translatedFormat('d F Y') }}
    @else
        Seluruh Data
    @endif
</div>
<h3>DATA PEMASUKAN</h3>
<table>
    <thead>
    <tr>
        <th width="12%">Tanggal</th>
        <th width="20%">Sumber</th>
        <th>Keterangan</th>
        <th width="20%">Nominal</th>
    </tr>
    </thead>
    <tbody>
    @forelse($pemasukan as $item)
        <tr>
            <td class="text-center">
                {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
            </td>
            <td>
                {{ $item->sumber }}
            </td>
            <td>
                {{ $item->keterangan }}
            </td>
            <td class="text-right">
                Rp {{ number_format($item->nominal,0,',','.') }}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="empty">
                Tidak ada data pemasukan.
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
<h3>DATA PENGELUARAN</h3>
<table>
    <thead>
    <tr>
        <th width="12%">Tanggal</th>
        <th width="20%">Kategori</th>
        <th>Keterangan</th>
        <th width="20%">Nominal</th>
    </tr>
    </thead>
    <tbody>
    @forelse($pengeluaran as $item)
        <tr>
            <td class="text-center">
                {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
            </td>
            <td>
                {{ $item->kategori }}
            </td>
            <td>
                {{ $item->keterangan }}
            </td>
            <td class="text-right">
                Rp {{ number_format($item->nominal,0,',','.') }}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="empty">
                Tidak ada data pengeluaran.
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
<table class="summary">
    <tr>
        <td><strong>Total Pemasukan</strong></td>
        <td class="text-right">
            Rp {{ number_format($totalPemasukan,0,',','.') }}
        </td>
    </tr>
    <tr>
        <td><strong>Total Pengeluaran</strong></td>
        <td class="text-right">
            Rp {{ number_format($totalPengeluaran,0,',','.') }}
        </td>
    </tr>
    <tr>
        <td><strong>Saldo Akhir</strong></td>
        <td class="text-right">
            Rp {{ number_format($saldo,0,',','.') }}
        </td>
    </tr>
</table>
<div class="footer">
    Dicetak pada :
    {{ now()->translatedFormat('d F Y H:i') }}
</div>
</body>
</html>