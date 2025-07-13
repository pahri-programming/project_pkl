@extends('layouts.frontend')

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section accent-background">

            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-5 justify-content-between">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2><span>Dana </span><span class="accent">Kas</span></h2>
                        <p>Sed autem laudantium dolores. Voluptatem itaque ea consequatur eveniet. Eum quas beatae cumque
                            eum quaerat.</p>

                    </div>
                    <div class="col-lg-5 order-1 order-lg-2">
                        <img src="{{ asset('assets/frontend/img/hero-img.svg') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>

            <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
                <div class="container position-relative">
                    <div class="row gy-4 mt-5">

                        <div class="col-xl-6 col-md-3 mx-auto">
                            <div class="icon-box">
                                <div class="icon"><i class="bi bi-cash-stack"></i></div>
                                <h4 class="title">Saldo Kas</h4>
                                <h5>Rp. {{ number_format($saldokas, '0', '.', '.') }}</h5>
                            </div>
                        </div><!--End Icon Box -->

                    </div>
                </div>
            </div>
        </section><!-- /Hero Section -->


        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kelola Uang Kas</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <div class="table-wrapper mx-auto p-3" style="max-width: 900px;">
                        <div class="table-responsive">
                            <table id="datatransaksi" class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($transaksi as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->jenis }}</td>
                                            <td>{{ number_format($data->jumlah, 0, '.', '.') }}</td>
                                            <td>{{ $data->keterangan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Services Section -->





    </main>
@endsection
