<?php
/**
 * Auth Helper
 * Menangani autentikasi dan session untuk admin
 */

class Auth {
    
    /**
     * Login admin
     */
    public static function login($admin) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_nama'] = $admin['nama_lengkap'];
        $_SESSION['admin_role'] = $admin['role'];
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['login_time'] = time();
    }
    
    /**
     * Logout admin
     */
    public static function logout() {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
        unset($_SESSION['admin_nama']);
        unset($_SESSION['admin_role']);
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['login_time']);
        session_destroy();
    }
    
    /**
     * Cek apakah admin sudah login
     */
    public static function check() {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }
    
    /**
     * Dapatkan data admin yang login
     */
    public static function user() {
        if (!self::check()) {
            return null;
        }
        
        return [
            'id' => $_SESSION['admin_id'],
            'username' => $_SESSION['admin_username'],
            'nama' => $_SESSION['admin_nama'],
            'nama_lengkap' => $_SESSION['admin_nama'], // Alias untuk konsistensi
            'role' => $_SESSION['admin_role']
        ];
    }
    
    /**
     * Dapatkan ID admin yang login
     */
    public static function id() {
        return $_SESSION['admin_id'] ?? null;
    }
    
    /**
     * Cek apakah admin memiliki role tertentu
     */
    public static function hasRole($role) {
        if (!self::check()) {
            return false;
        }
        
        if (is_array($role)) {
            return in_array($_SESSION['admin_role'], $role);
        }
        
        return $_SESSION['admin_role'] === $role;
    }
    
    /**
     * Redirect jika belum login
     */
    public static function requireLogin() {
        if (!self::check()) {
            header('Location: ' . BASE_URL . 'admin/login');
            exit;
        }
    }
    
    /**
     * Redirect jika sudah login
     */
    public static function redirectIfLoggedIn() {
        if (self::check()) {
            header('Location: ' . BASE_URL . 'admin/dashboard');
            exit;
        }
    }
    
    /**
     * Set flash message
     */
    public static function setFlash($type, $message) {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }
    
    /**
     * Dapatkan dan hapus flash message
     */
    public static function getFlash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
    
    /**
     * Generate CSRF token
     */
    public static function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Validasi CSRF token
     */
    public static function validateCsrfToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}
