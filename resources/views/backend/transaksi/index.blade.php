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
                        Data Transaksi 
                        <a href="{{ route('backend.transaksi.create') }}" class="btn btn-info btn-sm"
                            style="text-color:white;  float: right">
                            Tambah
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="dataCategory">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->jenis }}</td>
                                            <td>Rp {{ number_format($data->jumlah, 0, ',', '.') }}</td>
                                            <td>{{ Str::limit($data->keterangan, 30) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{ route('backend.transaksi.edit', $data->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    Edit
                                                </a> 
                                                <a href="{{ route('backend.transaksi.show', $data->id) }}"
                                                    class="btn btn-sm btn-success">
                                                    Show
                                                </a> 
                                                <a href="{{ route('backend.transaksi.destroy', $data->id) }}"
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
