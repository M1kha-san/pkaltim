<?php
/**
 * Admin Sidebar
 * Navigasi utama panel admin
 */

// Pastikan user sudah login dan data tersedia
if (!isset($user)) {
    require_once APP_PATH . '/helpers/Auth.php';
    $user = Auth::user();
}

$currentPath = $_SERVER['REQUEST_URI'];
$basePath = '/pkaltim-tim02-main';
$path = str_replace($basePath, '', parse_url($currentPath, PHP_URL_PATH));

function isActive($pattern, $path) {
    return strpos($path, $pattern) !== false ? 'nav-link-active' : '';
}
?>

<!-- Sidebar -->
<aside id="sidebar" class="sidebar">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="px-6 py-5 border-b border-white/10 flex-shrink-0">
            <a href="<?= BASE_URL ?>admin/dashboard" class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-lg bg-[#5F9598]/20 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-leaf text-[#5F9598]"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="truncate">
                        <span class="text-white font-semibold text-lg">Explore</span><span class="text-[#5F9598] font-semibold text-lg">Kaltim</span>
                    </div>
                    <p class="text-gray-400 text-xs truncate">Admin Panel</p>
                </div>
            </a>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 overflow-y-auto">
            <div class="space-y-1">
                <!-- Dashboard -->
                <a href="<?= BASE_URL ?>admin/dashboard" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition <?= isActive('/admin/dashboard', $path) ?>">
                    <i class="fas fa-th-large w-5 text-center mr-3"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <!-- Destinasi -->
                <a href="<?= BASE_URL ?>admin/destinasi" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition <?= isActive('/admin/destinasi', $path) ?>">
                    <i class="fas fa-map-marked-alt w-5 text-center mr-3"></i>
                    <span class="font-medium">Destinasi</span>
                </a>
                
                <!-- Artikel - Disabled (Dalam Pengembangan) -->
                <?php /* 
                <a href="<?= BASE_URL ?>admin/artikel" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition <?= isActive('/admin/artikel', $path) ?>">
                    <i class="fas fa-newspaper w-5 text-center mr-3"></i>
                    <span class="font-medium">Artikel</span>
                </a>
                */ ?>
                
                <!-- Kategori -->
                <a href="<?= BASE_URL ?>admin/kategori" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition <?= isActive('/admin/kategori', $path) ?>">
                    <i class="fas fa-tags w-5 text-center mr-3"></i>
                    <span class="font-medium">Kategori</span>
                </a>
                
                <!-- Translations / Multi-Language -->
                <a href="<?= BASE_URL ?>admin/translations" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition <?= isActive('/admin/translations', $path) ?>">
                    <i class="fas fa-language w-5 text-center mr-3"></i>
                    <span class="font-medium">Translations</span>
                </a>
                
                <?php if (isset($user) && $user['role'] === 'admin'): ?>
                <!-- Kelola Penulis (hanya admin) -->
                <a href="<?= BASE_URL ?>admin/users" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition <?= isActive('/admin/users', $path) ?>">
                    <i class="fas fa-users-cog w-5 text-center mr-3"></i>
                    <span class="font-medium">Kelola Penulis</span>
                </a>
                <?php endif; ?>
            </div>
            
            <!-- Divider -->
            <div class="border-t border-white/10 my-6"></div>
            
            <div class="space-y-1">
                <!-- Lihat Website -->
                <a href="<?= BASE_URL ?>" target="_blank" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition">
                    <i class="fas fa-external-link-alt w-5 text-center mr-3"></i>
                    <span class="font-medium">Lihat Website</span>
                </a>
            </div>
        </nav>
        
        <!-- User Info -->
        <div class="px-4 py-4 border-t border-white/10 flex-shrink-0">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center space-x-3 min-w-0 flex-1">
                    <div class="w-10 h-10 rounded-full bg-[#5F9598] flex items-center justify-center text-white font-semibold flex-shrink-0">
                        <?php 
                        $nama = isset($user) ? ($user['nama_lengkap'] ?? $user['nama'] ?? 'Admin') : 'Admin';
                        echo strtoupper(substr($nama, 0, 1)); 
                        ?>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-white font-medium text-sm truncate"><?= htmlspecialchars($nama) ?></p>
                        <p class="text-gray-400 text-xs capitalize truncate">
                            <?= isset($user) && $user['role'] === 'admin' ? 'Administrator' : 'Penulis' ?>
                        </p>
                    </div>
                </div>
                <a href="<?= BASE_URL ?>admin/logout" class="text-gray-400 hover:text-white transition flex-shrink-0" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>
</aside>

<!-- Mobile Menu Toggle -->
<button id="sidebarToggle" class="lg:hidden fixed top-4 left-4 z-50 w-10 h-10 bg-[#061E29] text-white rounded-lg flex items-center justify-center shadow-lg">
    <i class="fas fa-bars"></i>
</button>

<!-- Overlay for mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');
    
    toggle.addEventListener('click', function() {
        sidebar.classList.toggle('sidebar-open');
        overlay.classList.toggle('hidden');
        
        const icon = toggle.querySelector('i');
        if (sidebar.classList.contains('sidebar-open')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });
    
    overlay.addEventListener('click', function() {
        sidebar.classList.remove('sidebar-open');
        overlay.classList.add('hidden');
        toggle.querySelector('i').classList.remove('fa-times');
        toggle.querySelector('i').classList.add('fa-bars');
    });
});
</script>
