<?php
/**
 * Entry Point - Front Controller
 * Sistem Informasi Wisata Alam Kaltim
 */

// Load Composer Autoloader & Environment Variables
require_once __DIR__ . '/vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Load Configuration
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

// Load Language Helper
require_once __DIR__ . '/app/helpers/Language.php';
Language::init();

// Simple Router
$request = $_SERVER['REQUEST_URI'];
$basePath = '/pkaltim-tim02-main';
$path = str_replace($basePath, '', parse_url($request, PHP_URL_PATH));

// Remove trailing slash
$path = rtrim($path, '/');
if ($path === '') {
    $path = '/';
}

// ==========================================
// ADMIN ROUTES
// ==========================================

// Admin Login Form
if ($path === '/admin/login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once APP_PATH . '/controllers/AuthController.php';
    $controller = new AuthController();
    $controller->loginForm();
}
// Admin Login Process
elseif ($path === '/admin/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AuthController.php';
    $controller = new AuthController();
    $controller->login();
}
// Admin Logout
elseif ($path === '/admin/logout') {
    require_once APP_PATH . '/controllers/AuthController.php';
    $controller = new AuthController();
    $controller->logout();
}
// Admin Dashboard
elseif ($path === '/admin' || $path === '/admin/dashboard') {
    require_once APP_PATH . '/controllers/AdminController.php';
    $controller = new AdminController();
    $controller->dashboard();
}
// Admin Destinasi List
elseif ($path === '/admin/destinasi') {
    require_once APP_PATH . '/controllers/AdminDestinasiController.php';
    $controller = new AdminDestinasiController();
    $controller->index();
}
// Admin Destinasi Create Form
elseif ($path === '/admin/destinasi/create') {
    require_once APP_PATH . '/controllers/AdminDestinasiController.php';
    $controller = new AdminDestinasiController();
    $controller->create();
}
// Admin Destinasi Store
elseif ($path === '/admin/destinasi/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminDestinasiController.php';
    $controller = new AdminDestinasiController();
    $controller->store();
}
// Admin Destinasi Edit Form
elseif (preg_match('/^\/admin\/destinasi\/edit\/(\d+)$/', $path, $matches)) {
    require_once APP_PATH . '/controllers/AdminDestinasiController.php';
    $controller = new AdminDestinasiController();
    $controller->edit($matches[1]);
}
// Admin Destinasi Update
elseif (preg_match('/^\/admin\/destinasi\/update\/(\d+)$/', $path, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminDestinasiController.php';
    $controller = new AdminDestinasiController();
    $controller->update($matches[1]);
}
// Admin Destinasi Delete
elseif (preg_match('/^\/admin\/destinasi\/delete\/(\d+)$/', $path, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminDestinasiController.php';
    $controller = new AdminDestinasiController();
    $controller->delete($matches[1]);
}
// Admin Artikel List
elseif ($path === '/admin/artikel') {
    require_once APP_PATH . '/controllers/AdminArtikelController.php';
    $controller = new AdminArtikelController();
    $controller->index();
}
// Admin Artikel Create Form
elseif ($path === '/admin/artikel/create') {
    require_once APP_PATH . '/controllers/AdminArtikelController.php';
    $controller = new AdminArtikelController();
    $controller->create();
}
// Admin Artikel Store
elseif ($path === '/admin/artikel/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminArtikelController.php';
    $controller = new AdminArtikelController();
    $controller->store();
}
// Admin Artikel Edit Form
elseif (preg_match('/^\/admin\/artikel\/edit\/(\d+)$/', $path, $matches)) {
    require_once APP_PATH . '/controllers/AdminArtikelController.php';
    $controller = new AdminArtikelController();
    $controller->edit($matches[1]);
}
// Admin Artikel Update
elseif (preg_match('/^\/admin\/artikel\/update\/(\d+)$/', $path, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminArtikelController.php';
    $controller = new AdminArtikelController();
    $controller->update($matches[1]);
}
// Admin Artikel Delete
elseif (preg_match('/^\/admin\/artikel\/delete\/(\d+)$/', $path, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminArtikelController.php';
    $controller = new AdminArtikelController();
    $controller->delete($matches[1]);
}
// Admin Kategori List
elseif ($path === '/admin/kategori') {
    require_once APP_PATH . '/controllers/AdminKategoriController.php';
    $controller = new AdminKategoriController();
    $controller->index();
}
// Admin Users List
elseif ($path === '/admin/users') {
    require_once APP_PATH . '/controllers/AdminUsersController.php';
    $controller = new AdminUsersController();
    $controller->index();
}
// Admin Users Create Form
elseif ($path === '/admin/users/create') {
    require_once APP_PATH . '/controllers/AdminUsersController.php';
    $controller = new AdminUsersController();
    $controller->create();
}
// Admin Users Store
elseif ($path === '/admin/users/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminUsersController.php';
    $controller = new AdminUsersController();
    $controller->store();
}
// Admin Users Edit Form
elseif (preg_match('/^\/admin\/users\/edit\/(\d+)$/', $path, $matches)) {
    require_once APP_PATH . '/controllers/AdminUsersController.php';
    $controller = new AdminUsersController();
    $controller->edit($matches[1]);
}
// Admin Users Update
elseif (preg_match('/^\/admin\/users\/update\/(\d+)$/', $path, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminUsersController.php';
    $controller = new AdminUsersController();
    $controller->update($matches[1]);
}
// Admin Users Delete
elseif (preg_match('/^\/admin\/users\/delete\/(\d+)$/', $path, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminUsersController.php';
    $controller = new AdminUsersController();
    $controller->delete($matches[1]);
}
// Admin Translations List
elseif ($path === '/admin/translations') {
    require_once APP_PATH . '/controllers/AdminTranslationController.php';
    $controller = new AdminTranslationController();
    $controller->index();
}
// Admin Translations Create Form
elseif ($path === '/admin/translations/create') {
    require_once APP_PATH . '/controllers/AdminTranslationController.php';
    $controller = new AdminTranslationController();
    $controller->create();
}
// Admin Translations Store
elseif ($path === '/admin/translations/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminTranslationController.php';
    $controller = new AdminTranslationController();
    $controller->store();
}
// Admin Translations Edit Form
elseif (preg_match('/^\/admin\/translations\/edit\/(\d+)$/', $path, $matches)) {
    require_once APP_PATH . '/controllers/AdminTranslationController.php';
    $controller = new AdminTranslationController();
    $controller->edit($matches[1]);
}
// Admin Translations Update
elseif (preg_match('/^\/admin\/translations\/update\/(\d+)$/', $path, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminTranslationController.php';
    $controller = new AdminTranslationController();
    $controller->update($matches[1]);
}
// Admin Translations Delete
elseif (preg_match('/^\/admin\/translations\/delete\/(\d+)$/', $path, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once APP_PATH . '/controllers/AdminTranslationController.php';
    $controller = new AdminTranslationController();
    $controller->delete($matches[1]);
}

// ==========================================
// PUBLIC ROUTES
// ==========================================

// Home
elseif ($path === '/' || $path === '/home') {
    require_once APP_PATH . '/controllers/HomeController.php';
    $controller = new HomeController();
    $controller->index();
}
// Destinasi List
elseif ($path === '/destinasi') {
    require_once APP_PATH . '/controllers/DestinasiController.php';
    $controller = new DestinasiController();
    $controller->index();
}
// Destinasi Detail
elseif (preg_match('/^\/destinasi\/(\d+)$/', $path, $matches)) {
    require_once APP_PATH . '/controllers/DestinasiController.php';
    $controller = new DestinasiController();
    $controller->detail($matches[1]);
}
// Galeri (DISABLED - fitur tambahan untuk nanti)
// elseif ($path === '/galeri') {
//     require_once APP_PATH . '/controllers/GaleriController.php';
//     $controller = new GaleriController();
//     $controller->index();
// }
// Artikel
elseif ($path === '/artikel') {
    require_once APP_PATH . '/controllers/ArtikelController.php';
    $controller = new ArtikelController();
    $controller->index();
}
// Language Switcher
elseif ($path === '/language/switch' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $lang = isset($_POST['lang']) ? $_POST['lang'] : 'id';
    Language::setLanguage($lang);
    
    // Redirect back to previous page
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : BASE_URL;
    header('Location: ' . $referer);
    exit;
}
// 404 Not Found
else {
    http_response_code(404);
    echo "404 - Page Not Found";
}
