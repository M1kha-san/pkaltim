<?php
/**
 * Admin Destinasi Edit - Form Edit Destinasi
 */
include VIEW_PATH . '/admin/layouts/header.php';
include VIEW_PATH . '/admin/layouts/sidebar.php';
?>

<!-- Main Content -->
<div class="main-content">
    <!-- Top Bar -->
    <header class="bg-white border-b border-gray-100 px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="<?= BASE_URL ?>admin/destinasi" class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Destinasi</h1>
                    <p class="text-gray-500 text-sm mt-1"><?= htmlspecialchars($destinasi['nama']) ?></p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>destinasi/<?= $destinasi['id'] ?>" target="_blank" class="btn btn-secondary">
                <i class="fas fa-eye mr-2"></i> Lihat
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
        
        <form action="<?= BASE_URL ?>admin/destinasi/update/<?= $destinasi['id'] ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Form -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Informasi Dasar -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Dasar</h2>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="form-label">Nama Destinasi <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" class="form-input" value="<?= htmlspecialchars($destinasi['nama']) ?>" required>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="form-label">Kategori <span class="text-red-500">*</span></label>
                                    <select name="kategori_id" class="form-input" required>
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($kategoris as $kat): ?>
                                            <option value="<?= $kat['id'] ?>" <?= $kat['id'] == $destinasi['kategori_id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($kat['nama']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Kabupaten/Kota <span class="text-red-500">*</span></label>
                                    <select name="kabupaten_id" class="form-input" required>
                                        <option value="">Pilih Kabupaten</option>
                                        <?php foreach ($kabupatens as $kab): ?>
                                            <option value="<?= $kab['id'] ?>" <?= $kab['id'] == $destinasi['kabupaten_id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($kab['nama']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div>
                                <label class="form-label">Deskripsi <span class="text-red-500">*</span></label>
                                <textarea name="deskripsi" rows="4" class="form-input" required><?= htmlspecialchars($destinasi['deskripsi']) ?></textarea>
                            </div>
                            
                            <div>
                                <label class="form-label">Sejarah (Opsional)</label>
                                <textarea name="sejarah" rows="3" class="form-input"><?= htmlspecialchars($destinasi['sejarah'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Lokasi & Detail -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Lokasi & Detail</h2>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="form-label">Alamat Lengkap</label>
                                <input type="text" name="alamat" class="form-input" value="<?= htmlspecialchars($destinasi['alamat'] ?? '') ?>">
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="form-label">Latitude</label>
                                    <input type="text" name="latitude" class="form-input" value="<?= $destinasi['latitude'] ?? '' ?>">
                                </div>
                                <div>
                                    <label class="form-label">Longitude</label>
                                    <input type="text" name="longitude" class="form-input" value="<?= $destinasi['longitude'] ?? '' ?>">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="form-label">Harga Tiket</label>
                                    <input type="text" name="harga_tiket" class="form-input" value="<?= htmlspecialchars($destinasi['harga_tiket'] ?? '') ?>">
                                </div>
                                <div>
                                    <label class="form-label">Jam Operasional</label>
                                    <input type="text" name="jam_operasional" class="form-input" value="<?= htmlspecialchars($destinasi['jam_operasional'] ?? '') ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fasilitas -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Fasilitas</h2>
                            <button type="button" onclick="addFasilitas()" class="text-sm text-[#1D546D] hover:underline">
                                <i class="fas fa-plus mr-1"></i> Tambah Fasilitas
                            </button>
                        </div>
                        
                        <div id="fasilitas-container" class="space-y-3">
                            <?php if (!empty($fasilitas)): ?>
                                <?php foreach ($fasilitas as $idx => $fas): ?>
                                    <div class="fasilitas-item flex items-center gap-3">
                                        <input type="text" name="fasilitas[<?= $idx ?>][nama]" class="form-input flex-1" value="<?= htmlspecialchars($fas['nama']) ?>">
                                        <input type="text" name="fasilitas[<?= $idx ?>][icon]" class="form-input w-32" value="<?= htmlspecialchars($fas['icon']) ?>">
                                        <button type="button" onclick="removeFasilitas(this)" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="fasilitas-item flex items-center gap-3">
                                    <input type="text" name="fasilitas[0][nama]" class="form-input flex-1" placeholder="Nama fasilitas (contoh: Area Parkir)">
                                    <input type="text" name="fasilitas[0][icon]" class="form-input w-32" placeholder="Icon (fa-parking)">
                                    <button type="button" onclick="removeFasilitas(this)" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Tips -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Tips & Panduan</h2>
                            <button type="button" onclick="addTips()" class="text-sm text-[#1D546D] hover:underline">
                                <i class="fas fa-plus mr-1"></i> Tambah Tips
                            </button>
                        </div>
                        
                        <div id="tips-container" class="space-y-4">
                            <?php if (!empty($tips)): ?>
                                <?php foreach ($tips as $idx => $tip): ?>
                                    <div class="tips-item bg-gray-50 rounded-lg p-4">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                                            <input type="text" name="tips[<?= $idx ?>][judul]" class="form-input md:col-span-2" value="<?= htmlspecialchars($tip['judul']) ?>">
                                            <select name="tips[<?= $idx ?>][tipe]" class="form-input">
                                                <option value="tips" <?= $tip['tipe'] == 'tips' ? 'selected' : '' ?>>Tips</option>
                                                <option value="larangan" <?= $tip['tipe'] == 'larangan' ? 'selected' : '' ?>>Larangan</option>
                                                <option value="perhatian" <?= $tip['tipe'] == 'perhatian' ? 'selected' : '' ?>>Perhatian</option>
                                            </select>
                                        </div>
                                        <div class="flex gap-3">
                                            <textarea name="tips[<?= $idx ?>][konten]" rows="2" class="form-input flex-1"><?= htmlspecialchars($tip['konten']) ?></textarea>
                                            <button type="button" onclick="removeTips(this)" class="text-red-500 hover:text-red-700 self-start mt-2">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="tips-item bg-gray-50 rounded-lg p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                                        <input type="text" name="tips[0][judul]" class="form-input md:col-span-2" placeholder="Judul tips">
                                        <select name="tips[0][tipe]" class="form-input">
                                            <option value="tips">Tips</option>
                                            <option value="larangan">Larangan</option>
                                            <option value="perhatian">Perhatian</option>
                                        </select>
                                    </div>
                                    <div class="flex gap-3">
                                        <textarea name="tips[0][konten]" rows="2" class="form-input flex-1" placeholder="Isi tips atau panduan..."></textarea>
                                        <button type="button" onclick="removeTips(this)" class="text-red-500 hover:text-red-700 self-start mt-2">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Foto Utama -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Foto Utama</h2>
                        
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center" id="dropzone">
                            <input type="file" name="foto_utama" id="foto_utama" accept="image/*" class="hidden" onchange="previewImage(this)">
                            
                            <?php if (!empty($destinasi['foto_utama'])): ?>
                                <div id="preview-container" class="mb-4">
                                    <img id="image-preview" src="<?= BASE_URL ?>public/images/destinations/<?= $destinasi['foto_utama'] ?>" class="max-h-48 mx-auto rounded-lg"
                                         onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
                                </div>
                                <div id="upload-placeholder">
                                    <button type="button" onclick="document.getElementById('foto_utama').click()" class="text-[#1D546D] font-medium hover:underline">
                                        Ganti Foto
                                    </button>
                                    <p class="text-gray-400 text-xs mt-2">JPG, PNG, WEBP (Max 5MB)</p>
                                </div>
                            <?php else: ?>
                                <div id="preview-container" class="hidden mb-4">
                                    <img id="image-preview" class="max-h-48 mx-auto rounded-lg">
                                </div>
                                <div id="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500 mb-2">Seret foto ke sini atau</p>
                                    <button type="button" onclick="document.getElementById('foto_utama').click()" class="text-[#1D546D] font-medium hover:underline">
                                        Pilih File
                                    </button>
                                    <p class="text-gray-400 text-xs mt-2">JPG, PNG, WEBP (Max 5MB)</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Pengaturan -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Pengaturan</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="form-label">Rating (0-5)</label>
                                <input type="number" name="rating" step="0.1" min="0" max="5" value="<?= $destinasi['rating'] ?? 0 ?>" class="form-input">
                            </div>
                            
                            <div class="flex items-center gap-3 py-3 border-t border-gray-100">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                                       <?= $destinasi['is_featured'] ? 'checked' : '' ?>
                                       class="w-5 h-5 rounded border-gray-300 text-[#1D546D] focus:ring-[#5F9598]">
                                <label for="is_featured" class="font-medium text-gray-700">
                                    Tampilkan di Featured
                                    <p class="text-gray-500 text-xs font-normal">Destinasi akan ditampilkan di halaman utama</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info -->
                    <div class="bg-gray-50 rounded-xl p-4 text-sm text-gray-500">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-eye"></i>
                            <span>Views: <?= number_format($destinasi['view_count']) ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar"></i>
                            <span>Dibuat: <?= date('d M Y', strtotime($destinasi['created_at'])) ?></span>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <button type="submit" class="btn btn-primary w-full mb-3">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                        <a href="<?= BASE_URL ?>admin/destinasi" class="btn btn-secondary w-full">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </main>
    
    <?php include VIEW_PATH . '/admin/layouts/footer.php'; ?>

<script>
let fasilitasCount = <?= !empty($fasilitas) ? count($fasilitas) : 1 ?>;
let tipsCount = <?= !empty($tips) ? count($tips) : 1 ?>;

function addFasilitas() {
    const container = document.getElementById('fasilitas-container');
    const html = `
        <div class="fasilitas-item flex items-center gap-3">
            <input type="text" name="fasilitas[${fasilitasCount}][nama]" class="form-input flex-1" placeholder="Nama fasilitas">
            <input type="text" name="fasilitas[${fasilitasCount}][icon]" class="form-input w-32" placeholder="Icon (fa-xxx)">
            <button type="button" onclick="removeFasilitas(this)" class="text-red-500 hover:text-red-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    fasilitasCount++;
}

function removeFasilitas(btn) {
    btn.closest('.fasilitas-item').remove();
}

function addTips() {
    const container = document.getElementById('tips-container');
    const html = `
        <div class="tips-item bg-gray-50 rounded-lg p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                <input type="text" name="tips[${tipsCount}][judul]" class="form-input md:col-span-2" placeholder="Judul tips">
                <select name="tips[${tipsCount}][tipe]" class="form-input">
                    <option value="tips">Tips</option>
                    <option value="larangan">Larangan</option>
                    <option value="perhatian">Perhatian</option>
                </select>
            </div>
            <div class="flex gap-3">
                <textarea name="tips[${tipsCount}][konten]" rows="2" class="form-input flex-1" placeholder="Isi tips..."></textarea>
                <button type="button" onclick="removeTips(this)" class="text-red-500 hover:text-red-700 self-start mt-2">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    tipsCount++;
}

function removeTips(btn) {
    btn.closest('.tips-item').remove();
}

function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('preview-container');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
