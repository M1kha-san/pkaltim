@extends('layouts.public')

@section('content')

<section class="hero-section position-relative d-flex align-items-center text-white"
    style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.5)), url('https://stikeshb.ac.id/wp-content/uploads/2022/12/chicken-skewers-with-slices-apples-chili-top-view_2829-19996.webp'); background-size: cover; background-position: center; min-height: 100vh;">

    <div class="container position-relative z-1">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-3 fw-bold mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    Jelajahi Cita Rasa <br> <span class="text-warning">Autentik Bumi Etam</span>
                </h1>
                <p class="lead mb-5 fs-5" style="max-width: 650px; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                    Temukan beragam kuliner autentik Kalimantan Timur dari berbagai kota dan kabupaten. Dari hidangan tradisional hingga sajian legendaris, semua dirangkum untuk memudahkan kamu menjelajah, mencicipi, dan mengenal budaya lewat rasa.
                </p>

                <div class="card border-0 p-2 shadow-lg search-card" style="max-width: 850px; background: rgba(255, 255, 255, 0.95);">
                    <form action="{{ route('kuliner.index') }}" method="GET" class="row g-0 align-items-center">

                        <div class="col-lg-5 position-relative">
                            <div class="d-flex align-items-center px-3 py-2">
                                <i class="fas fa-search text-muted me-3"></i>
                                <input type="text" name="search" class="form-control border-0 shadow-none p-0" placeholder="Cari kuliner..." style="background: transparent;">
                            </div>
                        </div>

                        <!-- Divider Line -->
                        <div class="d-none d-lg-block" style="width: 1px; height: 40px; background-color: #dee2e6;"></div>
                        <div class="d-lg-none w-100 border-top my-1"></div>

                        <div class="col-lg position-relative">
                            <div class="d-flex align-items-center px-3 py-2">
                                <i class="fas fa-map-marker-alt text-muted me-3"></i>
                                <select name="daerah" class="form-select border-0 shadow-none p-0 bg-transparent" style="cursor: pointer;">
                                    <option value="">Semua Kota/Kab</option>
                                    @foreach($daerahs as $daerah)
                                    <option value="{{ $daerah }}">{{ $daerah }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 px-2">
                            <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill fw-bold text-dark hover-effect">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-bold display-6 mb-0">Kuliner</h2>
            <a href="{{ route('kuliner.index') }}" class="btn btn-outline-success rounded-pill px-4 fw-bold">
                Lihat Semua Menu
            </a>
        </div>

        <div class="row g-4">
            @forelse($featured as $item)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-kuliner">
                    <div class="position-relative">
                        <span class="position-absolute top-0 start-0 m-3 badge bg-light text-dark shadow-sm px-3 py-2 rounded-pill fw-bold">
                            <i class="fas fa-map-pin text-danger me-1"></i> {{ $item->asal_daerah }}
                        </span>

                        @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama_makanan }}" style="height: 250px; object-fit: cover;">
                        @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 250px;">
                            <i class="fas fa-image fa-3x opacity-50"></i>
                        </div>
                        @endif
                    </div>

                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-2">
                            <a href="{{ route('kuliner.show', $item->id) }}" class="text-decoration-none text-dark stretched-link">
                                {{ $item->nama_makanan }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small mb-3">
                            {{ Str::limit($item->deskripsi, 50, '...') }}
                        </p>

                        <div class="d-flex align-items-center text-warning small">
                            @php $rating = $item->rating_rata_rata; @endphp

                            @if($rating == 0)
                            @for($i=0; $i<5; $i++) <i class="far fa-star text-muted"></i> @endfor
                                <span class="text-muted ms-1 small">(Belum ada)</span>
                                @else
                                <span class="fw-bold text-dark me-1">{{ number_format($rating, 1) }}</span>
                                @for($i=1; $i<=5; $i++)
                                    <i class="fas fa-star {{ $i <= round($rating) ? '' : 'text-muted opacity-25' }}"></i>
                                    @endfor
                                    <span class="text-muted ms-1 small">({{ $item->jumlah_ulasan }})</span>
                                    @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada data kuliner.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
                <div class="rounded-4 bg-secondary shadow-sm overflow-hidden Position-relative" style="height: 400px;">
                    <img src="https://images.unsplash.com/photo-1626074353765-5e7e63b09305?q=80&w=1000&auto=format&fit=crop" class="w-100 h-100 object-fit-cover" alt="Tentang Kaltim">
                </div>
            </div>

            <div class="col-lg-6">
                <h6 class="text-dark fw-bold text-uppercase mb-2">Tentang Kalimantan Timur</h6>
                <h2 class="fw-bold display-5 mb-4">Bumi Etam, Kaya Budaya <br> <span class="text-warning">dan Cita Rasa</span></h2>

                <p class="text-muted mb-4">
                    Kalimantan Timur, yang dikenal sebagai Bumi Etam, merupakan wilayah yang kaya akan keberagaman budaya, alam, dan tradisi kuliner. Setiap kota dan kabupaten memiliki ciri khas masakan yang lahir dari perpaduan budaya Dayak, Kutai, Banjar, dan pendatang lainnya.
                </p>
                <p class="text-muted mb-4">
                    Kuliner Kalimantan Timur bukan hanya tentang rasa, tetapi juga cerita yang mencerminkan kearifan lokal dan kekayaan alamnya.
                </p>

                <div class="d-flex align-items-start p-4 bg-white rounded-4 shadow-sm border-start border-4 " style="border-color: #27443A !important;">
                    <i class="fas fa-lightbulb text-warning fa-2x me-3"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Tahukah Kamu?</h6>
                        <small class="text-muted">Banyak makanan khas Kalimantan Timur menggunakan bahan alami lokal seperti ikan sungai, umbi-umbian, dan rempah tradisional yang diwariskan secara turun-temurun.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Platform Section -->
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center">

            <div class="col-lg-6 mb-4 mb-lg-0">
                <h6 class="text-dark fw-bold text-uppercase mb-2">Tentang Platform Kami</h6>
                <h2 class="fw-bold display-5 mb-4">Lorem ipsum dolor sit amet consectetur</h2>

                <p class="text-muted mb-4">
                    Menjelajahi Kuliner Bumi Etam dalam Satu Platform
                    Platform ini hadir untuk membantu kamu menemukan dan menjelajahi kuliner khas Kalimantan Timur dengan mudah. </p>
                <p class="text-muted mb-4">
                    Kami menghubungkan pengguna dengan berbagai rekomendasi tempat makan, informasi lokasi, serta detail harga yang transparan dan terpercaya.
                </p>
                <p class="text-muted mb-4">
                    Dengan dukungan UMKM lokal, kami berkomitmen memperkenalkan kekayaan kuliner Bumi Etam sekaligus mendorong pertumbuhan pelaku usaha daerah.
                </p>

                <div class="row g-4 mt-2">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle text-success fs-4 me-3"></i>
                            <span class="fw-bold">Peta Lokasi Akurat</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle text-success fs-4 me-3"></i>
                            <span class="fw-bold">Info harga Transparan</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle text-success fs-4 me-3"></i>
                            <span class="fw-bold">Rekomendasi Terbaik</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle text-success fs-4 me-3"></i>
                            <span class="fw-bold">Dukung UMKM Lokal</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ps-lg-5">
                <div class="rounded-4 bg-light shadow-sm overflow-hidden" style="height: 400px;">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" class="w-100 h-100 object-fit-cover" alt="Platform">
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .search-card {
        border-radius: 50px;
    }

    @media (max-width: 991.98px) {
        .search-card {
            border-radius: 20px;
        }
    }

    .hover-up {
        transition: transform 0.3s ease;
    }

    .card-kuliner:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.15) !important;
    }

    .hover-effect:hover {
        background-color: #FCC549;
        transform: scale(1.05);
        transition: 0.3s;
    }
</style>

@endsection