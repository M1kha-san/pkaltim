<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
    <!-- Background with Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-custom-primary via-custom-secondary to-custom-accent">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?q=80&w=2000'); background-size: cover; background-position: center; opacity: 0.3;"></div>
    </div>
    
    <!-- Animated Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-1/2 -right-1/2 w-full h-full rounded-full bg-custom-accent/10 blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-1/2 -left-1/2 w-full h-full rounded-full bg-custom-secondary/10 blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>
    
    <!-- Content -->
    <div class="container mx-auto px-6 relative z-10 text-center" data-aos="fade-up">
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-display font-bold text-white mb-6 leading-tight">
            Galeri <span class="text-custom-accent">Wisata</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto mb-8">
            Jelajahi keindahan destinasi wisata alam Kalimantan Timur melalui koleksi foto-foto menakjubkan
        </p>
        <div class="flex items-center justify-center gap-4 text-white/80">
            <i class="fas fa-camera text-custom-accent"></i>
            <span class="text-sm uppercase tracking-wider">Photo Collection</span>
        </div>
    </div>
</section>

<!-- Gallery Content -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <?php if (empty($galeriData)): ?>
        <!-- Empty State -->
        <div class="text-center py-20" data-aos="fade-up">
            <div class="w-32 h-32 mx-auto mb-6 rounded-full bg-gray-200 flex items-center justify-center">
                <i class="fas fa-images text-5xl text-gray-400"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-600 mb-2">Belum Ada Foto</h3>
            <p class="text-gray-500">Galeri foto akan segera ditambahkan</p>
        </div>
        <?php else: ?>
        <!-- Gallery Grid by Destination -->
        <?php foreach ($galeriData as $index => $item): ?>
        <div class="mb-20" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
            <!-- Destination Header -->
            <div class="flex items-center justify-between mb-8 pb-4 border-b-2 border-custom-secondary/20">
                <div>
                    <h2 class="text-3xl font-display font-bold text-custom-primary mb-2">
                        <?= htmlspecialchars($item['destinasi']['nama'] ?? 'Destinasi') ?>
                    </h2>
                    <div class="flex items-center gap-4 text-gray-600">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-custom-secondary"></i>
                            <?= htmlspecialchars($item['destinasi']['kabupaten_nama'] ?? 'Kalimantan Timur') ?>
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fas fa-images text-custom-accent"></i>
                            <?= count($item['photos']) ?> Foto
                        </span>
                    </div>
                </div>
                <a href="<?= BASE_URL ?>destinasi/<?= $item['destinasi']['id'] ?>" 
                   class="px-6 py-3 rounded-xl bg-custom-secondary text-white font-bold hover:bg-custom-primary transition-all duration-300 shadow-lg shadow-custom-secondary/30 hover:shadow-custom-primary/30 flex items-center gap-2">
                    <i class="fas fa-info-circle"></i>
                    Detail Destinasi
                </a>
            </div>
            
            <!-- Photo Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($item['photos'] as $photoIndex => $foto): ?>
                <a href="<?= BASE_URL ?>public/images/destinations/<?= htmlspecialchars($foto['nama_file'] ?? '') ?>" 
                   class="glightbox group relative overflow-hidden rounded-2xl aspect-square cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-300 <?= $photoIndex === 0 ? 'md:col-span-2 md:row-span-2' : '' ?>"
                   data-gallery="gallery-<?= $item['destinasi']['id'] ?>"
                   data-title="<?= htmlspecialchars(($foto['caption'] ?? '') ?: ($item['destinasi']['nama'] ?? 'Photo')) ?>"
                   data-description="<?= htmlspecialchars($item['destinasi']['nama'] ?? 'Destinasi') ?>">
                    <img 
                        src="<?= BASE_URL ?>public/images/destinations/<?= htmlspecialchars($foto['nama_file'] ?? '') ?>" 
                        alt="<?= htmlspecialchars(($foto['caption'] ?? '') ?: ($item['destinasi']['nama'] ?? 'Photo')) ?>"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        onerror="this.src='https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=600&h=600&fit=crop'"
                    >
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Caption -->
                    <?php if (!empty($foto['caption'])): ?>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <p class="text-sm font-medium leading-tight"><?= htmlspecialchars($foto['caption'] ?? '') ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Zoom Icon -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="w-16 h-16 rounded-full bg-white/95 flex items-center justify-center shadow-xl">
                            <i class="fas fa-search-plus text-2xl text-custom-secondary"></i>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-custom-primary relative overflow-hidden">
    <div class="absolute inset-0 bg-custom-accent/5"></div>
    <div class="container mx-auto px-6 relative z-10 text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-6">
            Tertarik Mengunjungi?
        </h2>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-8">
            Jelajahi destinasi wisata alam lainnya di Kalimantan Timur
        </p>
        <a href="<?= BASE_URL ?>destinasi" 
           class="inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-custom-accent text-custom-primary font-bold text-lg hover:bg-white transition-all duration-300 shadow-2xl shadow-custom-accent/30 hover:shadow-white/30">
            <i class="fas fa-compass"></i>
            Lihat Semua Destinasi
        </a>
    </div>
</section>
