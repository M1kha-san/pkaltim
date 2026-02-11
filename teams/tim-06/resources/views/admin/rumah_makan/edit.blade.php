@extends('layouts.admin')
@section('title', 'Data Rumah Makan')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Rumah Makan</h1>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.rumah-makan.update', $rumahMakan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nama Rumah Makan</label>
                        <input type="text" name="nama_rumah_makan" class="form-control" value="{{ old('nama_rumah_makan', $rumahMakan->nama_rumah_makan) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="no_telpon" class="form-control" value="{{ old('no_telpon', $rumahMakan->no_telpon) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" class="form-control" required>{{ old('alamat', $rumahMakan->alamat) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" id="latitude" name="latitude" class="form-control" value="{{ old('latitude', $rumahMakan->latitude) }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" id="longitude" name="longitude" class="form-control" value="{{ old('longitude', $rumahMakan->longitude) }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold text-primary"><i class="fas fa-map-marker-alt me-1"></i> Update Lokasi</label>
                    <div id="map" style="height: 400px; width: 100%; border-radius: 10px; border: 2px solid #ddd;"></div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('admin.rumah-makan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
    </div>
</div>

<hr class="my-5">

<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <span class="badge bg-warning text-dark fs-6">
                    Rata-rata: {{ $rumahMakan->rata_rata_rating }} / 5.0
                    ({{ $rumahMakan->reviews->count() }} Ulasan)
                </span>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4 border-end">
                        <h6 class="small fw-bold mb-3">Tambah Review Baru</h6>
                        <form action="{{ route('admin.rumah-makan.review.store', $rumahMakan->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small">Nama User (dari Google)</label>
                                <input type="text" name="nama_user" class="form-control form-control-sm" placeholder="cth: Budi Santoso" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">Rating</label>
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
                                <label class="form-label small">Isi Komentar</label>
                                <textarea name="komentar" class="form-control form-control-sm" rows="3" placeholder="Copy-paste review dari Google Maps..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">Tanggal</label>
                                <input type="date" name="tanggal_review" class="form-control form-control-sm">
                            </div>
                            <button type="submit" class="btn btn-sm btn-dark w-100">Simpan Review</button>
                        </form>
                    </div>

                    <div class="col-md-8">
                        <h6 class="small fw-bold mb-3">Daftar Review Tersimpan</h6>
                        <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                            @forelse($rumahMakan->reviews()->latest()->get() as $review)
                            <div class="list-group-item px-0">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>{{ $review->nama_user }}</strong>
                                        <span class="text-warning small ms-2">
                                            @for($i=0; $i<$review->rating; $i++) <i class="fas fa-star"></i> @endfor
                                        </span>
                                    </div>
                                    <form action="{{ route('admin.review.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus review ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-link text-danger btn-sm p-0"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                                <p class="small text-muted mb-1 mt-1">"{{ $review->komentar }}"</p>
                                <small class="text-secondary" style="font-size: 0.75rem;">{{ $review->tanggal_review ?? '-' }}</small>
                            </div>
                            @empty
                            <div class="text-center py-4 text-muted small">Belum ada review yang dimasukkan.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
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

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil data Lat/Long sebagai String dulu biar aman
        var latStr = "{{ $rumahMakan->latitude }}";
        var lngStr = "{{ $rumahMakan->longitude }}";

        // Bersihkan data (Ubah koma jadi titik, handle jika kosong)
        var savedLat = parseFloat(latStr.replace(',', '.')) || -0.502183;
        var savedLng = parseFloat(lngStr.replace(',', '.')) || 117.153801;

        // Inisialisasi Map
        var map = L.map('map').setView([savedLat, savedLng], 15);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        // Marker Draggable
        var marker = L.marker([savedLat, savedLng], {
            draggable: true
        }).addTo(map);

        // Update Input saat Marker digeser
        marker.on('dragend', function(e) {
            var lat = marker.getLatLng().lat;
            var lng = marker.getLatLng().lng;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

        // Pindah Marker saat Peta diklik
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        });

        // Update Marker saat Input diketik manual
        var latInput = document.getElementById('latitude');
        var lngInput = document.getElementById('longitude');

        function updateMarkerFromInput() {
            var lat = parseFloat(latInput.value.replace(',', '.'));
            var lng = parseFloat(lngInput.value.replace(',', '.'));

            if (!isNaN(lat) && !isNaN(lng)) {
                var newLatLng = new L.LatLng(lat, lng);
                marker.setLatLng(newLatLng);
                map.panTo(newLatLng);
            }
        }

        latInput.addEventListener('input', updateMarkerFromInput);
        lngInput.addEventListener('input', updateMarkerFromInput);

        // Fix tampilan peta saat load (agar tidak abu-abu)
        setTimeout(function() {
            map.invalidateSize();
        }, 500);
    });
</script>
@endsection