@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Tambah Transaksi Kas
                    </div>
                    <div class="card-body">
                        <form action="{{ route('backend.transaksi.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Pilih Nama Siswa</label>
                                        <select class="form-select @error('user_id') is-invalid @enderror" name="user_id">
                                            <option value="">Pilih</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Jumlah Uang</label>
                                        <input type="number" name="jumlah"
                                            class="form-control @error('jumlah') is-invalid @enderror">
                                        @error('jumlah')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Pilih Jenis Transaksi</label>
                                        <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
                                            <option value="">Pilih</option>
                                            <option value="pemasukan">Pemasukkan</option>
                                            <option value="pengeluaran">Pengeluaran</option>
                                        </select>
                                        @error('jenis')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Tanggal</label>
                                        <input type="date" name="tanggal"
                                            class="form-control @error('tanggal') is-invalid @enderror">
                                        @error('tanggal')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-4">
                                        <label>Deskripsi</label>
                                        <textarea name="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror"></textarea>
                                        @error('keterangan')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="d-md-flex align-items-center">
                                <div class="mt-3 mt-md-0 ms-auto">
                                    <button type="submit" class="btn btn-primary  hstack gap-6">
                                        <i class="ti ti-send fs-4"></i>
                                        Submit
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
