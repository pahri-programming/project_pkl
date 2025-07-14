<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

@if ($jenis == 'pengeluaran' || $jenis == 'pemasukan')
    <h3>Laporan {{ ucfirst($jenis) }}</h3>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($transaksi as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ ucfirst($data->jenis) }}</td>
                    <td>Rp. {{ number_format($data->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->locale('id')->translatedFormat('d F Y') }}</td>
                </tr>
            @endforeach
            <tr>
                <th>Saldo Kas : </th>
                <td colspan="6" style="text-align: center">Rp. {{ number_format($saldokas, '0', '.', '.') }}</td>
            </tr>
        </tbody>
    </table>

@elseif($jenis == 'kasmingguan')
    <h3>Laporan Kas Mingguan</h3>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Minggu Ke</th>
                <th>Bulan</th>
                <th>Jumlah</th>
                <th>Tanggal Bayar</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($kasmingguan as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->users->name ?? '-' }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->minggu_ke }}</td>
                    <td>{{ \Carbon\Carbon::create()->month($data->bulan)->locale('id')->translatedFormat('F') }}</td>
                    <td>Rp. {{ number_format($data->jumlah, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_bayar)->locale('id')->translatedFormat('d F Y') }}</td>
                </tr>
            @endforeach

            <tr>
                <th colspan="6" style="text-align: right">Saldo Kas :</th>
                <td><strong>Rp. {{ number_format($saldokas, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <th colspan="6" style="text-align: right">Saldo Tunggakan :</th>
                <td><strong>Rp. {{ number_format($saldonunggak, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
@endif

</body>
</html>
