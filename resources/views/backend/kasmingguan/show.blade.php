@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header  bg-secondary text-white fw-bold">
                    <h5 class="mb-0"> History Kas Mingguan </h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Nama : </strong></label>
                                <div>{{$kasmingguan->user->name}}</div>
                            </div>

                            <div class="mb-3">
                                <label><strong>Bulan : </strong></label>
                                <div>{{\Carbon\Carbon::create()->month($kasmingguan->bulan)->translatedFormat('F')}} (Minggu ke : {{$kasmingguan->minggu_ke}})</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong> Jumlah : </strong></label>
                                <div>Rp. {{number_format($totalJumlah,'0', '.', '.',)}}</div>
                            </div>
                            <div class="mb-3">
                                <label><strong>Tanggal Pembayaran (Minggu ini): </strong></label>
                                <ul class="mb-0">
                                    @foreach($tanggalList as $tanggal)
                                        <li>{{ $tanggal }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong> Status : </strong></label>
                                <div>{{ $kasmingguan->status }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('backend.kasmingguan.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection