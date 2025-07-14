@extends('layouts.frontend')

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section accent-background">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-5 justify-content-between">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2><span>Dana </span><span class="accent">Kas</span></h2>
                        <p>Halaman Profile</p>
                    </div>
                    <div class="col-lg-5 order-1 order-lg-2">
                        <img src="{{ asset('assets/frontend/img/hero-img.svg') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <!-- Profile Detail Section -->
        <section id="services" class="services section">
            <div class="container py-5 mt-4 d-flex justify-content-center">
                <div class="card shadow-sm" style="max-width: 600px; width: 100%;">

                    {{-- Avatar + Nama --}}
                    <div class="card-header text-center bg-white">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff&size=80"
                            class="rounded-circle mb-2" alt="Avatar" width="80" height="80">
                        <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><strong>Nama : {{ Auth::user()->name }}</strong></label>
                                    <div></div>
                                </div>

                                <div class="mb-3">
                                    <label><strong>Email : {{ Auth::user()->email }}</strong></label>
                                    <div></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><strong> Jumlah Uangmu : Rp.
                                            {{ number_format($jumlahuang, 0, '.', '.') }}</strong></label>
                                    <div></div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
        </section>
    </main>
@endsection
