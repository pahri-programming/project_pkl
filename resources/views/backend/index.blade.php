@extends('layouts.backend')
@section('content')
<div class="container-fluid">
  <!--  Owl carousel -->
  <div class="row">
    <div class="col">
      <div class="card border-0 zoom-in bg-primary-subtle shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="{{ asset('/assets/backend/images/svgs/icon-user-male.svg')}}" width="50" height="50" class="mb-3" alt="modernize-img" />
            <p class="fw-semibold fs-3 text-primary mb-1">
              Akun
            </p>
            <h5 class="fw-semibold text-primary mb-0">{{ $totalUser }}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-0 zoom-in bg-warning-subtle shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="{{ asset('/assets/backend/images/svgs/icon-briefcase.svg')}}" width="50" height="50" class="mb-3" alt="modernize-img" />
            <p class="fw-semibold fs-3 text-warning mb-1">Pembayaran</p>
            <h5 class="fw-semibold text-warning mb-0">Rp. {{ number_format($totalPembayaran,'0','.','.')}}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-0 zoom-in bg-danger-subtle shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="{{ asset('/assets/backend/images/svgs/danger.svg')}}" width="50" height="50" class="mb-3" alt="modernize-img" />
            <p class="fw-semibold fs-3 text-danger mb-1">Pengeluaran</p>
            <h5 class="fw-semibold text-danger mb-0">Rp. {{ number_format($totalPengeluaran, '0', '.', '.')}}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-0 zoom-in bg-success-subtle shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="{{ asset('/assets/backend/images/svgs/icon-speech-bubble.svg')}}" width="50" height="50" class="mb-3" alt="modernize-img" />
            <p class="fw-semibold fs-3 text-success mb-1">Pemasukkan</p>
            <h5 class="fw-semibold text-success mb-0">Rp. {{ number_format($totalPemasukan, '0', '.', '.')}}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-0 zoom-in bg-info-subtle shadow-none">
        <div class="card-body">
          <div class="text-center">
            <img src="{{ asset('/assets/backend/images/svgs/icon-dd-invoice.svg')}}" width="50" height="50" class="mb-3" alt="modernize-img" />
            <p class="fw-semibold fs-3 text-info mb-1">Total Uang Kas</p>
            <h5 class="fw-semibold text-info mb-0">Rp. {{ number_format($saldoKas, '0','.','.') }}</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  Row 1 -->

</div>
@endsection