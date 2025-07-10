@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Header -->
                <div class="card-header bg-primary text-white fw-bold">
                    Tambah Transaksi Kas
                </div>

                <!-- Body -->
                <div class="card-body">
                    <form action="{{ route('backend.transaksi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-4">
                            <!-- Jumlah Uang -->
                            <div class="col-md-6">
                                <label for="jumlah" class="form-label">Jumlah Uang</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan jumlah uang">
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jenis Transaksi -->
                            <div class="col-md-6">
                                <label for="jenis" class="form-label">Pilih Jenis Transaksi</label>
                                <select name="jenis" id="jenis" class="form-select @error('jenis') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    <option value="pemasukan">Pemasukkan</option>
                                    <option value="pengeluaran">Pengeluaran</option>
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <!-- Tanggal -->
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="keterangan" class="form-label">Deskripsi</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Tulis keterangan transaksi..."></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                                <i class="ti ti-send fs-5"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
