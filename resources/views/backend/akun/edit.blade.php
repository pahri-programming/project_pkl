@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Edit Data Akun
                    </div>
                    <div class="card-body">
                        <form action="{{ route('backend.akun.update', $akun->id) }}" method="post"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name" value="{{ $akun->name }}"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Username">
                                        <label>
                                            <i class="ti ti-user me-2 fs-4"></i>Nama
                                        </label>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" name="email"  value="{{ $akun->email }}"
                                            class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                        <label>
                                            <i class="ti ti-mail me-2 fs-4"></i>Email
                                        </label>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
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
