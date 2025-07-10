@extends('layouts.backend')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />   
@endsectio
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border">
                <!-- Header -->
                <div class="card-header bg-primary text-white fw-semibold">
                    Tambah pembayaran kas 
                </div>

                <!-- Body -->
                <div class="card-body">
                    <form action="{{ route('backend.pembayaran.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="">Pilih Nama Siswa</label>
                            <select id="nama" name="user_id" class="form-select @error('jenis') is-invalid @enderror" >
                                <option value="">Pilih</option>
                                @foreach($users as $data)
                                <option value="{{ $data->id }}">{{$data->name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Jumlah Uang -->
                            <div class="col-md-6 mb-3">
                                <label for="jumlah" class="form-label">Jumlah Uang</label>
                                <input type="number" name="jumlah" id="jumlah"
                                       class="form-control @error('jumlah') is-invalid @enderror"
                                       placeholder="Masukkan jumlah uang" value="{{ old('jumlah') }}">
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal -->
                            <div class="col-md-6 mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal"
                                       class="form-control @error('tanggal') is-invalid @enderror"
                                       value="{{ old('tanggal') }}">
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                                <i class="ti ti-send fs-5"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div> <!-- End Card Body -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">	
	$(document).ready(function() {
		$('#nama').select2();
	});
</script>
@endpush