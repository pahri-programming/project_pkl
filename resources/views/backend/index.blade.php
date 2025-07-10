@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <!--  Owl carousel -->
        <div class="row">
            <div class="col-md-2 col-sm-6 col-12 mb-3">
                <div class="card border-0 bg-primary-subtle shadow-none">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/backend/images/svgs/icon-user-male.svg') }}" width="50"
                            class="mb-3" />
                        <p class="fw-semibold fs-3 text-primary mb-1">Akun</p>
                        <h5 class="fw-semibold text-primary mb-0">{{ $totalUser }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-12 mb-3">
                <div class="card border-0 bg-warning-subtle shadow-none">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/backend/images/svgs/icon-briefcase.svg') }}" width="50"
                            class="mb-3" />
                        <p class="fw-semibold fs-3 text-warning mb-1">Pembayaran</p>
                        <h5 class="fw-semibold text-warning mb-0">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-12 mb-3">
                <div class="card border-0 bg-danger-subtle shadow-none">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/backend/images/svgs/danger.svg') }}" width="50" class="mb-3" />
                        <p class="fw-semibold fs-3 text-danger mb-1">Pengeluaran</p>
                        <h5 class="fw-semibold text-danger mb-0">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-12 mb-3">
                <div class="card border-0 bg-success-subtle shadow-none">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/backend/images/svgs/icon-speech-bubble.svg') }}" width="50"
                            class="mb-3" />
                        <p class="fw-semibold fs-3 text-success mb-1">Pemasukan</p>
                        <h5 class="fw-semibold text-success mb-0">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-12 mb-3">
                <div class="card border-0 bg-success-subtle shadow-none">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/backend/images/svgs/icon-wallet.svg') }}" width="50"
                            class="mb-3" />
                        <p class="fw-semibold fs-3 text-success mb-1">Total Kas</p>
                        <h5 class="fw-semibold text-success mb-0">Rp {{ number_format($saldoKas, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
