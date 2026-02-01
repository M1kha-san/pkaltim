<?php
/**
 * Admin Kategori List
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
                <h1 class="text-2xl font-bold text-gray-800">Kelola Kategori</h1>
                <p class="text-gray-500 text-sm mt-1">Daftar kategori wisata</p>
            </div>
        </div>
    </header>
    
    <!-- Content -->
    <main class="p-6">
        <?php if (isset($flash)): ?>
            <div class="mb-6 p-4 rounded-lg <?= $flash['type'] === 'success' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200' ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>
        
        <!-- Kategori Table -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Icon</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah Destinasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (empty($kategoris)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-2"></i>
                                    <p>Belum ada kategori</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($kategoris as $index => $kategori): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900"><?= $index + 1 ?></td>
                                    <td class="px-6 py-4">
                                        <i class="<?= htmlspecialchars($kategori['icon'] ?? 'fas fa-map-marker-alt') ?> text-2xl text-teal-600"></i>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($kategori['nama'] ?? '') ?></div>
                                        <div class="text-xs text-gray-500"><?= htmlspecialchars($kategori['deskripsi'] ?? '') ?></div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <code class="bg-gray-100 px-2 py-1 rounded text-xs"><?= htmlspecialchars($kategori['slug'] ?? '') ?></code>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-teal-100 text-teal-800">
                                            <?= $kategori['jumlah_destinasi'] ?? 0 ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-blue-800">
                <i class="fas fa-info-circle mr-2"></i>
                <strong>Info:</strong> Kategori dikelola melalui database. Untuk menambah atau mengubah kategori, silakan edit tabel <code class="bg-blue-100 px-2 py-1 rounded">kategori</code> di database.
            </p>
        </div>
    </main>
</div>

<?php include VIEW_PATH . '/admin/layouts/footer.php'; ?>
