@extends('layouts.admin')
@section('title', 'Data Rumah Makan')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Rumah Makan Baru</h1>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.rumah-makan.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nama Rumah Makan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_rumah_makan" class="form-control" required placeholder="Contoh: RM. Amado">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="no_telpon" class="form-control" required placeholder="0812...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat" rows="3" class="form-control" required placeholder="Jl. Pangeran Antasari..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" id="latitude" name="latitude" class="form-control"> <!--bisa pake readonly biar tidak bisa input manual-->
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" id="longitude" name="longitude" class="form-control"> <!--bisa pake readonly biar tidak bisa input manual-->
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold text-primary"><i class="fas fa-map-marker-alt me-1"></i> Titik Lokasi (Geser Marker)</label>
                    <div id="map" style="height: 400px; width: 100%; border-radius: 10px; border: 2px solid #ddd;"></div>
                    <small class="text-muted">Geser pin ke lokasi tepat rumah makan.</small>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('admin.rumah-makan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil data awal (gunakan 0 jika kosong agar tidak error NaN)
        var savedLat = parseFloat(document.getElementById('latitude').value) || -0.502183;
        var savedLng = parseFloat(document.getElementById('longitude').value) || 117.153801;

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

        // Geser Marker -> Update Input
        marker.on('dragend', function(e) {
            var lat = marker.getLatLng().lat;
            var lng = marker.getLatLng().lng;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

        // Klik peta juga memindahkan marker
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        });

        // Ketik Manual -> Update Marker (BARU)
        var latInput = document.getElementById('latitude');
        var lngInput = document.getElementById('longitude');

        function updateMarkerFromInput() {
            var lat = parseFloat(latInput.value);
            var lng = parseFloat(lngInput.value);

            // Cek apakah angka valid?
            if (!isNaN(lat) && !isNaN(lng)) {
                var newLatLng = new L.LatLng(lat, lng);
                marker.setLatLng(newLatLng); // Pindah marker
                map.panTo(newLatLng); // Geser kamera peta
            }
        }

        // Dengar event 'input' (saat user mengetik)
        latInput.addEventListener('input', updateMarkerFromInput);
        lngInput.addEventListener('input', updateMarkerFromInput);

        // Fix tampilan peta saat load
        setTimeout(function() {
            map.invalidateSize();
        }, 500);
    });
</script>
@endsection