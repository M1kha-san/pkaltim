@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<style>
    /* Styling Card */
    .card-stat { border-radius: 15px; border: none; transition: transform 0.2s; }
    /* .card-stat:hover { transform: translateY(-5px); } */
    .text-green-theme { color: #1b4d3e; }
    .bg-green-theme { background-color: #1b4d3e; }
</style>

<div class="pt-3 pb-2 mb-4">
    <h1 class="h3 fw-bold text-green-theme">Dashboard Overview</h1>
    <p class="text-muted">Selamat datang kembali, Admin!</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-6 col-xl-3">
        <div class="card card-stat shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Kuliner</h6>
                    <h3 class="fw-bold text-green-theme">{{ $totalMakanan }}</h3>
                </div>
                <div class="icon-shape bg-light text-success rounded-circle p-3">
                    <i class="fas fa-utensils fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-stat shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Rumah Makan</h6>
                    <h3 class="fw-bold text-green-theme">{{ $totalRumahMakan }}</h3>
                </div>
                <div class="icon-shape bg-light text-warning rounded-circle p-3">
                    <i class="fas fa-store fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-stat shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Review</h6>
                    <h3 class="fw-bold text-green-theme">{{ $totalReview }}</h3>
                </div>
                <div class="icon-shape bg-light text-info rounded-circle p-3">
                    <i class="fas fa-star fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-stat shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Daerah</h6>
                    <h3 class="fw-bold text-green-theme">{{ $totalDaerah }}</h3>
                </div>
                <div class="icon-shape bg-light text-danger rounded-circle p-3">
                    <i class="fa-solid fa-map fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="mb-0 fw-bold text-green-theme"><i class="fas fa-chart-pie me-2"></i>Statistik Kuliner per Daerah</h6>
            </div>
            <div class="card-body">
                <canvas id="kulinerChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="mb-0 fw-bold text-warning"><i class="fas fa-trophy me-2"></i>Top 5 Rating Rumah Makan</h6>
            </div>
            <div class="card-body">
                <canvas id="chartRating" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // --- CHART 1: KULINER PER DAERAH ---
    const ctx = document.getElementById('kulinerChart').getContext('2d');
    const labelsDaerah = {!! json_encode($kulinerPerDaerah->pluck('asal_daerah')->values()) !!};
    const dataDaerah = {!! json_encode($kulinerPerDaerah->pluck('total')->values()) !!};

    new Chart(ctx, {
        type: 'doughnut', 
        data: {
            labels: labelsDaerah, // Label: ['Samarinda', 'Balikpapan']
            datasets: [{
                label: 'Jumlah Menu',
                data: dataDaerah, // Data: [5, 3]
                backgroundColor: [
                    '#1b4d3e', // Hijau Tua
                    '#2d6a4f', 
                    '#40916c', 
                    '#52b788',
                    '#74c69d',
                    '#95d5b2'
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' }
            }
        }
    });

    // --- CHART 2: RATING RUMAH MAKAN ---
    const ctxRating = document.getElementById('chartRating').getContext('2d');
    const labelsRating = {!! json_encode($topRumahMakan->pluck('nama_rumah_makan')->values()) !!};
    // Mapping manual rata-rata rating + values()
    const dataRating = {!! json_encode($topRumahMakan->map(fn($item) => $item->rata_rata_rating)->values()) !!};

    new Chart(ctxRating, {
        type: 'bar',
        data: {
            labels: labelsRating, // Label: ['RM A', 'RM B']
            datasets: [{
                label: 'Rating (Bintang)',
                data: dataRating, // Data: [4.5, 3.0]
                backgroundColor: '#ffc107', 
                borderRadius: 5,
                barThickness: 25 // Ketebalan batang
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y', // Horizontal Bar
            scales: {
                x: {
                    beginAtZero: true,
                    max: 5, // Mentok bintang 5
                    ticks: {
                        stepSize: 0.5 // Kelipatan 0.5
                    }
                },
                y: {
                    grid: { display: false }
                }
            },
            plugins: {
                legend: { display: false } // Sembunyikan legenda "Rating (Bintang)" biar bersih
            }
        }
    });
</script>
@endsection