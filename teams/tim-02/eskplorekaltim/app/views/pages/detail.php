<?php
$pageTitle = $destinasi['nama'];
$pageDescription = isset($destinasi['deskripsi']) ? substr(strip_tags($destinasi['deskripsi']), 0, 160) : '';
include VIEW_PATH . '/layouts/header.php';
?>

<!-- Hero Banner & Breadcrumb -->
<div class="relative pt-32 pb-12 bg-custom-light">
    <div class="absolute top-0 right-0 w-96 h-96 bg-custom-accent/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    <div class="container mx-auto px-6 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?= BASE_URL ?>" class="inline-flex items-center text-gray-500 hover:text-custom-secondary transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        <?= Language::get('detail.breadcrumb_home', 'Beranda') ?>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-300 mx-1"></i>
                        <a href="<?= BASE_URL ?>destinasi" class="text-gray-500 hover:text-custom-secondary transition-colors"><?= Language::get('detail.breadcrumb_dest', 'Destinasi') ?></a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-300 mx-1"></i>
                        <span class="text-custom-secondary font-medium"><?= htmlspecialchars($destinasi['nama']) ?></span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Title Header -->
        <div class="max-w-4xl" data-aos="fade-up">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="px-4 py-1.5 rounded-full bg-custom-secondary/10 text-custom-secondary text-sm font-bold tracking-wide uppercase">
                    <i class="<?= $destinasi['kategori_icon'] ?> mr-1.5"></i>
                    <?= $destinasi['kategori_nama'] ?>
                </span>
                <div class="flex items-center text-yellow-500 text-sm font-bold bg-white px-3 py-1.5 rounded-full shadow-sm border border-gray-100">
                    <i class="fas fa-star mr-1.5"></i>
                    <?= number_format($destinasi['rating'], 1) ?>
                </div>
            </div>
            <h1 class="text-4xl md:text-6xl font-display font-bold text-custom-primary mb-4 leading-tight">
                <?= htmlspecialchars($destinasi['nama']) ?>
            </h1>
            <p class="flex items-center text-gray-500 text-lg">
                <i class="fas fa-map-marker-alt text-custom-accent mr-2.5"></i>
                <?= htmlspecialchars($destinasi['alamat'] ?: $destinasi['kabupaten_nama']) ?>
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="pb-24 bg-custom-light">
    <div class="container mx-auto px-6">
        <!-- Hero Image -->
        <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl mb-12 h-[500px]" data-aos="fade-up" data-aos-delay="100">
            <img 
                src="<?= BASE_URL ?>public/images/destinations/<?= $destinasi['foto_utama'] ?>" 
                alt="<?= htmlspecialchars($destinasi['nama']) ?>"
                class="w-full h-full object-cover hover:scale-105 transition duration-1000"
                onerror="this.src='https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1200&h=600&fit=crop'"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column: Content -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Description -->
                <div class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-100" data-aos="fade-up">
                    <h2 class="text-3xl font-display font-bold text-custom-primary mb-6"><?= Language::get('detail.about_title', 'Tentang Destinasi') ?></h2>
                    <div class="prose prose-lg prose-headings:font-display prose-headings:text-custom-primary prose-green max-w-none text-gray-600 leading-relaxed font-sans">
                        <p><?= nl2br(htmlspecialchars($destinasi['deskripsi'])) ?></p>
                        
                        <?php if ($destinasi['sejarah']): ?>
                        <h3 class="mt-8 text-2xl font-bold"><?= Language::get('detail.history_title', 'Sejarah & Latar Belakang') ?></h3>
                        <p><?= nl2br(htmlspecialchars($destinasi['sejarah'])) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Facilities Grid -->
                <?php if (!empty($fasilitas)): ?>
                <div class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-100" data-aos="fade-up">
                    <h2 class="text-2xl font-display font-bold text-custom-primary mb-8"><?= Language::get('detail.facilities_title', 'Fasilitas Tersedia') ?></h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <?php foreach ($fasilitas as $fas): ?>
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50 hover:bg-custom-light transition-colors border border-gray-100 group">
                            <div class="w-12 h-12 rounded-full bg-white text-custom-secondary flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <i class="<?= $fas['icon'] ?> text-lg"></i>
                            </div>
                            <span class="font-medium text-gray-700"><?= htmlspecialchars($fas['nama']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Tips & Guide -->
                <?php if (!empty($tips)): ?>
                <div data-aos="fade-up">
                    <h2 class="text-2xl font-display font-bold text-custom-primary mb-8"><?= Language::get('detail.tips_title', 'Panduan & Tips Penting') ?></h2>
                    <div class="grid gap-6">
                        <?php foreach ($tips as $tip): ?>
                        <div class="flex items-start gap-5 p-6 rounded-3xl border transition-all duration-300 <?= $tip['tipe'] == 'larangan' ? 'bg-red-50/50 border-red-100 hover:shadow-red-100/50 hover:shadow-lg' : 'bg-custom-accent/10 border-custom-accent/20 hover:shadow-custom-accent/20 hover:shadow-lg' ?>">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center <?= $tip['tipe'] == 'larangan' ? 'bg-red-100 text-red-600' : 'bg-custom-accent/20 text-custom-secondary' ?>">
                                <i class="fas <?= $tip['tipe'] == 'larangan' ? 'fa-exclamation-triangle' : 'fa-lightbulb' ?>"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-custom-primary mb-2 text-lg"><?= htmlspecialchars($tip['judul']) ?></h3>
                                <p class="text-gray-600 leading-relaxed"><?= htmlspecialchars($tip['konten']) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Interactive Map Section -->
                <?php if ($destinasi['latitude'] && $destinasi['longitude']): ?>
                <div data-aos="fade-up">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-display font-bold text-custom-primary"><?= Language::get('detail.map_title', 'Lokasi di Peta') ?></h2>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt text-custom-secondary"></i>
                            <span><?= number_format($destinasi['latitude'], 4) ?>, <?= number_format($destinasi['longitude'], 4) ?></span>
                        </div>
                    </div>
                    
                    <!-- Map Container -->
                    <div class="bg-white rounded-3xl p-6 shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                        <div id="map-container" class="w-full h-[500px] rounded-2xl overflow-hidden shadow-inner mb-4"></div>
                        
                        <!-- Navigation Buttons -->
                        <div class="grid grid-cols-2 gap-4">
                            <a href="https://www.google.com/maps?q=<?= $destinasi['latitude'] ?>,<?= $destinasi['longitude'] ?>" 
                               target="_blank"
                               class="py-4 rounded-xl bg-blue-500 text-white font-bold hover:bg-blue-600 transition-colors flex items-center justify-center gap-3 shadow-lg hover:shadow-xl">
                                <i class="fab fa-google text-xl"></i>
                                <?= Language::get('detail.open_gmaps', 'Buka di Google Maps') ?>
                            </a>
                            <a href="https://waze.com/ul?ll=<?= $destinasi['latitude'] ?>,<?= $destinasi['longitude'] ?>&navigate=yes" 
                               target="_blank"
                               class="py-4 rounded-xl bg-cyan-500 text-white font-bold hover:bg-cyan-600 transition-colors flex items-center justify-center gap-3 shadow-lg hover:shadow-xl">
                                <i class="fab fa-waze text-xl"></i>
                                <?= Language::get('detail.open_waze', 'Buka di Waze') ?>
                            </a>
                        </div>
                    </div>

                    <!-- Map JavaScript -->
                    <script>
                        // Initialize Leaflet Map
                        document.addEventListener('DOMContentLoaded', function() {
                            const lat = <?= $destinasi['latitude'] ?>;
                            const lng = <?= $destinasi['longitude'] ?>;
                            const destinasiName = '<?= addslashes($destinasi['nama']) ?>';

                            // Create map
                            const map = L.map('map-container', {
                                center: [lat, lng],
                                zoom: 13,
                                scrollWheelZoom: false,
                                zoomControl: true
                            });

                            // Add tile layer (OpenStreetMap)
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                                maxZoom: 18
                            }).addTo(map);

                            // Custom marker icon
                            const customIcon = L.icon({
                                iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-icon.png',
                                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [1, -34],
                                shadowSize: [41, 41]
                            });

                            // Add marker
                            const marker = L.marker([lat, lng], { icon: customIcon }).addTo(map);
                            
                            // Add popup
                            marker.bindPopup('<div class="text-center p-2"><strong class="text-custom-primary">' + destinasiName + '</strong><br><span class="text-sm text-gray-600">Klik untuk navigasi</span></div>');
                            
                            // Open popup on load
                            marker.openPopup();

                            // Enable scroll zoom when clicked
                            map.on('click', function() {
                                map.scrollWheelZoom.enable();
                            });
                        });
                    </script>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-28 space-y-8">
                    <!-- Info Card -->
                    <div class="bg-white rounded-3xl p-8 shadow-xl shadow-gray-200/50 border border-gray-100 relative overflow-hidden" data-aos="fade-left">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-custom-secondary/5 rounded-bl-full -mr-8 -mt-8"></div>
                        
                        <h3 class="text-xl font-display font-bold text-custom-primary mb-6 relative z-10">Informasi Kunjungan</h3>
                        
                        <div class="space-y-6 relative z-10">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-money-bill-wave text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Harga Tiket</p>
                                    <p class="font-bold text-custom-primary text-lg"><?= $destinasi['harga_tiket'] ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-clock text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Jam Operasional</p>
                                    <p class="font-bold text-custom-primary text-lg"><?= $destinasi['jam_operasional'] ?></p>
                                </div>
                            </div>

                            <hr class="border-gray-100">

                            <?php if ($destinasi['latitude'] && $destinasi['longitude']): ?>
                            <a href="https://www.google.com/maps?q=<?= $destinasi['latitude'] ?>,<?= $destinasi['longitude'] ?>" 
                               target="_blank"
                               class="w-full py-4 rounded-xl bg-custom-secondary text-white font-bold hover:bg-custom-primary transition-all duration-300 shadow-lg shadow-custom-secondary/30 hover:shadow-custom-primary/30 flex items-center justify-center gap-2 group">
                                <i class="fas fa-map-marked-alt group-hover:scale-110 transition-transform"></i>
                                Buka Google Maps
                            </a>
                            <?php endif; ?>
                            
                            <button onclick="shareDestinasi()" class="w-full py-3 rounded-xl border-2 border-custom-secondary text-custom-secondary font-bold hover:bg-custom-secondary hover:text-white transition-all duration-300 flex items-center justify-center gap-2">
                                <i class="fas fa-share-alt"></i>
                                Bagikan
                            </button>
                        </div>
                    </div>
                    
                    <!-- Help Card -->
                    <div class="bg-custom-primary rounded-3xl p-8 text-white relative overflow-hidden" data-aos="fade-left" data-aos-delay="100">
                        <div class="absolute inset-0 bg-custom-accent/10"></div>
                        <div class="relative z-10">
                            <i class="fas fa-headset text-4xl text-custom-accent mb-4"></i>
                            <h3 class="text-xl font-bold mb-2">Butuh Bantuan?</h3>
                            <p class="text-gray-300 text-sm mb-4">Hubungi pusat informasi turis lokal untuk bantuan darurat.</p>
                            <a href="#" class="text-custom-accent font-bold hover:text-white transition-colors flex items-center gap-2">
                                Hubungi Kami <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Destinations -->
<?php if (!empty($relatedDestinasi)): ?>
<section class="py-20 bg-white border-t border-gray-100">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div>
                <span class="text-custom-secondary font-bold text-sm tracking-widest uppercase mb-2 block">Eksplorasi Lainnya</span>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-custom-primary">Destinasi Serupa</h2>
            </div>
            <a href="<?= BASE_URL ?>destinasi?kategori=<?= $destinasi['kategori_id'] ?>" class="group flex items-center gap-2 text-custom-secondary font-bold hover:text-custom-primary transition-colors">
                Lihat Semua 
                <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($relatedDestinasi as $rel): ?>
                <?php if ($rel['id'] == $destinasi['id']) continue; ?>
                <a href="<?= BASE_URL ?>destinasi/<?= $rel['id'] ?>" class="group">
                    <div class="bg-white rounded-[2rem] overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 h-96 relative">
                        <!-- Image -->
                        <img 
                            src="<?= BASE_URL ?>public/images/destinations/<?= $rel['foto_utama'] ?>" 
                            alt="<?= htmlspecialchars($rel['nama']) ?>"
                            class="w-full h-full object-cover transition duration-700 transform group-hover:scale-110"
                            onerror="this.src='https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=400&h=600&fit=crop'"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 p-6 w-full text-white">
                            <span class="inline-block px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-bold mb-3 border border-white/30">
                                <?= $rel['kategori_nama'] ?>
                            </span>
                            <h3 class="text-xl font-display font-bold mb-1 leading-tight group-hover:text-custom-accent transition-colors">
                                <?= htmlspecialchars($rel['nama']) ?>
                            </h3>
                            <div class="flex items-center text-gray-300 text-sm">
                                <i class="fas fa-map-pin mr-2 text-custom-accent"></i>
                                <?= htmlspecialchars($rel['kabupaten_nama']) ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<script>
    function shareDestinasi() {
        if (navigator.share) {
            navigator.share({
                title: '<?= htmlspecialchars($destinasi['nama']) ?> - Explore Kaltim',
                text: 'Cek destinasi keren ini di Kalimantan Timur!',
                url: window.location.href,
            })
            .then(() => console.log('Successful share'))
            .catch((error) => console.log('Error sharing', error));
        } else {
            // Fallback
            alert('Link telah disalin ke clipboard!');
            navigator.clipboard.writeText(window.location.href);
        }
    }
</script>

<?php include VIEW_PATH . '/layouts/footer.php'; ?>
