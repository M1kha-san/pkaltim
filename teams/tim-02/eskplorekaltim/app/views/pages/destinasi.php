<?php
$pageTitle = "Destinasi Wisata";
include VIEW_PATH . '/layouts/header.php';
?>

<!-- Page Header -->
<section class="relative text-white py-24 overflow-hidden">
    <!-- Background Image: Pulau Beras Basah -->
    <div class="absolute inset-0 z-0">
        <img src="<?= BASE_URL ?>public/images/destinations/hutan-kaltim.jpeg" 
             alt="Pulau Beras Basah - Berau" 
             class="w-full h-full object-cover"
             data-aos="zoom-out" data-aos-duration="2000">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-custom-primary/70 via-custom-primary/50 to-custom-primary/70"></div>
    </div>
    
    <!-- Content -->
    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl font-display font-bold mb-4 drop-shadow-2xl"><?= Language::get('dest.page_title', 'Destinasi Wisata Alam') ?></h1>
        <p class="text-xl text-gray-100 drop-shadow-lg"><?= Language::get('dest.page_subtitle', 'Temukan destinasi wisata alam terbaik di Kalimantan Timur') ?></p>
    </div>
</section>

<!-- Filters -->
<section class="bg-white shadow-md py-6">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <!-- Search -->
            <div class="w-full md:w-1/3">
                <form action="<?= BASE_URL ?>destinasi" method="GET" class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="<?= Language::get('dest.search_placeholder', 'Cari destinasi...') ?>" 
                        value="<?= isset($searchKeyword) ? htmlspecialchars($searchKeyword) : '' ?>"
                        class="input-field pr-12"
                    >
                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-custom-secondary">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                </form>
            </div>
            
            <!-- Category Filter -->
            <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0">   
                <a href="<?= BASE_URL ?>destinasi" 
                   class="badge <?= !isset($currentKategori) ? 'bg-custom-secondary text-white' : 'bg-gray-200 text-gray-700' ?> whitespace-nowrap">
                    <?= Language::get('dest.filter_all', 'Semua') ?>
                </a>
                <?php foreach ($kategoris as $kat): ?>
                <a href="<?= BASE_URL ?>destinasi?kategori=<?= $kat['id'] ?>" 
                   class="badge <?= isset($currentKategori) && $currentKategori == $kat['id'] ? 'bg-custom-secondary text-white' : 'bg-gray-200 text-gray-700' ?> whitespace-nowrap">
                    <?= htmlspecialchars($kat['nama']) ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Destinations Grid -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <?php if (empty($destinasis)): ?>
            <div class="text-center py-16">
                <i class="fas fa-search text-6xl text-gray-400 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-2"><?= Language::get('dest.not_found', 'Destinasi Tidak Ditemukan') ?></h3>
                <p class="text-gray-500"><?= Language::get('dest.not_found_desc', 'Coba kata kunci atau filter lain') ?></p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($destinasis as $dest): ?>
                <a href="<?= BASE_URL ?>destinasi/<?= $dest['id'] ?>" class="card group cursor-pointer transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="relative h-48 overflow-hidden img-hover-zoom">
                        <img 
                            src="<?= BASE_URL ?>public/images/destinations/<?= $dest['foto_utama'] ?>" 
                            alt="<?= htmlspecialchars($dest['nama']) ?>"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            onerror="this.src='https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=300&h=200&fit=crop'"
                        >
                        <div class="absolute top-3 right-3">
                            <span class="badge-green text-xs">
                                <i class="fas fa-star text-yellow-500 mr-1"></i>
                                <?= number_format($dest['rating'], 1) ?>
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-1 group-hover:text-custom-secondary transition-colors">
                            <?= htmlspecialchars($dest['nama']) ?>
                        </h3>
                        <p class="text-sm text-gray-600 mb-3 flex items-center">
                            <i class="fas fa-map-marker-alt text-red-500 mr-1 text-xs"></i>
                            <?= htmlspecialchars($dest['kabupaten_nama']) ?>
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-custom-secondary font-semibold text-sm">
                                <?= $dest['harga_tiket'] ?>
                            </span>
                            <span class="text-custom-secondary group-hover:text-custom-primary font-semibold text-sm inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                                <?= Language::get('dest.detail_btn', 'Detail') ?> <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include VIEW_PATH . '/layouts/footer.php'; ?>
