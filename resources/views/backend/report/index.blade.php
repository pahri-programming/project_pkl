@extends('layouts.backend')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-primary ">
                <h5 class="mb-0 text-white">Laporan</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('backend.report.index') }}" class="row g-3 mb-4">
                    <div class="col-md-2">
                        <label class="form-label">Jenis Laporan</label>
                        <select name="jenis" class="form-select">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="pengeluaran" {{ request('jenis') == 'pengeluaran' ? 'selected' : '' }}>
                                Pengeluaran</option>
                            <option value="pemasukan" {{ request('jenis') == 'pemasukan' ? 'selected' : '' }}>Pemasukkan
                            </option>
                            <option value="kasmingguan" {{ request('jenis') == 'kasmingguan' ? 'selected' : '' }}>Kas
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i>Cari</button>
                        <a href="{{ route('backend.report.index') }}" class="btn btn-secondary">Reset</a>
                        @if (request('jenis'))
                            <a href="{{ route('backend.report.index', array_merge(request()->all(), ['export' => 'excel'])) }}"
                                class="btn btn-success"> <i class="ti ti-file-description"></i>
                                Export Excel
                            </a>
                        @endif
                        {{-- <a href="{{ route('backend.report.export.pdf', request()->all()) }}" class="btn btn-danger">Export
                            PDF</a> --}}
                    </div>
                </form>
                @if ($jenis == 'pengeluaran' || $jenis == 'pemasukan')
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex mb-1 align-items-center">
                                <div>
                                    <h4 class="card-title mb-0">Saldo Kas</h4>
                                </div>
                            </div>
                            <p class="card-subtitle mb-3">
                            </p>
                            <div class="table-responsive border rounded-4">
                                <table class="table mb-0">
                                    <thead class="table-dark">
                                        <!-- start row -->
                                        <tr>
                                            <th class="text-white">Saldo Kas :</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Rp.{{ number_format($saldokas, '0', '.', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex mb-1 align-items-center">
                                <div>
                                    <h4 class="card-title mb-0">Laporan Transaksi</h4>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="datatransaksi" class="table table-bordered table-hover align-middle mb-0">
                                    <thead class="table-light">
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
                                                <td>{{ number_format($data->jumlah, 0, '.', '.') }}</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @elseif($jenis == 'kasmingguan')
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex mb-1 align-items-center">
                                <div>
                                    <h4 class="card-title mb-0">Rekap Saldo Kas</h4>
                                </div>
                            </div>
                            <p class="card-subtitle mb-3">
                            </p>
                            <div class="table-responsive border rounded-4">
                                <table class="table mb-0" border="1">
                                    <thead class="table-dark">
                                        <!-- start row -->
                                        <tr>
                                            <th class="text-white">Saldo Kas</th>
                                            <th class="text-white">Saldo Tunggakan</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Rp.{{ number_format($saldokas, '0', '.', '.') }}</td>
                                            <td>Rp.{{ number_format($saldonunggak, '0', '.', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex mb-1 align-items-center">
                                <div>
                                    <h4 class="card-title mb-0">Data Kas</h4>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="datakasmingguan" class="table table-bordered table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Status</th>
                                            <th>Minggu Ke</th>
                                            <th>Bulan</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Lunas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($kasmingguan as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->users->name }}</td>
                                                @if ($data->users->isAdmin == 1)
                                                    <td>Bendahara</td>
                                                @else
                                                    <td>Siswa</td>
                                                @endif
                                                <td>
                                                    @if ($data->status == 'belum')
                                                        <span class="badge bg-danger text-dark">Belum</span>
                                                    @elseif($data->status == 'lunas')
                                                        <span class="badge bg-success text-dark">Lunas</span>
                                                    @endif
                                                </td>
                                                <td>{{ $data->minggu_ke }}</td>
                                                <td>{{ \Carbon\Carbon::create()->month($data->bulan)->translatedFormat('F') }}
                                                </td>
                                                <td>Rp {{ number_format($data->jumlah, 0, ',', '.') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($data->tanggal_bayar)->locale('id')->translatedFormat('d M Y') }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('backend.kasmingguan.show', $data->id) }}"
                                                        class="btn btn-info btn-sm">Show</a>
                                                    <a href="{{ route('backend.kasmingguan.destroy', $data->id) }}"
                                                        class="btn btn-sm btn-danger" data-confirm-delete="true">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#datakasmingguan', {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
    </script>
    <script>
        new DataTable('#datatransaksi', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
    </script>
@endpush
