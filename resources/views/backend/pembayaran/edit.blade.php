@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Header -->
                <div class="card-header bg-primary text-white fw-bold">
                    Edit Pembayaran Kas Mingguan
                </div>

                <!-- Body -->
                <div class="card-body">
                    <form action="{{ route('backend.pembayaran.update', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <!-- Nama Siswa -->
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">Pilih Nama Siswa</label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                    <option value=""> Pilih Siswa</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $pembayaran->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jumlah Uang -->
                            <div class="col-md-6">
                                <label for="jumlah" class="form-label">Jumlah Pembayaran</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                                    value="{{ $pembayaran->jumlah }}" placeholder="Masukkan jumlah (Rp)">
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <!-- Tanggal Bayar -->
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label">Tanggal Pembayaran</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                                    value="{{ $pembayaran->tanggal }}">
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning d-flex align-items-center gap-2">
                                <i class="ti ti-edit fs-5"></i> Update
                            </button>
                        </div>
                    </form>
                </div> <!-- End Card Body -->
            </div>
        </div>
    </div>
</div>
@endsection
