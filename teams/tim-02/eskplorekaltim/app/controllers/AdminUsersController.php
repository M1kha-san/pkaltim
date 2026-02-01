<?php
/**
 * Admin Users Controller
 * Menangani manajemen users (admin & penulis)
 */

class AdminUsersController {
    private $userModel;
    
    public function __construct() {
        require_once APP_PATH . '/helpers/Auth.php';
        require_once APP_PATH . '/models/Admin.php';
        
        // Cek login dan harus admin
        Auth::requireLogin();
        
        $currentUser = Auth::user();
        if ($currentUser['role'] !== 'admin') {
            Auth::setFlash('error', 'Anda tidak memiliki akses ke halaman ini.');
            header('Location: ' . BASE_URL . 'admin/dashboard');
            exit;
        }
        
        $this->userModel = new Admin();
    }
    
    /**
     * Daftar semua users
     */
    public function index() {
        $users = $this->userModel->findAll();
        
        $data = [
            'pageTitle' => 'Kelola Penulis',
            'users' => $users
        ];
        
        $this->view('admin/users/index', $data);
    }
    
    /**
     * Form tambah user
     */
    public function create() {
        $data = [
            'pageTitle' => 'Tambah User'
        ];
        
        $this->view('admin/users/create', $data);
    }
    
    /**
     * Proses tambah user
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/users');
            exit;
        }
        
        // Validasi CSRF
        if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            Auth::setFlash('error', 'Token keamanan tidak valid.');
            header('Location: ' . BASE_URL . 'admin/users/create');
            exit;
        }
        
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
        $role = $_POST['role'] ?? 'penulis';
        
        // Validasi
        if (empty($username) || empty($email) || empty($password) || empty($nama_lengkap)) {
            Auth::setFlash('error', 'Semua field wajib diisi.');
            header('Location: ' . BASE_URL . 'admin/users/create');
            exit;
        }
        
        if (strlen($password) < 6) {
            Auth::setFlash('error', 'Password minimal 6 karakter.');
            header('Location: ' . BASE_URL . 'admin/users/create');
            exit;
        }
        
        // Cek username/email sudah ada
        if ($this->userModel->findByUsername($username)) {
            Auth::setFlash('error', 'Username sudah digunakan.');
            header('Location: ' . BASE_URL . 'admin/users/create');
            exit;
        }
        
        if ($this->userModel->findByEmail($email)) {
            Auth::setFlash('error', 'Email sudah digunakan.');
            header('Location: ' . BASE_URL . 'admin/users/create');
            exit;
        }
        
        // Simpan
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'nama_lengkap' => $nama_lengkap,
            'role' => $role
        ];
        
        if ($this->userModel->create($data)) {
            Auth::setFlash('success', 'User berhasil ditambahkan.');
            header('Location: ' . BASE_URL . 'admin/users');
        } else {
            Auth::setFlash('error', 'Gagal menambahkan user.');
            header('Location: ' . BASE_URL . 'admin/users/create');
        }
        exit;
    }
    
    /**
     * Form edit user
     */
    public function edit($id) {
        $userItem = $this->userModel->findById($id);
        
        if (!$userItem) {
            Auth::setFlash('error', 'User tidak ditemukan.');
            header('Location: ' . BASE_URL . 'admin/users');
            exit;
        }
        
        $data = [
            'pageTitle' => 'Edit User',
            'userItem' => $userItem
        ];
        
        $this->view('admin/users/edit', $data);
    }
    
    /**
     * Proses update user
     */
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/users');
            exit;
        }
        
        // Validasi CSRF
        if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            Auth::setFlash('error', 'Token keamanan tidak valid.');
            header('Location: ' . BASE_URL . 'admin/users/edit/' . $id);
            exit;
        }
        
        $userItem = $this->userModel->findById($id);
        if (!$userItem) {
            Auth::setFlash('error', 'User tidak ditemukan.');
            header('Location: ' . BASE_URL . 'admin/users');
            exit;
        }
        
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
        $role = $_POST['role'] ?? 'penulis';
        $is_active = isset($_POST['is_active']) ? 1 : 0;
        
        // Validasi
        if (empty($username) || empty($email) || empty($nama_lengkap)) {
            Auth::setFlash('error', 'Username, email, dan nama lengkap wajib diisi.');
            header('Location: ' . BASE_URL . 'admin/users/edit/' . $id);
            exit;
        }
        
        // Cek username sudah digunakan user lain
        $existingUser = $this->userModel->findByUsername($username);
        if ($existingUser && $existingUser['id'] != $id) {
            Auth::setFlash('error', 'Username sudah digunakan.');
            header('Location: ' . BASE_URL . 'admin/users/edit/' . $id);
            exit;
        }
        
        // Cek email sudah digunakan user lain
        $existingUser = $this->userModel->findByEmail($email);
        if ($existingUser && $existingUser['id'] != $id) {
            Auth::setFlash('error', 'Email sudah digunakan.');
            header('Location: ' . BASE_URL . 'admin/users/edit/' . $id);
            exit;
        }
        
        // Update
        $data = [
            'username' => $username,
            'email' => $email,
            'nama_lengkap' => $nama_lengkap,
            'role' => $role,
            'is_active' => $is_active
        ];
        
        // Jika password diisi, tambahkan
        if (!empty($password)) {
            if (strlen($password) < 6) {
                Auth::setFlash('error', 'Password minimal 6 karakter.');
                header('Location: ' . BASE_URL . 'admin/users/edit/' . $id);
                exit;
            }
            $data['password'] = $password;
        }
        
        if ($this->userModel->update($id, $data)) {
            Auth::setFlash('success', 'User berhasil diupdate.');
            header('Location: ' . BASE_URL . 'admin/users');
        } else {
            Auth::setFlash('error', 'Gagal mengupdate user.');
            header('Location: ' . BASE_URL . 'admin/users/edit/' . $id);
        }
        exit;
    }
    
    /**
     * Hapus user
     */
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/users');
            exit;
        }
        
        // Validasi CSRF
        if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            Auth::setFlash('error', 'Token keamanan tidak valid.');
            header('Location: ' . BASE_URL . 'admin/users');
            exit;
        }
        
        // Cek apakah user yang login mencoba hapus dirinya sendiri
        if (Auth::id() == $id) {
            Auth::setFlash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            header('Location: ' . BASE_URL . 'admin/users');
            exit;
        }
        
        if ($this->userModel->delete($id)) {
            Auth::setFlash('success', 'User berhasil dihapus.');
        } else {
            Auth::setFlash('error', 'Gagal menghapus user.');
        }
        
        header('Location: ' . BASE_URL . 'admin/users');
        exit;
    }
    
    /**
     * Load view dengan layout admin
     */
    private function view($viewPath, $data = []) {
        $data['user'] = Auth::user();
        $data['flash'] = Auth::getFlash();
        extract($data);
        require_once VIEW_PATH . '/' . $viewPath . '.php';
    }
}
