@extends('layouts.public')
@section('title', 'RasaKaltim - Jelajah Kuliner')

@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <!-- Title & Search Section -->
        <h2 class="fw-bold fs-2 mb-4 text-dark font-poppins">Jelajahi Kuliner Khas Kaltim</h2>

        <form action="{{ route('kuliner.index') }}" method="GET" class="mb-5">
            <div class="row g-3">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center rounded-4 px-3 py-2" style="background-color: #E0E0E0;">
                        <i class="fas fa-search text-muted ms-2 fs-5"></i>
                        <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none"
                            placeholder="Cari kuliner..." value="{{ request('search') }}" style="font-size: 1rem;">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center rounded-4 px-3 py-2" style="background-color: #E0E0E0;">
                        <i class="fas fa-map-marker-alt text-dark ms-2 fs-5"></i>
                        <select name="daerah" class="form-select border-0 bg-transparent shadow-none text-dark" style="cursor: pointer; font-size: 1rem;">
                            <option value="">Semua Kota/Kab</option>
                            @foreach($daerahs as $daerah)
                            <option value="{{ $daerah }}" {{ request('daerah') == $daerah ? 'selected' : '' }}>
                                {{ $daerah }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-warning w-100 rounded-pill py-3 fw-bold text-dark hover-effect">
                        Cari
                    </button>
                </div>
            </div>
        </form>

        <!-- Grid -->
        <div class="row g-4">
            @forelse($makanans as $item)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-kuliner position-relative">
                    <a href="{{ route('kuliner.show', $item->id) }}" class="text-decoration-none">
                        <div class="position-relative">
                            <span class="position-absolute top-0 start-0 m-3 bg-white text-dark shadow-sm px-3 py-1 rounded-pill fw-bold" style="font-size: 0.7rem; z-index:10;">
                                <i class="fas fa-map-marker-alt text-dark me-1"></i> {{ $item->asal_daerah }}
                            </span>
                            @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top object-fit-cover" alt="{{ $item->nama_makanan }}" style="height: 200px;">
                            @else
                            <div class="bg-light text-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-image fa-2x opacity-25"></i>
                            </div>
                            @endif
                        </div>

                        <div class="card-body p-3">
                            <h6 class="card-title fw-bold text-dark mb-1">{{ $item->nama_makanan }}</h6>
                            <p class="card-text text-muted small mb-3" style="font-size: 0.8rem;">
                                {{ Str::limit($item->deskripsi, 40) }}
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
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 py-5 text-center">
                <div class="mb-3">
                    <i class="fas fa-search fa-3x text-muted opacity-25"></i>
                </div>
                <h5 class="text-muted">Kuliner tidak ditemukan</h5>
                <p class="text-muted small">Coba kata kunci lain atau ubah filter lokasi.</p>
                <a href="{{ route('kuliner.index') }}" class="btn btn-outline-dark rounded-pill mt-3">Reset Filter</a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $makanans->withQueryString()->links() }}
        </div>
    </div>
</section>

<style>
    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }

    .hover-effect:hover {
        background-color: #ffca2c;
        transform: scale(1.02);
        transition: 0.3s;
    }

    .card-kuliner {
        transition: transform 0.2s;
        background: #fff;
    }

    .card-kuliner:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }

    .form-control::placeholder {
        color: #999;
    }
</style>
@endsection