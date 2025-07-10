@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <!-- Header -->
                <div class="card-header bg-secondary text-white fw-bold">
                    Detail Transaksi
                </div>

                <!-- Body -->
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Jenis Transaksi -->
                        <div class="col-md-6">
                            <label class="fw-semibold">Jenis Transaksi:</label>
                            <div>{{ ucfirst($transaksi->jenis) }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold">Jumlah:</label>
                            <div>Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Tanggal -->
                        <div class="col-md-6">
                            <label class="fw-semibold">Tanggal:</label>
                            <div>{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d F Y') }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        
                        <div class="col-md-12">
                            <label class="fw-semibold">Keterangan:</label>
                            <div>{{ $transaksi->keterangan }}</div>
                        </div>
                    </div>

                  
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('backend.transaksi.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
