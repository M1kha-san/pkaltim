<?php
/**
 * Admin Dashboard
 */
include VIEW_PATH . '/admin/layouts/header.php';
include VIEW_PATH . '/admin/layouts/sidebar.php';
?>

<!-- Main Content -->
<div class="main-content">
    <!-- Top Bar -->
    <header class="bg-white border-b border-gray-100 px-6 py-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                <p class="text-gray-500 text-sm mt-1">
                    Selamat datang kembali, <?= htmlspecialchars($user['nama_lengkap']) ?>! 
                    <span class="text-teal-600">(<?= $user['role'] === 'admin' ? 'Administrator' : 'Penulis' ?>)</span>
                </p>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-500 text-sm">
                    <i class="far fa-calendar-alt mr-1"></i>
                    <?= date('l, d F Y') ?>
                </span>
            </div>
        </div>
    </header>
    
    <!-- Content -->
    <main class="p-6">
        <?php if ($flash): ?>
            <div class="alert alert-<?= $flash['type'] ?>">
                <i class="fas fa-<?= $flash['type'] === 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i>
                <span><?= $flash['message'] ?></span>
            </div>
        <?php endif; ?>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Destinasi -->
            <div class="bg-white rounded-xl p-6 card-hover border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Destinasi</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?= $stats['destinasi'] ?></p>
                        <p class="text-green-500 text-sm mt-2">
                            <i class="fas fa-map-marked-alt mr-1"></i> Wisata aktif
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center">
                        <i class="fas fa-map-marked-alt text-2xl text-blue-500"></i>
                    </div>
                </div>
            </div>
            
            <!-- Total Kategori -->
            <div class="bg-white rounded-xl p-6 card-hover border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Kategori</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?= $stats['kategori'] ?></p>
                        <p class="text-purple-500 text-sm mt-2">
                            <i class="fas fa-tags mr-1"></i> Jenis wisata
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tags text-2xl text-purple-500"></i>
                    </div>
                </div>
            </div>
            
            <!-- Total Artikel - Disabled (Dalam Pengembangan) -->
            <?php /* 
            <div class="bg-white rounded-xl p-6 card-hover border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Artikel</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?= $stats['artikel'] ?></p>
                        <p class="text-orange-500 text-sm mt-2">
                            <i class="fas fa-newspaper mr-1"></i> Konten
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center">
                        <i class="fas fa-newspaper text-2xl text-orange-500"></i>
                    </div>
                </div>
            </div>
            */ ?>
            
            <!-- Total Penulis (hanya untuk admin) -->
            <?php if ($user['role'] === 'admin'): ?>
            <div class="bg-white rounded-xl p-6 card-hover border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Penulis</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?= $stats['penulis'] ?></p>
                        <p class="text-teal-500 text-sm mt-2">
                            <i class="fas fa-users mr-1"></i> <?= $stats['admin'] ?> Admin
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-teal-50 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-2xl text-teal-500"></i>
                    </div>
                </div>
            </div>
            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Destinasi Terbaru -->
            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-semibold text-gray-800">Destinasi Terbaru</h2>
                    <a href="<?= BASE_URL ?>admin/destinasi" class="text-[#1D546D] text-sm hover:underline">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="divide-y divide-gray-50">
                    <?php if (!empty($recentDestinasi)): ?>
                        <?php foreach ($recentDestinasi as $item): ?>
                            <div class="px-6 py-4 flex items-center gap-4 hover:bg-gray-50 transition">
                                <div class="w-12 h-12 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden">
                                    <?php if (!empty($item['foto_utama'])): ?>
                                        <img src="<?= BASE_URL ?>public/images/destinations/<?= $item['foto_utama'] ?>" 
                                             alt="<?= htmlspecialchars($item['nama']) ?>" 
                                             class="w-full h-full object-cover"
                                             onerror="this.src='https://via.placeholder.com/48?text=No+Image'">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-medium text-gray-800 truncate"><?= htmlspecialchars($item['nama']) ?></h3>
                                    <p class="text-gray-500 text-sm">
                                        <i class="fas fa-map-pin mr-1"></i><?= htmlspecialchars($item['kabupaten_nama'] ?? '-') ?>
                                    </p>
                                </div>
                                <span class="badge badge-info whitespace-nowrap"><?= htmlspecialchars($item['kategori_nama'] ?? '-') ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-3 opacity-50"></i>
                            <p>Belum ada destinasi</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Destinasi Terpopuler -->
            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-semibold text-gray-800">Destinasi Terpopuler</h2>
                    <span class="text-gray-400 text-sm">
                        <i class="fas fa-eye mr-1"></i> Berdasarkan views
                    </span>
                </div>
                <div class="divide-y divide-gray-50">
                    <?php if (!empty($topDestinasi)): ?>
                        <?php foreach ($topDestinasi as $index => $item): ?>
                            <div class="px-6 py-4 flex items-center gap-4 hover:bg-gray-50 transition">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#1D546D] to-[#5F9598] flex items-center justify-center text-white font-bold text-sm">
                                    <?= $index + 1 ?>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-medium text-gray-800 truncate"><?= htmlspecialchars($item['nama']) ?></h3>
                                    <div class="flex items-center gap-3 text-sm text-gray-500">
                                        <span><i class="fas fa-eye mr-1"></i><?= number_format($item['view_count']) ?></span>
                                        <span><i class="fas fa-star text-yellow-400 mr-1"></i><?= number_format($item['rating'], 1) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-chart-bar text-4xl mb-3 opacity-50"></i>
                            <p>Belum ada data</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="mt-6 bg-white rounded-xl border border-gray-100 p-6">
            <h2 class="font-semibold text-gray-800 mb-4">Aksi Cepat</h2>
            <div class="flex flex-wrap gap-3">
                <a href="<?= BASE_URL ?>admin/destinasi/create" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i> Tambah Destinasi
                </a>
                <?php /* Disabled - Dalam Pengembangan
                <a href="<?= BASE_URL ?>admin/artikel/create" class="btn btn-secondary">
                    <i class="fas fa-plus mr-2"></i> Tulis Artikel
                </a>
                */ ?>
                <a href="<?= BASE_URL ?>" target="_blank" class="btn btn-secondary">
                    <i class="fas fa-external-link-alt mr-2"></i> Lihat Website
                </a>
            </div>
        </div>
    </main>
</div>

<?php include VIEW_PATH . '/admin/layouts/footer.php'; ?>
