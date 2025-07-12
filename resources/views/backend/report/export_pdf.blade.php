<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Kas Mingguan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .logo {
            width: 150px;
        }

        .company-info {
            text-align: right;
            font-size: 13px;
        }

        .title {
            text-align: center;
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px 5px;
        }

        th {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/logo.png') }}" class="logo" alt="DanaKita" >
        <div class="company-info">
            <strong>Laporan Keuangan</strong><br>
        </div>
    </div>

    <div class="title">Laporan Kas Mingguan</div>
    <p class="subtitle">
        Periode:
        {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('d M Y') : 'Semua' }}
        -
        {{ request('end_date') ? \Carbon\Carbon::parse(request('end_date'))->format('d M Y') : 'Semua' }}
        |
        Status: {{ ucfirst(request('status') ?? 'All') }}
    </p>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="20%">Nama Siswa</th>
                <th width="10%">Status</th>
                <th width="10%">Minggu Ke</th>
                <th width="15%">Bulan</th>
                <th width="15%">Jumlah</th>
                <th width="15%">Tanggal Bayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kasmingguan as $kas)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $kas->user->name }}</td>
                <td>{{ ucfirst($kas->status) }}</td>
                <td>{{ $kas->minggu_ke }}</td>
                <td>{{ \Carbon\Carbon::create()->month($kas->bulan)->translatedFormat('F') }}</td>
                <td>Rp {{ number_format($kas->jumlah, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($kas->tanggal_bayar)->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </div>
</body>

</html>
