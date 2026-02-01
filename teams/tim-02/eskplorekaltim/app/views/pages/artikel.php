<?php
$pageTitle = "Artikel & Tips";
include VIEW_PATH . '/layouts/header.php';
?>

<!-- Page Header -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-display font-bold mb-4">Artikel & Tips Perjalanan</h1>
        <p class="text-xl">Panduan lengkap untuk pengalaman wisata yang lebih baik</p>
    </div>
</section>

<!-- Articles Grid -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <?php if (empty($artikel)): ?>
            <div class="text-center py-16">
                <i class="fas fa-newspaper text-6xl text-gray-400 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">Belum Ada Artikel</h3>
                <p class="text-gray-500">Artikel akan segera tersedia</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($artikel as $item): ?>
                <article class="card">
                    <div class="relative h-56 overflow-hidden">
                        <img 
                            src="<?= BASE_URL ?>public/images/articles/<?= $item['foto_thumbnail'] ?>" 
                            alt="<?= htmlspecialchars($item['judul']) ?>"
                            class="w-full h-full object-cover"
                            onerror="this.src='https://via.placeholder.com/400x250/3b82f6/ffffff?text=Artikel'"
                        >
                        <div class="absolute top-4 left-4">
                            <span class="badge-blue"><?= $item['kategori_artikel'] ?></span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-blue-600 transition">
                            <?= htmlspecialchars($item['judul']) ?>
                        </h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            <?= htmlspecialchars($item['excerpt']) ?>
                        </p>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">
                                <i class="far fa-calendar mr-1"></i>
                                <?= date('d M Y', strtotime($item['published_at'])) ?>
                            </span>
                            <span class="text-gray-500">
                                <i class="far fa-eye mr-1"></i>
                                <?= $item['view_count'] ?> views
                            </span>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include VIEW_PATH . '/layouts/footer.php'; ?>
