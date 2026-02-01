<!-- Main Content -->
<div class="main-content">
    <!-- Top Bar -->
    <header class="bg-white border-b border-gray-100 px-6 py-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Tambah Translation</h1>
                <p class="text-gray-500 text-sm mt-1">Buat translation key baru</p>
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
                <form action="<?= BASE_URL ?>admin/translations/store" method="POST" class="space-y-6">
                    <!-- Language Code -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Bahasa <span class="text-red-500">*</span>
                        </label>
                        <select name="lang_code" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <option value="">Pilih Bahasa</option>
                            <option value="id">🇮🇩 Indonesian (id)</option>
                            <option value="en">🇬🇧 English (en)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Kode bahasa ISO 639-1</p>
                    </div>
                    
                    <!-- Translation Key -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Translation Key <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="translation_key" required
                               placeholder="contoh: nav.home, common.welcome, detail.price"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent font-mono">
                        <p class="text-xs text-gray-500 mt-1">
                            Format: <code class="bg-gray-100 px-2 py-0.5 rounded">category.key</code>
                            <br>Contoh: <code class="bg-gray-100 px-2 py-0.5 rounded">nav.home</code>, 
                            <code class="bg-gray-100 px-2 py-0.5 rounded">common.search</code>, 
                            <code class="bg-gray-100 px-2 py-0.5 rounded">detail.ticket_price</code>
                        </p>
                    </div>
                    
                    <!-- Translation Value -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Translation Value <span class="text-red-500">*</span>
                        </label>
                        <textarea name="translation_value" rows="3" required
                                  placeholder="Beranda, Home, Harga Tiket, Ticket Price, dll"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"></textarea>
                        <p class="text-xs text-gray-500 mt-1">Teks yang akan ditampilkan di website</p>
                    </div>
                    
                    <!-- Divider -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                            <div class="flex">
                                <i class="fas fa-info-circle text-blue-600 mt-0.5 mr-3"></i>
                                <div class="text-sm text-blue-700">
                                    <p class="font-semibold mb-1">Panduan Translation Key:</p>
                                    <ul class="list-disc list-inside space-y-1 text-xs">
                                        <li><code>nav.*</code> - Menu navigasi (home, about, destination, gallery)</li>
                                        <li><code>common.*</code> - Kata umum (search, filter, view_details, read_more)</li>
                                        <li><code>detail.*</code> - Halaman detail (price, hours, location, facilities)</li>
                                        <li><code>form.*</code> - Label form (name, email, message, submit)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex items-center gap-3 pt-4">
                        <button type="submit" class="btn btn-primary px-8">
                            <i class="fas fa-save mr-2"></i>Simpan Translation
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
