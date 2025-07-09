@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        Detail Transaksi
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for=""><strong>Nama Siswa :</strong></label>
                                    <div>{{ $transaksi->user->name }}</div>
                                </div>
                                <div class="mb-3">
                                    <label for=""><strong>Jenis Transaksi :</strong></label>
                                    <div>{{ ucfirst($transaksi->jenis) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for=""><strong>Jumlah :</strong></label>
                                    <div>Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</div>
                                </div>
                                <div class="mb-3">
                                    <label for=""><strong>Tanggal :</strong></label>
                                    <div>{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for=""><strong>Keterangan :</strong></label>
                                    <div>{{ $transaksi->keterangan }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('backend.transaksi.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fas-arrow-left"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection