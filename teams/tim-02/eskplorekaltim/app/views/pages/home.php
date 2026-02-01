<?php
$pageTitle = "Explore Kaltim - Surga Alam Borneo";
$pageDescription = "Jelajahi keindahan alam Kalimantan Timur yang memukau.";
include VIEW_PATH . '/layouts/header.php';
?>

<!-- Hero Section -->
<section class="relative h-screen min-h-[700px] flex flex-col justify-center items-center text-white overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <!-- Hutan Orang Utan Kalimantan -->
        <img src="<?= BASE_URL ?>public/images/destinations/orang-utan-kaltim-copy.jpeg" 
             alt="Wisata Alam Kaltim - Hutan Orang Utan" 
             class="w-full h-full object-cover scale-105"
             data-aos="zoom-out" data-aos-duration="3000">
        <!-- Gradient Overlay matching the palette -->
        <div class="absolute inset-0 bg-gradient-to-b from-custom-primary/50 via-transparent to-custom-primary"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 text-center mt-12" data-aos="fade-up" data-aos-duration="1200">
        <h1 class="text-5xl md:text-7xl font-display font-bold mb-6 tracking-tight drop-shadow-2xl leading-none">
            <?= Language::get('home.hero_title', 'WISATA ALAM') ?><br><span class="text-custom-accent"><?= Language::get('home.hero_subtitle', 'KALTIM') ?></span>
        </h1>
        <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl mx-auto font-light tracking-wide">
            <?= Language::get('home.hero_desc', 'Temukan ketenangan di surga tersembunyi Borneo. Hutan tropis, sungai legendaris, dan kepulauan eksotis menunggu Anda.') ?>
        </p>
        
        <!-- Search Widget Glass -->
        <div class="max-w-4xl mx-auto bg-white/10 backdrop-blur-md border border-white/20 rounded-full p-2 shadow-2xl flex flex-col md:flex-row items-center gap-2">
            <form action="<?= BASE_URL ?>destinasi" method="GET" class="w-full h-full flex flex-col md:flex-row gap-2">
                <div class="flex-grow relative h-14 group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 group-focus-within:text-custom-accent transition"></i>
                    </div>
                    <input type="text" name="search" placeholder="<?= Language::get('home.search_placeholder', 'Cari destinasi...') ?>" 
                           class="w-full h-full pl-12 pr-6 rounded-full bg-custom-light text-custom-primary placeholder-gray-500 outline-none focus:ring-2 focus:ring-custom-accent transition font-medium">
                </div>
                
                <div class="md:w-1/3 relative h-14 group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                        <i class="fas fa-map-marked-alt text-gray-400 group-focus-within:text-custom-accent transition"></i>
                    </div>
                    <select name="kategori" class="w-full h-full pl-12 pr-10 rounded-full bg-custom-light text-custom-primary outline-none focus:ring-2 focus:ring-custom-accent transition font-medium appearance-none cursor-pointer">
                        <option value=""><?= Language::get('home.all_categories', 'Semua Kategori') ?></option>
                        <?php foreach($kategoris as $k): ?>
                            <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>

                <button type="submit" class="h-14 px-10 rounded-full bg-custom-secondary hover:bg-custom-primary text-white font-bold transition shadow-lg flex items-center justify-center transform hover:scale-105 active:scale-95 duration-200">
                    <?= Language::get('home.search_btn', 'Cari') ?>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Destinasi Pilihan (Swiper Carousel) -->
<section class="py-24 bg-white relative overflow-hidden" id="destinasi-populer">
    <!-- Subtle Pattern Background -->
    <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(#1D546D 0.5px, transparent 0.5px); background-size: 20px 20px;"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
            <div data-aos="fade-right">
                <span class="inline-block px-3 py-1 rounded-full border border-custom-secondary/30 text-custom-secondary text-xs font-bold tracking-[0.2em] uppercase mb-4">
                    <?= Language::get('home.featured_label', 'Destinasi Pilihan') ?>
                </span>
                <h2 class="text-4xl md:text-5xl font-display font-medium text-custom-primary leading-tight">
                    <?= Language::get('home.featured_title', 'Temukan Petualangan') ?><br><i class="font-serif italic text-custom-secondary"><?= Language::get('home.featured_subtitle', 'Impianmu') ?></i> <?= Language::get('home.featured_here', 'Disini') ?>
                </h2>
            </div>
            
            <div class="hidden md:block mb-2" data-aos="fade-left">
                <p class="text-gray-500 max-w-md text-right leading-relaxed text-sm">
                    <?= Language::get('home.featured_desc', 'Kami memberikan rekomendasi destinasi terbaik di Kalimantan Timur, dari puncak gunung yang berkabut hingga kedalaman laut yang mempesona.') ?>
                </p>
            </div>
        </div>

        <!-- Stylish Filter Bar -->
        <div class="relative mb-14" data-aos="fade-up" data-aos-delay="100">
            <div class="flex flex-col xl:flex-row items-center justify-between gap-6">
                
                <!-- Filter Group -->
                <div class="bg-white p-2 rounded-full shadow-lg shadow-gray-200/50 border border-gray-100 inline-flex flex-wrap justify-center gap-2 mx-auto xl:mx-0">
                    <button class="filter-btn active px-8 py-3.5 rounded-full text-base font-bold transition-all duration-300 bg-custom-secondary text-white shadow-md flex items-center gap-2.5" data-filter="all">
                        <i class="fas fa-globe"></i>
                        <span><?= Language::get('home.filter_all', 'Semua') ?></span>
                    </button>
                    <button class="filter-btn px-8 py-3.5 rounded-full text-base font-medium transition-all duration-300 text-gray-500 hover:text-custom-secondary hover:bg-gray-50 flex items-center gap-2.5" data-filter="gunung">
                        <i class="fas fa-mountain"></i>
                        <span>Gunung</span>
                    </button>
                    <button class="filter-btn px-8 py-3.5 rounded-full text-base font-medium transition-all duration-300 text-gray-500 hover:text-custom-secondary hover:bg-gray-50 flex items-center gap-2.5" data-filter="hutan">
                        <i class="fas fa-tree"></i>
                        <span>Hutan</span>
                    </button>
                    <button class="filter-btn px-8 py-3.5 rounded-full text-base font-medium transition-all duration-300 text-gray-500 hover:text-custom-secondary hover:bg-gray-50 flex items-center gap-2.5" data-filter="sungai">
                        <i class="fas fa-water"></i>
                        <span>Sungai</span>
                    </button>
                    <button class="filter-btn px-8 py-3.5 rounded-full text-base font-medium transition-all duration-300 text-gray-500 hover:text-custom-secondary hover:bg-gray-50 flex items-center gap-2.5" data-filter="pantai">
                        <i class="fas fa-umbrella-beach"></i>
                        <span>Pantai</span>
                    </button>
                    <button class="filter-btn px-8 py-3.5 rounded-full text-base font-medium transition-all duration-300 text-gray-500 hover:text-custom-secondary hover:bg-gray-50 flex items-center gap-2.5" data-filter="air terjun">
                        <i class="fas fa-wind"></i>
                        <span>Air Terjun</span>
                    </button>
                    <button class="filter-btn px-8 py-3.5 rounded-full text-base font-medium transition-all duration-300 text-gray-500 hover:text-custom-secondary hover:bg-gray-50 flex items-center gap-2.5" data-filter="danau">
                        <i class="fas fa-water"></i>
                        <span>Danau</span>
                    </button>
                </div>

                <!-- Navigation Controls -->
                <div class="flex gap-4">
                    <button class="swiper-button-prev-custom w-14 h-14 rounded-full bg-white text-custom-primary border border-gray-100 shadow-md hover:shadow-xl hover:bg-custom-primary hover:text-white transition-all duration-300 flex items-center justify-center group">
                        <i class="fas fa-arrow-left text-lg group-hover:-translate-x-1 transition-transform"></i>
                    </button>
                    <button class="swiper-button-next-custom w-14 h-14 rounded-full bg-white text-custom-primary border border-gray-100 shadow-md hover:shadow-xl hover:bg-custom-primary hover:text-white transition-all duration-300 flex items-center justify-center group">
                        <i class="fas fa-arrow-right text-lg group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Swiper -->
        <div class="swiper mySwiper !overflow-visible">
            <div class="swiper-wrapper">
                <?php foreach ($featuredDestinasi as $destinasi): ?>
                <div class="swiper-slide h-auto">
                    <a href="<?= BASE_URL ?>destinasi/<?= $destinasi['id'] ?>" class="block h-full group">
                        <div class="bg-white rounded-[2rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 h-[500px] relative">
                            <!-- Image -->
                            <img 
                                src="<?= BASE_URL ?>public/images/destinations/<?= $destinasi['foto_utama'] ?>" 
                                alt="<?= htmlspecialchars($destinasi['nama']) ?>"
                                class="w-full h-full object-cover transition duration-700 transform group-hover:scale-110"
                                onerror="this.src='https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=400&h=600&fit=crop&crop=entropy'"
                            >
                            
                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-custom-primary via-custom-primary/20 to-transparent opacity-90"></div>

                            <!-- Content Overlay -->
                            <div class="absolute bottom-0 left-0 w-full p-8 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                <div class="flex items-center space-x-2 mb-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                    <span class="category-badge px-3 py-1 rounded-full bg-custom-accent/90 backdrop-blur text-xs font-bold uppercase tracking-wider">
                                        <?= $destinasi['kategori_nama'] ?>
                                    </span>
                                    <span class="flex items-center text-sm">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i> <?= number_format($destinasi['rating'], 1) ?>
                                    </span>
                                </div>
                                <h3 class="text-2xl md:text-3xl font-display font-bold mb-2 leading-tight">
                                    <?= htmlspecialchars($destinasi['nama']) ?>
                                </h3>
                                <div class="flex items-center text-gray-300 text-sm mb-4">
                                    <i class="fas fa-map-pin mr-2 text-custom-accent"></i>
                                    <?= htmlspecialchars($destinasi['kabupaten_nama']) ?>
                                </div>
                                <p class="text-gray-300 text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-200">
                                    <?= htmlspecialchars($destinasi['deskripsi']) ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Weather Widget Section -->
<section class="py-24 relative overflow-hidden bg-gray-50" id="cuaca">
    <div class="container mx-auto px-6">
        <!-- Section Header -->
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold tracking-widest uppercase mb-4">
                <i class="fas fa-cloud-sun mr-2"></i>Info Cuaca
            </span>
            <h2 class="text-3xl md:text-5xl font-display font-bold text-gray-800 mb-4">
                Kondisi Cuaca <span class="text-emerald-600">Kalimantan Timur</span>
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Pantau cuaca real-time di kota-kota Kalimantan Timur untuk perjalanan wisata yang lebih baik
            </p>
        </div>

        <!-- Weather Cards Grid -->
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="100">
                
                <!-- Samarinda -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Samarinda</h3>
                            <i class="fas fa-map-marker-alt text-emerald-600 text-sm"></i>
                        </div>
                        
                        <div class="text-center py-6">
                            <div id="weather-icon-samarinda" class="mb-3">
                                <i class="fas fa-circle-notch fa-spin text-4xl text-gray-400"></i>
                            </div>
                            <div class="text-4xl font-bold text-gray-800 mb-1" id="weather-temp-samarinda">--°</div>
                            <p class="text-sm text-gray-500 capitalize" id="weather-desc-samarinda">Memuat...</p>
                        </div>

                        <div class="pt-4 border-t border-gray-100 space-y-2">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-500">Kelembaban</span>
                                <span class="font-semibold text-gray-800" id="weather-humidity-samarinda">--%</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-500">Kec. Angin</span>
                                <span class="font-semibold text-gray-800" id="weather-wind-samarinda">--</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Balikpapan -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Balikpapan</h3>
                            <i class="fas fa-map-marker-alt text-emerald-600 text-sm"></i>
                        </div>
                        
                        <div class="text-center py-6">
                            <div id="weather-icon-balikpapan" class="mb-3">
                                <i class="fas fa-circle-notch fa-spin text-4xl text-gray-400"></i>
                            </div>
                            <div class="text-4xl font-bold text-gray-800 mb-1" id="weather-temp-balikpapan">--°</div>
                            <p class="text-sm text-gray-500 capitalize" id="weather-desc-balikpapan">Memuat...</p>
                        </div>

                        <div class="pt-4 border-t border-gray-100 space-y-2">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-500">Kelembaban</span>
                                <span class="font-semibold text-gray-800" id="weather-humidity-balikpapan">--%</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-500">Kec. Angin</span>
                                <span class="font-semibold text-gray-800" id="weather-wind-balikpapan">--</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bontang -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Bontang</h3>
                            <i class="fas fa-map-marker-alt text-emerald-600 text-sm"></i>
                        </div>
                        
                        <div class="text-center py-6">
                            <div id="weather-icon-bontang" class="mb-3">
                                <i class="fas fa-circle-notch fa-spin text-4xl text-gray-400"></i>
                            </div>
                            <div class="text-4xl font-bold text-gray-800 mb-1" id="weather-temp-bontang">--°</div>
                            <p class="text-sm text-gray-500 capitalize" id="weather-desc-bontang">Memuat...</p>
                        </div>

                        <div class="pt-4 border-t border-gray-100 space-y-2">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-500">Kelembaban</span>
                                <span class="font-semibold text-gray-800" id="weather-humidity-bontang">--%</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-500">Kec. Angin</span>
                                <span class="font-semibold text-gray-800" id="weather-wind-bontang">--</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Berau -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800">Berau</h3>
                            <i class="fas fa-map-marker-alt text-emerald-600 text-sm"></i>
                        </div>
                        
                        <div class="text-center py-6">
                            <div id="weather-icon-berau" class="mb-3">
                                <i class="fas fa-circle-notch fa-spin text-4xl text-gray-400"></i>
                            </div>
                            <div class="text-4xl font-bold text-gray-800 mb-1" id="weather-temp-berau">--°</div>
                            <p class="text-sm text-gray-500 capitalize" id="weather-desc-berau">Memuat...</p>
                        </div>

                        <div class="pt-4 border-t border-gray-100 space-y-2">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-500">Kelembaban</span>
                                <span class="font-semibold text-gray-800" id="weather-humidity-berau">--%</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-500">Kec. Angin</span>
                                <span class="font-semibold text-gray-800" id="weather-wind-berau">--</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Update Info -->
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-400">
                    <i class="far fa-clock mr-1"></i>
                    Diperbarui: <span id="last-update-time">--</span> WITA
                </p>
            </div>
        </div>
    </div>
</section>

<!-- About / Highlight Section with new Colors -->
<section class="py-24 bg-custom-secondary text-white relative overflow-hidden" id="tentang">
    <!-- Abstract Shapes -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-custom-accent rounded-full blur-[120px] opacity-20 translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-custom-primary rounded-full blur-[100px] opacity-40 -translate-x-1/2 translate-y-1/2"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2 order-2 md:order-1 relative">
                <div class="relative rounded-[2rem] overflow-hidden shadow-2xl hover:rotate-0 transition duration-500">
                    <img src="https://i.ibb.co/dw8vJQ4R/Surga-Wisata-Pulau-Derawan-Kalimantan-Timur.jpg" 
                         alt="Pantai Derawan Kalimantan Timur" class="w-full object-cover">
                </div>
                <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-custom-accent rounded-full blur-2xl -z-10"></div>
            </div>
            
            <div class="md:w-1/2 order-1 md:order-2" data-aos="fade-left">
                <span class="text-custom-accent font-bold uppercase tracking-widest text-xs mb-4 block">Tentang Wisata</span>
                <h2 class="text-4xl md:text-6xl font-display font-bold mb-8 leading-tight">
                    Menjelajahi Jantung <br><span class="text-custom-accent">Kalimantan</span>
                </h2>
                <p class="text-gray-300 text-lg mb-8 leading-relaxed font-light">
                    Nikmati keindahan alam Kaltim Etam yang menakjubkan. Dari kedalaman hutan hujan yang menyimpan ribuan spesies langka hingga keindahan bawah laut Kepulauan Derawan yang mempesona.
                </p>
                
                <div class="grid grid-cols-3 gap-8 border-t border-white/10 pt-8">
                    <div>
                        <div class="text-4xl font-light text-white mb-2">10+</div>
                        <div class="text-xs tracking-widest text-custom-accent uppercase">Kabupaten</div>
                    </div>
                    <div>
                        <div class="text-4xl font-light text-white mb-2">100%</div>
                        <div class="text-xs tracking-widest text-custom-accent uppercase">Wisata Asli</div>
                    </div>
                    <!-- <div>
                        <div class="text-4xl font-light text-white mb-2">24h</div>
                        <div class="text-xs tracking-widest text-custom-accent uppercase">Bantuan</div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-24 bg-white" id="galeri">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-end mb-16">
            <h2 class="text-4xl font-display font-bold text-custom-primary"><?= Language::get('home.gallery_title', 'Galeri Visual') ?></h2>
            <a href="#" class="text-custom-secondary font-medium hover:text-custom-primary transition flex items-center gap-2">
                <?= Language::get('home.gallery_link', 'Lihat Semua') ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative rounded-3xl overflow-hidden group h-[280px]" data-aos="fade-up">
                <img src="https://i.ibb.co.com/rLJ5BgL/danau-labuan-cermin.jpg" class="w-full h-full object-cover transition duration-700 transform group-hover:scale-105" alt="Labuan Cermin">
                <div class="absolute bottom-0 left-0 p-8 w-full bg-gradient-to-t from-black/80 to-transparent">
                    <p class="text-white font-bold text-xl">Danau Labuan Cermin</p>
                    <p class="text-custom-accent text-sm">Berau</p>
                </div>
            </div>
            
            <div class="flex flex-col gap-8 md:col-span-2">
                <div class="relative rounded-3xl overflow-hidden group h-[280px]" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://i.ibb.co.com/M5WMSw4c/mahakam.jpg"  class="w-full h-full object-cover transition duration-700 transform group-hover:scale-105" alt="Sungai Mahakam">
                     <div class="absolute bottom-0 left-0 p-8 w-full bg-gradient-to-t from-black/80 to-transparent">
                        <p class="text-white font-bold text-xl">Sungai Mahakam</p>
                        <p class="text-custom-accent text-sm">Samarinda</p>
                    </div>
                </div>
                <div class="flex gap-8">
                     <div class="relative rounded-3xl overflow-hidden group w-1/2 h-[280px]" data-aos="fade-up" data-aos-delay="200">
                        <img src="https://i.ibb.co.com/vFbjZwS/Foto-utama-Orangutan.jpg" class="w-full h-full object-cover transition duration-700 transform group-hover:scale-105" alt="Orangutan">
                         <div class="absolute bottom-0 left-0 p-6 w-full bg-gradient-to-t from-black/80 to-transparent">
                            <p class="text-white font-bold text-lg">Orangutan</p>
                        </div>
                    </div>
                     <div class="relative rounded-3xl overflow-hidden group w-1/2 h-[280px]" data-aos="fade-up" data-aos-delay="300">
                        <img src="https://i.ibb.co.com/7d6WRQqP/1-IMG-2794-Kawasan-wisata-alam-Bukit-Bangkirai-terletak-kurang-lebih-58-kilometer-dari-Kota-Balikpa.jpg" class="w-full h-full object-cover transition duration-700 transform group-hover:scale-105" alt="Bukit Bangkirai">
                         <div class="absolute bottom-0 left-0 p-6 w-full bg-gradient-to-t from-black/80 to-transparent">
                            <p class="text-white font-bold text-lg">Bukit Bangkirai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer Spacer & Script for Carousel -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next-custom",
                prevEl: ".swiper-button-prev-custom",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            }
        });

        // Filter Functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const destinasiCards = document.querySelectorAll('.swiper-slide');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter').toLowerCase();
                
                // Update active button
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-custom-secondary', 'text-white', 'shadow-md', 'font-bold');
                    btn.classList.add('text-gray-500', 'hover:text-custom-secondary', 'hover:bg-gray-50', 'font-medium');
                });
                
                this.classList.add('active', 'bg-custom-secondary', 'text-white', 'shadow-md', 'font-bold');
                this.classList.remove('text-gray-500', 'hover:text-custom-secondary', 'hover:bg-gray-50', 'font-medium');

                // Filter cards
                destinasiCards.forEach(card => {
                    const cardCategory = card.querySelector('.category-badge') ? 
                                       card.querySelector('.category-badge').textContent.toLowerCase().trim() : '';
                    
                    if (filterValue === 'all' || cardCategory.includes(filterValue)) {
                        card.style.display = 'block';
                        // Trigger animation
                        card.style.animation = 'fadeInUp 0.5s ease-out';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update swiper after filtering
                setTimeout(() => {
                    swiper.update();
                }, 100);
            });
        });

        // Add fadeInUp animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    });

    // ==========================================
    // MULTI-CITY WEATHER WIDGET FUNCTIONALITY
    // ==========================================
    
    // Weather API Configuration
    const WEATHER_API_KEY = '<?= WEATHER_API_KEY ?>'; // From .env via config.php
    const CACHE_DURATION = 30 * 60 * 1000; // 30 minutes in milliseconds
    
    // Kalimantan Timur Cities Configuration
    const KALTIM_CITIES = {
        samarinda: {
            name: 'Samarinda',
            lat: -0.5022,
            lon: 117.1536,
            color: 'emerald'
        },
        balikpapan: {
            name: 'Balikpapan',
            lat: -1.2379,
            lon: 116.8529,
            color: 'cyan'
        },
        bontang: {
            name: 'Bontang',
            lat: 0.1333,
            lon: 117.5000,
            color: 'purple'
        },
        berau: {
            name: 'Berau',
            lat: 2.1500,
            lon: 117.4667,
            color: 'teal'
        }
    };
    
    // Modern Weather Icon Mapping (Subtle/Monochrome)
    const weatherIcons = {
        'clear sky': { icon: 'fa-sun', color: 'text-gray-700' },
        'few clouds': { icon: 'fa-cloud-sun', color: 'text-gray-600' },
        'scattered clouds': { icon: 'fa-cloud', color: 'text-gray-500' },
        'broken clouds': { icon: 'fa-cloud', color: 'text-gray-600' },
        'overcast clouds': { icon: 'fa-cloud', color: 'text-gray-600' },
        'shower rain': { icon: 'fa-cloud-showers-heavy', color: 'text-gray-600' },
        'rain': { icon: 'fa-cloud-rain', color: 'text-gray-600' },
        'light rain': { icon: 'fa-cloud-sun-rain', color: 'text-gray-600' },
        'moderate rain': { icon: 'fa-cloud-rain', color: 'text-gray-700' },
        'heavy rain': { icon: 'fa-cloud-showers-heavy', color: 'text-gray-700' },
        'thunderstorm': { icon: 'fa-bolt', color: 'text-gray-700' },
        'snow': { icon: 'fa-snowflake', color: 'text-gray-600' },
        'mist': { icon: 'fa-smog', color: 'text-gray-500' },
        'fog': { icon: 'fa-smog', color: 'text-gray-500' },
        'haze': { icon: 'fa-smog', color: 'text-gray-500' },
        'smoke': { icon: 'fa-smog', color: 'text-gray-600' },
        'default': { icon: 'fa-cloud-sun', color: 'text-gray-600' }
    };
    
    function getWeatherIcon(description) {
        const desc = description.toLowerCase();
        for (let key in weatherIcons) {
            if (desc.includes(key)) {
                return weatherIcons[key];
            }
        }
        return weatherIcons['default'];
    }
    
    // Fetch weather for specific city
    function fetchCityWeather(cityKey, cityData) {
        // Check if API key is configured
        if (!WEATHER_API_KEY || WEATHER_API_KEY === 'your_openweathermap_api_key_here') {
            showCityError(cityKey, 'API key belum dikonfigurasi');
            return;
        }
        
        // Check cache first
        const cacheKey = 'weather_' + cityKey;
        const cacheTimeKey = 'weatherTime_' + cityKey;
        const cachedData = localStorage.getItem(cacheKey);
        const cachedTime = localStorage.getItem(cacheTimeKey);
        
        if (cachedData && cachedTime) {
            const timeDiff = Date.now() - parseInt(cachedTime);
            if (timeDiff < CACHE_DURATION) {
                // Use cached data
                displayCityWeather(cityKey, JSON.parse(cachedData));
                return;
            }
        }
        
        // Fetch from API
        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${cityData.lat}&lon=${cityData.lon}&appid=${WEATHER_API_KEY}&units=metric&lang=id`;
        
        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('HTTP error! status: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                // Cache the data
                localStorage.setItem(cacheKey, JSON.stringify(data));
                localStorage.setItem(cacheTimeKey, Date.now().toString());
                
                // Display weather
                displayCityWeather(cityKey, data);
            })
            .catch(error => {
                console.error('Weather fetch error for ' + cityKey + ':', error);
                showCityError(cityKey, 'Gagal memuat data');
            });
    }
    
    function displayCityWeather(cityKey, data) {
        try {
            // Main weather info
            const temp = Math.round(data.main.temp);
            const feelsLike = Math.round(data.main.feels_like);
            const description = data.weather[0].description;
            const iconData = getWeatherIcon(description);
            
            // Update UI Elements
            const tempEl = document.getElementById('weather-temp-' + cityKey);
            const descEl = document.getElementById('weather-desc-' + cityKey);
            const iconEl = document.getElementById('weather-icon-' + cityKey);
            const humidityEl = document.getElementById('weather-humidity-' + cityKey);
            const windEl = document.getElementById('weather-wind-' + cityKey);
            
            if (tempEl) tempEl.textContent = temp + '°C';
            if (descEl) descEl.textContent = description;
            if (iconEl) {
                iconEl.innerHTML = `<i class="fas ${iconData.icon} ${iconData.color} text-4xl"></i>`;
            }
            if (humidityEl) humidityEl.textContent = data.main.humidity + '%';
            if (windEl) windEl.textContent = (data.wind.speed * 3.6).toFixed(1) + ' km/h';
            
        } catch (error) {
            console.error('Display weather error for ' + cityKey + ':', error);
            showCityError(cityKey, 'Error menampilkan data');
        }
    }
    
    function showCityError(cityKey, message) {
        const tempEl = document.getElementById('weather-temp-' + cityKey);
        const descEl = document.getElementById('weather-desc-' + cityKey);
        const iconEl = document.getElementById('weather-icon-' + cityKey);
        
        if (tempEl) tempEl.textContent = '--°';
        if (descEl) descEl.textContent = message;
        if (iconEl) {
            iconEl.innerHTML = '<i class="fas fa-exclamation-circle text-3xl text-gray-400"></i>';
        }
    }
    
    // Initialize all cities weather
    function initializeWeather() {
        // Update last update time
        const now = new Date();
        const timeEl = document.getElementById('last-update-time');
        if (timeEl) {
            timeEl.textContent = now.toLocaleTimeString('id-ID', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
        }
        
        // Fetch weather for all cities
        Object.keys(KALTIM_CITIES).forEach(cityKey => {
            fetchCityWeather(cityKey, KALTIM_CITIES[cityKey]);
        });
    }
    
    // Initialize weather on page load
    initializeWeather();
    
    // Auto-refresh every 30 minutes
    setInterval(initializeWeather, CACHE_DURATION);
</script>

<?php include VIEW_PATH . '/layouts/footer.php'; ?>
