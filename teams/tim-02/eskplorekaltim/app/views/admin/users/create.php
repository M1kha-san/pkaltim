<?php
/**
 * Admin Users Create
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
                <h1 class="text-2xl font-bold text-gray-800">Tambah User</h1>
                <p class="text-gray-500 text-sm mt-1">Tambahkan user baru (admin atau penulis)</p>
            </div>
            <a href="<?= BASE_URL ?>admin/users" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </header>
    
    <!-- Content -->
    <main class="p-6">
        <?php if (isset($flash)): ?>
            <div class="mb-6 p-4 rounded-lg <?= $flash['type'] === 'success' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200' ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>
        
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form method="POST" action="<?= BASE_URL ?>admin/users/store">
                <input type="hidden" name="csrf_token" value="<?= Auth::generateCsrfToken() ?>">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Username -->
                    <div>
                        <label class="form-label">Username <span class="text-red-500">*</span></label>
                        <input type="text" name="username" class="form-input" required>
                        <p class="text-xs text-gray-500 mt-1">Gunakan huruf kecil, angka, dan underscore</p>
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label class="form-label">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" class="form-input" required>
                    </div>
                    
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-input" required>
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label class="form-label">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" class="form-input" required minlength="6">
                        <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter</p>
                    </div>
                    
                    <!-- Role -->
                    <div>
                        <label class="form-label">Role <span class="text-red-500">*</span></label>
                        <select name="role" class="form-input" required>
                            <option value="penulis">Penulis</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <a href="<?= BASE_URL ?>admin/users" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php include VIEW_PATH . '/admin/layouts/footer.php'; ?>
