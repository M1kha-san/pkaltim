<!-- Main Content -->
<div class="main-content">
    <!-- Top Bar -->
    <header class="bg-white border-b border-gray-100 px-6 py-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Kelola Translations</h1>
                <p class="text-gray-500 text-sm mt-1">Multi-language translation management</p>
            </div>
            <a href="<?= BASE_URL ?>admin/translations/create" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>Tambah Translation
            </a>
        </div>
    </header>
    
    <!-- Content -->
    <main class="p-6">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 border border-green-200">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-700 border border-red-200">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Indonesian</p>
                        <p class="text-2xl font-bold text-gray-800"><?= $stats['id'] ?? 0 ?></p>
                    </div>
                    <div class="text-3xl">🇮🇩</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">English</p>
                        <p class="text-2xl font-bold text-gray-800"><?= $stats['en'] ?? 0 ?></p>
                    </div>
                    <div class="text-3xl">🇬🇧</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-teal-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Keys</p>
                        <p class="text-2xl font-bold text-gray-800"><?= count($translations) ?></p>
                    </div>
                    <div class="text-3xl"><i class="fas fa-language"></i></div>
                </div>
            </div>
        </div>
        
        <!-- Filter -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <form method="GET" action="<?= BASE_URL ?>admin/translations" class="flex gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="<?= htmlspecialchars($filter_search) ?>" 
                           placeholder="Cari key atau value..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                </div>
                <div class="w-48">
                    <select name="lang" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        <option value="">Semua Bahasa</option>
                        <option value="id" <?= $filter_lang === 'id' ? 'selected' : '' ?>>🇮🇩 Indonesian</option>
                        <option value="en" <?= $filter_lang === 'en' ? 'selected' : '' ?>>🇬🇧 English</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary px-6">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <?php if ($filter_lang || $filter_search): ?>
                <a href="<?= BASE_URL ?>admin/translations" class="btn btn-secondary px-6">
                    <i class="fas fa-times mr-2"></i>Reset
                </a>
                <?php endif; ?>
            </form>
        </div>
        
        <!-- Translation Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-20">Lang</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Translation Key</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Translation Value</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (empty($translations)): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-language text-4xl mb-3 text-gray-300"></i>
                                    <p class="font-medium">Belum ada translation</p>
                                    <a href="<?= BASE_URL ?>admin/translations/create" class="text-teal-600 hover:text-teal-700 text-sm mt-2 inline-block">
                                        <i class="fas fa-plus mr-1"></i>Tambah translation pertama
                                    </a>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($translations as $translation): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold <?= $translation['lang_code'] === 'id' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700' ?>">
                                            <?= $translation['lang_code'] === 'id' ? '🇮🇩 ID' : '🇬🇧 EN' ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <code class="text-sm font-mono text-gray-700 bg-gray-50 px-2 py-1 rounded"><?= htmlspecialchars($translation['translation_key']) ?></code>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900"><?= htmlspecialchars($translation['translation_value']) ?></div>
                                        <div class="text-xs text-gray-400 mt-1">Updated: <?= date('d M Y H:i', strtotime($translation['updated_at'])) ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="<?= BASE_URL ?>admin/translations/edit/<?= $translation['id'] ?>" 
                                               class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?= BASE_URL ?>admin/translations/delete/<?= $translation['id'] ?>" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus translation ini?')" 
                                                  class="inline">
                                                <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
