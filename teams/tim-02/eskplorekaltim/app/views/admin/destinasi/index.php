<?php
/**
 * Admin Destinasi Index - Daftar Semua Destinasi
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
                <h1 class="text-2xl font-bold text-gray-800">Kelola Destinasi</h1>
                <p class="text-gray-500 text-sm mt-1">Tambah, edit, dan hapus destinasi wisata</p>
            </div>
            <a href="<?= BASE_URL ?>admin/destinasi/create" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i> Tambah Destinasi
            </a>
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
        
        <!-- Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Destinasi</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($destinasis)): ?>
                        <?php foreach ($destinasis as $item): ?>
                            <tr>
                                <td>
                                    <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100">
                                        <?php if (!empty($item['foto_utama'])): ?>
                                            <img src="<?= BASE_URL ?>public/images/destinations/<?= $item['foto_utama'] ?>" 
                                                 alt="<?= htmlspecialchars($item['nama']) ?>"
                                                 class="w-full h-full object-cover"
                                                 onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center text-gray-400\'><i class=\'fas fa-image\'></i></div>'">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="max-w-xs">
                                        <h3 class="font-medium text-gray-800"><?= htmlspecialchars($item['nama']) ?></h3>
                                        <p class="text-gray-500 text-xs mt-1 truncate"><?= htmlspecialchars(substr($item['deskripsi'], 0, 80)) ?>...</p>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        <i class="<?= htmlspecialchars($item['kategori_icon'] ?? 'fa-map') ?> mr-1"></i>
                                        <?= htmlspecialchars($item['kategori_nama'] ?? '-') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-gray-600">
                                        <i class="fas fa-map-pin text-gray-400 mr-1"></i>
                                        <?= htmlspecialchars($item['kabupaten_nama'] ?? '-') ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                                        <span class="font-medium"><?= number_format($item['rating'], 1) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($item['is_featured']): ?>
                                        <span class="badge badge-success">
                                            <i class="fas fa-star mr-1"></i> Featured
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-warning">Normal</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="<?= BASE_URL ?>destinasi/<?= $item['id'] ?>" target="_blank" 
                                           class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition" title="Lihat">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        <a href="<?= BASE_URL ?>admin/destinasi/edit/<?= $item['id'] ?>" 
                                           class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-blue-200 transition" title="Edit">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <form action="<?= BASE_URL ?>admin/destinasi/delete/<?= $item['id'] ?>" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?');" class="inline">
                                            <input type="hidden" name="csrf_token" value="<?= Auth::generateCsrfToken() ?>">
                                            <button type="submit" 
                                                    class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center text-red-600 hover:bg-red-200 transition" title="Hapus">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-12">
                                <div class="text-gray-400">
                                    <i class="fas fa-inbox text-5xl mb-4"></i>
                                    <p class="text-lg">Belum ada destinasi</p>
                                    <p class="text-sm mt-2">Mulai dengan menambahkan destinasi baru</p>
                                    <a href="<?= BASE_URL ?>admin/destinasi/create" class="btn btn-primary mt-4">
                                        <i class="fas fa-plus mr-2"></i> Tambah Destinasi
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Info -->
        <?php if (!empty($destinasis)): ?>
            <div class="mt-4 text-sm text-gray-500">
                Menampilkan <?= count($destinasis) ?> destinasi
            </div>
        <?php endif; ?>
    </main>
</div>

<?php include VIEW_PATH . '/admin/layouts/footer.php'; ?>
