<?php
/**
 * Auth Controller
 * Menangani login dan logout admin
 */

class AuthController {
    private $adminModel;
    
    public function __construct() {
        require_once APP_PATH . '/models/Admin.php';
        require_once APP_PATH . '/helpers/Auth.php';
        $this->adminModel = new Admin();
    }
    
    /**
     * Tampilkan halaman login
     */
    public function loginForm() {
        // Redirect jika sudah login
        Auth::redirectIfLoggedIn();
        
        $data = [
            'pageTitle' => 'Login Admin',
            'error' => null,
            'csrf_token' => Auth::generateCsrfToken()
        ];
        
        $this->view('admin/auth/login', $data);
    }
    
    /**
     * Proses login
     */
    public function login() {
        // Redirect jika sudah login
        Auth::redirectIfLoggedIn();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/login');
            exit;
        }
        
        // Validasi CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Auth::validateCsrfToken($csrfToken)) {
            Auth::setFlash('error', 'Token keamanan tidak valid. Silakan coba lagi.');
            header('Location: ' . BASE_URL . 'admin/login');
            exit;
        }
        
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        
        // Validasi input
        if (empty($username) || empty($password)) {
            Auth::setFlash('error', 'Username dan password wajib diisi.');
            header('Location: ' . BASE_URL . 'admin/login');
            exit;
        }
        
        // Cari admin berdasarkan username atau email
        $admin = $this->adminModel->findByUsername($username);
        if (!$admin) {
            $admin = $this->adminModel->findByEmail($username);
        }
        
        // Verifikasi password
        if (!$admin || !$this->adminModel->verifyPassword($password, $admin['password'])) {
            Auth::setFlash('error', 'Username atau password salah.');
            header('Location: ' . BASE_URL . 'admin/login');
            exit;
        }
        
        // Login berhasil
        Auth::login($admin);
        $this->adminModel->updateLastLogin($admin['id']);
        
        Auth::setFlash('success', 'Selamat datang, ' . $admin['nama_lengkap'] . '!');
        header('Location: ' . BASE_URL . 'admin/dashboard');
        exit;
    }
    
    /**
     * Logout
     */
    public function logout() {
        Auth::logout();
        header('Location: ' . BASE_URL . 'admin/login');
        exit;
    }
    
    /**
     * Load view
     */
    private function view($viewPath, $data = []) {
        extract($data);
        require_once VIEW_PATH . '/' . $viewPath . '.php';
    }
}
