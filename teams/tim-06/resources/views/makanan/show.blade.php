@extends('layouts.public')
@section('content')

<section class="py-5 bg-white border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kuliner.index') }}" class="text-decoration-none text-muted">Jelajah</a></li>
                <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">{{ $kuliner->nama_makanan }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="position-relative rounded-4 overflow-hidden shadow-lg">
                    <span class="position-absolute top-0 start-0 m-3 badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold z-2">
                        <i class="fas fa-map-marker-alt me-1"></i> Khas {{ $kuliner->asal_daerah }}
                    </span>
                    @if($kuliner->gambar)
                    <img src="{{ asset('storage/' . $kuliner->gambar) }}" class="w-100 object-fit-cover" style="height: 450px;" alt="{{ $kuliner->nama_makanan }}">
                    @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 450px;">
                        <i class="fas fa-image fa-3x opacity-50"></i>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 ps-lg-5 d-flex flex-column justify-content-center">
                <h1 class="display-4 fw-bold mb-3 text-dark">{{ $kuliner->nama_makanan }}</h1>

                <div class="d-flex align-items-center mb-4 gap-4">
                    <div>
                        <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Harga</small>
                        @php
                        // Ambil harga terendah & tertinggi
                        $minHarga = $kuliner->rumahMakans->min('pivot.harga') ?? 0;
                        $maxHarga = $kuliner->rumahMakans->max('pivot.harga') ?? 0;
                        @endphp

                        <h2 class="text-success fw-bold m-0">
                            Rp {{ number_format($minHarga, 0, ',', '.') }}
                            @if($minHarga != $maxHarga && $maxHarga > 0)
                            - {{ number_format($maxHarga, 0, ',', '.') }}
                            @endif
                        </h2>
                    </div>

                    <div class="border-start ps-4"></div>

                    <div>
                        <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Rating</small>
                        <div class="d-flex align-items-center">
                            <span class="fs-3 fw-bold text-warning me-2">{{ $avgRating }}</span>
                            <div class="text-warning small me-2">
                                @for($i=1; $i<=5; $i++)
                                    <i class="fas fa-star {{ $i <= round($avgRating) ? '' : 'text-muted opacity-25' }}"></i>
                                    @endfor
                            </div>
                            <span class="text-muted small">({{ $totalUlasan }} Ulasan)</span>
                        </div>
                    </div>
                </div>

                <hr class="border-secondary opacity-10 mb-4">

                <h5 class="fw-bold mb-2">Tentang Kuliner Ini</h5>
                <p class="lead text-muted" style="line-height: 1.8; font-size: 1.1rem;">
                    {{ $kuliner->deskripsi }}
                </p>
            </div>
        </div>
    </div>
</section>

<section id="lokasi-penjual" class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h3 class="fw-bold mb-1">Peta Lokasi Penjual</h3>
                <p class="text-muted mb-0">
                    @if($kuliner->rumahMakans->count() > 0)
                    Tersebar di {{ $kuliner->rumahMakans->count() }} titik lokasi
                    @else
                    <span class="text-danger"><i class="fas fa-exclamation-circle"></i> Belum ada lokasi terdaftar. (Hubungkan di Admin Panel)</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div id="map" style="height: 500px; width: 100%; z-index: 1;"></div>
        </div>
        <div class="mt-2 text-center">
            <small class="text-muted fst-italic"><i class="fas fa-info-circle me-1"></i> Klik pada pin marker untuk melihat detail warung.</small>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 bg-success bg-opacity-10">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-2"><i class="fas fa-pen-nib me-2"></i>Tulis Review</h4>
                        <p class="small text-muted mb-4">Bagikan pengalamanmu menikmati hidangan ini.</p>

                        @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3 small">
                            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                        </div>
                        @endif

                        <form action="{{ route('review.public.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold small">Nama Kamu</label>
                                <input type="text" name="nama_user" class="form-control" placeholder="Isi nama..." required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">Makan di mana?</label>
                                <select name="rumah_makan_id" class="form-select" required>
                                    @if($kuliner->rumahMakans->count() > 0)
                                    <option value="">-- Pilih Lokasi --</option>
                                    @foreach($kuliner->rumahMakans as $rm)
                                    <option value="{{ $rm->id }}">{{ $rm->nama_rumah_makan }}</option>
                                    @endforeach
                                    @else
                                    <option value="" disabled selected>Belum ada lokasi tersedia</option>
                                    @endif
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">Rating</label>
                                <div class="rating-css">
                                    <div class="star-icon">
                                        <input type="radio" name="rating" value="1" id="rating1" required>
                                        <label for="rating1" class="fa fa-star"></label>

                                        <input type="radio" name="rating" value="2" id="rating2">
                                        <label for="rating2" class="fa fa-star"></label>

                                        <input type="radio" name="rating" value="3" id="rating3">
                                        <label for="rating3" class="fa fa-star"></label>

                                        <input type="radio" name="rating" value="4" id="rating4">
                                        <label for="rating4" class="fa fa-star"></label>

                                        <input type="radio" name="rating" value="5" id="rating5" checked>
                                        <label for="rating5" class="fa fa-star"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">Komentar</label>
                                <textarea name="komentar" class="form-control" rows="3" placeholder="Ceritakan pengalamanmu..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-success w-100 fw-bold rounded-pill" {{ $kuliner->rumahMakans->count() == 0 ? 'disabled' : '' }}>Kirim Review</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <h4 class="fw-bold mb-4">Ulasan Pengunjung</h4>

                @forelse($allReviews as $review)
                <div class="d-flex mb-4 pb-4 border-bottom">
                    <div class="flex-shrink-0">
                        <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            {{ substr($review->nama_user, 0, 1) }}
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <h6 class="fw-bold mb-0">{{ $review->nama_user }}</h6>
                            <small class="text-muted">
                                {{ $review->created_at ? $review->created_at->diffForHumans() : $review->tanggal_review }}
                            </small>
                        </div>
                        <small class="text-muted d-block mb-1">Makan di: {{ $review->lokasi }}</small>
                        <div class="text-warning my-1" style="font-size: 0.8rem;">
                            @for($i=0; $i<$review->rating; $i++) <i class="fas fa-star"></i> @endfor
                        </div>
                        <p class="text-muted mb-0 bg-light p-2 rounded-3 mt-1 small">"{{ $review->komentar }}"</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 border rounded-4 bg-light">
                    <p class="text-muted mb-0">Belum ada review. Yuk jadi yang pertama!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<style>
    .object-fit-cover {
        object-fit: cover;
    }

    .rating-css div {
        color: #ffe400;
        font-size: 20px;
        font-family: sans-serif;
        font-weight: 800;
        text-align: left;
        text-transform: uppercase;
        padding: 0;
    }

    .rating-css input {
        display: none;
    }

    .rating-css input+label {
        font-size: 24px;
        text-shadow: 1px 1px 0 #8f8420;
        cursor: pointer;
        margin-right: 5px;
    }

    .rating-css input:checked+label~label {
        color: #b4b4b4;
    }

    .rating-css label:active {
        transform: scale(0.8);
        transition: 0.3s ease;
    }
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil data dari Controller
        var locations = @json($kuliner->rumahMakans);

        // Inisialisasi Map (Default Samarinda)
        var map = L.map('map').setView([-0.502183, 117.153801], 12);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var markers = [];

        locations.forEach(function(loc) {
            // Convert koordinat ke float dengan aman
            var latStr = String(loc.latitude).replace(',', '.');
            var lngStr = String(loc.longitude).replace(',', '.');
            var lat = parseFloat(latStr);
            var lng = parseFloat(lngStr);

            // Cek apakah hasil convert adalah angka valid
            if (!isNaN(lat) && !isNaN(lng) && lat !== 0 && lng !== 0) {
                var marker = L.marker([lat, lng]).addTo(map);
                var harga = new Intl.NumberFormat('id-ID').format(loc.pivot.harga);

                // Konten Popup
                marker.bindPopup(`
                    <div class="text-center p-2">
                        <h6 class="fw-bold mb-1">${loc.nama_rumah_makan}</h6>
                        <a href="https://www.google.com/maps/search/?api=1&query=${lat},${lng}"
                           target="_blank" class="btn btn-sm btn-primary text-white py-0 px-2 mt-1" style="font-size:12px;">
                           Buka Maps
                        </a>
                    </div>
                `);
                markers.push(marker);
            }
        });

        // Fitur Auto Zoom ke Marker
        if (markers.length > 0) {
            var group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds().pad(0.1));
        }

        // Agar map tidak abu-abu saat load
        setTimeout(function() {
            map.invalidateSize();
        }, 500);
    });
</script>

@endsection