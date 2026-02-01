<?php require_once VIEW_PATH . '/admin/layouts/header.php'; ?>
<?php require_once VIEW_PATH . '/admin/layouts/sidebar.php'; ?>

<!-- Main Content -->
<div class="flex-1 p-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="<?= BASE_URL ?>/admin/artikel" class="inline-flex items-center text-gray-600 hover:text-secondary mb-4">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Artikel
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Artikel Baru</h1>
        <p class="text-gray-600">Buat artikel atau berita wisata baru</p>
    </div>
    
    <!-- Flash Messages -->
    <?php if ($flash = Auth::getFlash('error')): ?>
    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <?= $flash ?>
    </div>
    <?php endif; ?>
    
    <!-- Form -->
    <form action="<?= BASE_URL ?>/admin/artikel/store" method="POST" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="csrf_token" value="<?= Auth::generateCsrfToken() ?>">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Judul -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Artikel <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="judul" 
                           name="judul" 
                           value="<?= htmlspecialchars($artikel['judul']) ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary transition"
                           placeholder="Masukkan judul artikel yang menarik"
                           required>
                    <p class="mt-1 text-sm text-gray-500">Judul minimal 5 karakter</p>
                </div>
                
                <!-- Excerpt -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                        Ringkasan (Excerpt)
                    </label>
                    <textarea id="excerpt" 
                              name="excerpt" 
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary transition"
                              placeholder="Ringkasan singkat artikel (opsional)"><?= htmlspecialchars($artikel['excerpt'] ?? '') ?></textarea>
                    <p class="mt-1 text-sm text-gray-500">Akan otomatis dibuat dari konten jika dikosongkan</p>
                </div>
                
                <!-- Konten -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <label for="konten" class="block text-sm font-medium text-gray-700 mb-2">
                        Konten Artikel <span class="text-red-500">*</span>
                    </label>
                    <textarea id="konten" 
                              name="konten" 
                              rows="15"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary transition"
                              placeholder="Tulis konten artikel di sini..."
                              required><?= htmlspecialchars($artikel['konten']) ?></textarea>
                    <p class="mt-1 text-sm text-gray-500">Konten minimal 50 karakter. Anda dapat menggunakan format HTML.</p>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status & Publish -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-4">Publikasi</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="kategori_artikel" class="block text-sm text-gray-600 mb-2">Kategori</label>
                            <select id="kategori_artikel" 
                                    name="kategori_artikel" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary transition">
                                <option value="Umum" <?= ($artikel['kategori_artikel'] ?? '') === 'Umum' ? 'selected' : '' ?>>Umum</option>
                                <option value="Panduan Wisata" <?= ($artikel['kategori_artikel'] ?? '') === 'Panduan Wisata' ? 'selected' : '' ?>>Panduan Wisata</option>
                                <option value="Tips Perjalanan" <?= ($artikel['kategori_artikel'] ?? '') === 'Tips Perjalanan' ? 'selected' : '' ?>>Tips Perjalanan</option>
                                <option value="Kuliner" <?= ($artikel['kategori_artikel'] ?? '') === 'Kuliner' ? 'selected' : '' ?>>Kuliner</option>
                                <option value="Budaya" <?= ($artikel['kategori_artikel'] ?? '') === 'Budaya' ? 'selected' : '' ?>>Budaya</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_published" 
                                   name="is_published" 
                                   value="1"
                                   <?= ($artikel['is_published'] ?? 0) ? 'checked' : '' ?>
                                   class="w-4 h-4 text-secondary border-gray-300 rounded focus:ring-secondary">
                            <label for="is_published" class="ml-2 text-sm text-gray-700">Publikasikan artikel</label>
                        </div>
                        
                        <div class="pt-4 border-t border-gray-200">
                            <button type="submit" 
                                    class="w-full px-4 py-3 bg-secondary text-white font-medium rounded-lg hover:bg-primary transition flex items-center justify-center">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Artikel
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Gambar -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-4">Gambar Utama</h3>
                    
                    <div class="space-y-4">
                        <div id="imagePreview" class="hidden">
                            <img id="previewImg" src="" alt="Preview" class="w-full h-48 object-cover rounded-lg mb-3">
                            <button type="button" onclick="removeImage()" class="text-red-500 text-sm hover:underline">
                                <i class="fas fa-times mr-1"></i>
                                Hapus gambar
                            </button>
                        </div>
                        
                        <div id="uploadArea" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-secondary transition cursor-pointer"
                             onclick="document.getElementById('foto_thumbnail').click()">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <p class="text-sm text-gray-600">Klik untuk upload gambar</p>
                            <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP (Maks. 2MB)</p>
                        </div>
                        
                        <input type="file" 
                               id="foto_thumbnail" 
                               name="foto_thumbnail" 
                               accept="image/jpeg,image/jpg,image/png,image/webp"
                               class="hidden"
                               onchange="previewImage(this)">
                    </div>
                </div>
                    </div>
                </div>
                
                <!-- Tips -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-4">
                        <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                        Tips Menulis
                    </h3>
                    <ul class="text-sm text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                            Gunakan judul yang menarik dan informatif
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                            Sertakan gambar berkualitas tinggi
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                            Pisahkan paragraf untuk keterbacaan
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                            Sertakan informasi praktis dan bermanfaat
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
            document.getElementById('uploadArea').classList.add('hidden');
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    document.getElementById('foto_thumbnail').value = '';
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('uploadArea').classList.remove('hidden');
}
</script>

<?php require_once VIEW_PATH . '/admin/layouts/footer.php'; ?>
