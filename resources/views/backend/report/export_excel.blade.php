@if ($jenis == 'pengeluaran' || $jenis == 'pemasukan')
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
                    <td>{{ $data->jenis }}</td>
                    <td>Rp. {{ number_format($data->jumlah, '0', '.', '.') }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>{{ $data->tanggal->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@elseif($jenis == 'kasmingguan')
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
                    <td>{{ \Carbon\Carbon::create()->month($data->bulan)->translatedFormat('F') }}</td>
                    <td>Rp. {{ number_format($data->jumlah, '0', '.', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_bayar)->translatedFormat('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
