@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Edit Transaksi Kas
                    </div>
                    <div class="card-body">
                        <form action="{{ route('backend.transaksi.update', $transaksi->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Pilih Nama Siswa</label>
                                        <select class="form-select @error('user_id') is-invalid @enderror" name="user_id">
                                            <option value="">Pilih</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}" {{ $transaksi->user_id == $data->id ? 'selected' : '' }}>
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Jumlah Uang</label>
                                        <input type="number" name="jumlah" value="{{ $transaksi->jumlah }}"
                                            class="form-control @error('jumlah') is-invalid @enderror">
                                        @error('jumlah')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Pilih Jenis Transaksi</label>
                                        <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
                                            <option value="">Pilih</option>
                                            <option value="pemasukan" {{ $transaksi->jenis == 'pemasukan' ? 'selected' : '' }}>Pemasukkan</option>
                                            <option value="pengeluaran" {{ $transaksi->jenis == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                        </select>
                                        @error('jenis')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Tanggal</label>
                                        <input type="date" name="tanggal" value="{{ $transaksi->tanggal }}"
                                            class="form-control @error('tanggal') is-invalid @enderror">
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-4">
                                        <label>Deskripsi</label>
                                        <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ $transaksi->keterangan }}</textarea>
                                        @error('keterangan')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-md-flex align-items-center">
                                <div class="mt-3 mt-md-0 ms-auto">
                                    <button type="submit" class="btn btn-warning hstack gap-6">
                                        <i class="ti ti-edit fs-4"></i>
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
