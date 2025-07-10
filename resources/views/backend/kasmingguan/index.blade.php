@extends('layouts.backend')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Data Kas
                    </div>
                    <div class="card-body">
                        <div class="table-reponsive">
                            <table class="table" id="dataCategory">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Minggu Ke</th>
                                        <th>Bulan</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kasmingguan as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->user->name }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $data->status == 'lunas' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                    {{ ucfirst($data->status) }}
                                                </span>
                                            </td>

                                            <td>{{ $data->minggu_ke }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::create(null, $data->bulan, 1)->locale('id')->translatedFormat('F') }}
                                            </td>
                                            <td>Rp {{ number_format($data->jumlah, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->tanggal_bayar)->locale('id')->translatedFormat('d F Y') }}</td>
                                            <td>
                                                <a href="{{ route('backend.kasmingguan.show', $data->id) }}"
                                                    class="btn btn-sm btn-success">
                                                    Show
                                                </a>
                                                <a href="{{ route('backend.kasmingguan.destroy', $data->id) }}"
                                                    class="btn btn-sm btn-danger" data-confirm-delete="true">
                                                    Delete
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#dataCategory');
    </script>
@endpush
