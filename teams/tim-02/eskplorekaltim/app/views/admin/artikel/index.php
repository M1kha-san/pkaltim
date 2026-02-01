<?php
/**
 * Admin Artikel List
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
                <h1 class="text-2xl font-bold text-gray-800">Kelola Artikel</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola artikel dan berita wisata</p>
            </div>
            <a href="<?= BASE_URL ?>admin/artikel/create" 
               class="inline-flex items-center px-4 py-2 bg-[#1D546D] text-white rounded-lg hover:bg-[#061E29] transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Artikel
            </a>
        </div>
    </header>
    
    <!-- Content -->
    <main class="p-6">
        <?php if (isset($flash)): ?>
            <div class="mb-6 p-4 rounded-lg <?= $flash['type'] === 'success' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200' ?>">
                <i class="fas fa-<?= $flash['type'] === 'success' ? 'check' : 'exclamation' ?>-circle mr-2"></i>
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>
    
    <!-- Artikel Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Artikel
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Views
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (empty($artikel)): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-newspaper text-4xl text-gray-300 mb-3"></i>
                            <p>Belum ada artikel.</p>
                            <a href="<?= BASE_URL ?>/admin/artikel/create" class="text-secondary hover:underline">
                                Tambah artikel pertama
                            </a>
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($artikel as $item): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-16 w-24">
                                    <?php if (!empty($item['foto_thumbnail'])): ?>
                                    <img class="h-16 w-24 rounded-lg object-cover" 
                                         src="<?= BASE_URL ?>/public/images/artikel/<?= htmlspecialchars($item['foto_thumbnail']) ?>" 
                                         alt="<?= htmlspecialchars($item['judul']) ?>">
                                    <?php else: ?>
                                    <div class="h-16 w-24 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-xl"></i>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="text-sm font-medium text-gray-900 line-clamp-2">
                                        <?= htmlspecialchars($item['judul']) ?>
                                    </div>
                                    <div class="text-sm text-gray-500 line-clamp-1">
                                        <?= htmlspecialchars($item['excerpt'] ?? substr(strip_tags($item['konten']), 0, 80)) ?>...
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <?php if ($item['is_published']): ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Published
                            </span>
                            <?php else: ?>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-edit mr-1"></i>
                                Draft
                            </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-900">
                                <i class="fas fa-eye text-gray-400 mr-1"></i>
                                <?= number_format($item['view_count'] ?? 0) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?php 
                            $date = !empty($item['published_at']) ? $item['published_at'] : $item['created_at'];
                            echo date('d M Y', strtotime($date)); 
                            ?>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="<?= BASE_URL ?>/admin/artikel/edit/<?= $item['id'] ?>" 
                                   class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete(<?= $item['id'] ?>, '<?= htmlspecialchars(addslashes($item['judul'])) ?>')"
                                        class="inline-flex items-center justify-center w-8 h-8 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black bg-opacity-50" onclick="closeDeleteModal()"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-xl shadow-xl p-6 w-full max-w-md">
        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-600 mb-6">
                Apakah Anda yakin ingin menghapus artikel<br>
                "<span id="deleteArtikelName" class="font-medium"></span>"?
            </p>
            <form id="deleteForm" method="POST" class="flex space-x-3">
                <input type="hidden" name="csrf_token" value="<?= Auth::generateCsrfToken() ?>">
                <button type="button" onclick="closeDeleteModal()" 
                        class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteArtikelName').textContent = name;
    document.getElementById('deleteForm').action = '<?= BASE_URL ?>/admin/artikel/delete/' + id;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close modal with escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>

    </main>
</div>

<?php include VIEW_PATH . '/admin/layouts/footer.php'; ?>
