<!-- Main Content -->
<div class="main-content">
    <!-- Top Bar -->
    <header class="bg-white border-b border-gray-100 px-6 py-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Translation</h1>
                <p class="text-gray-500 text-sm mt-1">Update translation value</p>
            </div>
            <a href="<?= BASE_URL ?>admin/translations" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </header>
    
    <!-- Content -->
    <main class="p-6">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-700 border border-red-200">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        
        <div class="max-w-3xl">
            <div class="bg-white rounded-lg shadow-sm p-8">
                <form action="<?= BASE_URL ?>admin/translations/update/<?= $translation['id'] ?>" method="POST" class="space-y-6">
                    <!-- Language Code (Read Only) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Bahasa
                        </label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                            <span class="inline-flex items-center text-sm font-semibold <?= $translation['lang_code'] === 'id' ? 'text-blue-700' : 'text-red-700' ?>">
                                <?= $translation['lang_code'] === 'id' ? '🇮🇩 Indonesian (id)' : '🇬🇧 English (en)' ?>
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Bahasa tidak dapat diubah</p>
                    </div>
                    
                    <!-- Translation Key (Read Only) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Translation Key
                        </label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                            <code class="text-sm font-mono text-gray-700"><?= htmlspecialchars($translation['translation_key']) ?></code>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Translation key tidak dapat diubah</p>
                    </div>
                    
                    <!-- Translation Value (Editable) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Translation Value <span class="text-red-500">*</span>
                        </label>
                        <textarea name="translation_value" rows="3" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"><?= htmlspecialchars($translation['translation_value']) ?></textarea>
                        <p class="text-xs text-gray-500 mt-1">Update teks yang akan ditampilkan di website</p>
                    </div>
                    
                    <!-- Info -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-clock text-gray-400 mt-1"></i>
                            <div class="text-sm text-gray-600">
                                <p><strong>Dibuat:</strong> <?= date('d M Y H:i', strtotime($translation['created_at'])) ?></p>
                                <p><strong>Diupdate:</strong> <?= date('d M Y H:i', strtotime($translation['updated_at'])) ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex items-center gap-3 pt-4">
                        <button type="submit" class="btn btn-primary px-8">
                            <i class="fas fa-save mr-2"></i>Update Translation
                        </button>
                        <a href="<?= BASE_URL ?>admin/translations" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
