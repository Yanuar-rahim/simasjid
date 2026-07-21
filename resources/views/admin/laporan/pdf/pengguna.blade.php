<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2,
        h3,
        p {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #555;
            padding: 6px;
        }

        table th {
            background: #16a34a;
            color: white;
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

        .footer {
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN DATA PENGGUNA</h2>
        <h3>{{ $masjid->nama_masjid }}</h3>
        <p>
            {{ $masjid->alamat }}
        </p>
        <p>
            Telp :
            {{ $masjid->telepon }}
            |
            Email :
            {{ $masjid->email }}
        </p>
        <br>
        <strong>
            @if($mulai && $selesai)
            Periode :
            {{ \Carbon\Carbon::parse($mulai)->translatedFormat('d F Y') }}
            s/d
            {{ \Carbon\Carbon::parse($selesai)->translatedFormat('d F Y') }}
            @else
            Periode : Seluruh Data
            @endif
        </strong>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Terdaftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="center">
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td class="center">
                    {{ ucfirst($user->role) }}
                </td>
                <td class="center">
                    @if($user->last_seen && $user->last_seen >= now()->subMinutes(5))
                    Online
                    @else
                    Offline
                    @endif
                </td>
                <td class="center">
                    {{ $user->created_at->translatedFormat('d M Y') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table>
        <tr>
            <td>Total Akun</td>
            <td class="right">{{ $totalUser }}</td>
        </tr>
        <tr>
            <td>Total Admin</td>
            <td class="right">{{ $totalAdmin }}</td>
        </tr>
        <tr>
            <td>Total User</td>
            <td class="right">{{ $totalJamaah }}</td>
        </tr>
        <tr>
            <td>Online</td>
            <td class="right">{{ $online }}</td>
        </tr>
        <tr>
            <td>Offline</td>
            <td class="right">{{ $offline }}</td>
        </tr>
    </table>
</body>
</html>