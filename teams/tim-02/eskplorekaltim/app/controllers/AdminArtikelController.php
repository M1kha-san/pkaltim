<?php
/**
 * Admin Artikel Controller
 * Menangani CRUD artikel di admin panel
 */

require_once APP_PATH . '/helpers/Auth.php';
require_once APP_PATH . '/models/ArtikelDB.php';

class AdminArtikelController
{
    private $artikelModel;
    
    public function __construct()
    {
        // Cek apakah user sudah login
        Auth::requireLogin();
        $this->artikelModel = new ArtikelDB();
    }
    
    /**
     * Menampilkan daftar artikel
     */
    public function index()
    {
        $artikel = $this->artikelModel->findAll();
        
        require_once VIEW_PATH . '/admin/artikel/index.php';
    }
    
    /**
     * Form tambah artikel baru
     */
    public function create()
    {
        $artikel = [
            'judul' => '',
            'konten' => '',
            'excerpt' => '',
            'foto_thumbnail' => '',
            'kategori_artikel' => 'Umum',
            'is_published' => 0
        ];
        
        require_once VIEW_PATH . '/admin/artikel/create.php';
    }
    
    /**
     * Proses simpan artikel baru
     */
    public function store()
    {
        // Validasi CSRF
        if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            Auth::setFlash('error', 'Token keamanan tidak valid. Silakan coba lagi.');
            header('Location: ' . BASE_URL . '/admin/artikel/create');
            exit;
        }
        
        // Validasi input
        $errors = $this->validateInput($_POST);
        
        if (!empty($errors)) {
            Auth::setFlash('error', implode('<br>', $errors));
            header('Location: ' . BASE_URL . '/admin/artikel/create');
            exit;
        }
        
        // Handle upload gambar
        $foto_thumbnail = null;
        if (isset($_FILES['foto_thumbnail']) && $_FILES['foto_thumbnail']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->uploadImage($_FILES['foto_thumbnail']);
            if ($uploadResult['success']) {
                $foto_thumbnail = $uploadResult['filename'];
            } else {
                Auth::setFlash('error', $uploadResult['message']);
                header('Location: ' . BASE_URL . '/admin/artikel/create');
                exit;
            }
        }
        
        // Data artikel
        $is_published = isset($_POST['is_published']) ? 1 : 0;
        $data = [
            'judul' => trim($_POST['judul']),
            'konten' => $_POST['konten'],
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'foto_thumbnail' => $foto_thumbnail,
            'kategori_artikel' => $_POST['kategori_artikel'] ?? 'Umum',
            'is_published' => $is_published
        ];
        
        $result = $this->artikelModel->create($data);
        
        if ($result) {
            Auth::setFlash('success', 'Artikel berhasil ditambahkan!');
            header('Location: ' . BASE_URL . '/admin/artikel');
        } else {
            Auth::setFlash('error', 'Gagal menambahkan artikel. Silakan coba lagi.');
            header('Location: ' . BASE_URL . '/admin/artikel/create');
        }
        exit;
    }
    
    /**
     * Form edit artikel
     */
    public function edit($id)
    {
        $artikel = $this->artikelModel->findById($id);
        
        if (!$artikel) {
            Auth::setFlash('error', 'Artikel tidak ditemukan.');
            header('Location: ' . BASE_URL . '/admin/artikel');
            exit;
        }
        
        require_once VIEW_PATH . '/admin/artikel/edit.php';
    }
    
    /**
     * Proses update artikel
     */
    public function update($id)
    {
        // Validasi CSRF
        if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            Auth::setFlash('error', 'Token keamanan tidak valid. Silakan coba lagi.');
            header('Location: ' . BASE_URL . '/admin/artikel/edit/' . $id);
            exit;
        }
        
        $artikel = $this->artikelModel->findById($id);
        
        if (!$artikel) {
            Auth::setFlash('error', 'Artikel tidak ditemukan.');
            header('Location: ' . BASE_URL . '/admin/artikel');
            exit;
        }
        
        // Validasi input
        $errors = $this->validateInput($_POST);
        
        if (!empty($errors)) {
            Auth::setFlash('error', implode('<br>', $errors));
            header('Location: ' . BASE_URL . '/admin/artikel/edit/' . $id);
            exit;
        }
        
        // Handle upload gambar baru
        $foto_thumbnail = null;
        if (isset($_FILES['foto_thumbnail']) && $_FILES['foto_thumbnail']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->uploadImage($_FILES['foto_thumbnail']);
            if ($uploadResult['success']) {
                // Hapus gambar lama jika ada
                if (!empty($artikel['foto_thumbnail'])) {
                    $oldImagePath = PUBLIC_PATH . '/images/artikel/' . $artikel['foto_thumbnail'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $foto_thumbnail = $uploadResult['filename'];
            } else {
                Auth::setFlash('error', $uploadResult['message']);
                header('Location: ' . BASE_URL . '/admin/artikel/edit/' . $id);
                exit;
            }
        }
        
        // Data artikel
        $is_published = isset($_POST['is_published']) ? 1 : 0;
        $data = [
            'judul' => trim($_POST['judul']),
            'konten' => $_POST['konten'],
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'kategori_artikel' => $_POST['kategori_artikel'] ?? 'Umum',
            'is_published' => $is_published
        ];
        
        // Tambahkan foto jika ada
        if ($foto_thumbnail) {
            $data['foto_thumbnail'] = $foto_thumbnail;
        }
        
        $result = $this->artikelModel->update($id, $data);
        
        if ($result) {
            Auth::setFlash('success', 'Artikel berhasil diperbarui!');
            header('Location: ' . BASE_URL . '/admin/artikel');
        } else {
            Auth::setFlash('error', 'Gagal memperbarui artikel. Silakan coba lagi.');
            header('Location: ' . BASE_URL . '/admin/artikel/edit/' . $id);
        }
        exit;
    }
    
    /**
     * Proses hapus artikel
     */
    public function delete($id)
    {
        // Validasi CSRF
        if (!Auth::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            Auth::setFlash('error', 'Token keamanan tidak valid. Silakan coba lagi.');
            header('Location: ' . BASE_URL . '/admin/artikel');
            exit;
        }
        
        $artikel = $this->artikelModel->findById($id);
        
        if (!$artikel) {
            Auth::setFlash('error', 'Artikel tidak ditemukan.');
            header('Location: ' . BASE_URL . '/admin/artikel');
            exit;
        }
        
        $result = $this->artikelModel->delete($id);
        
        if ($result) {
            Auth::setFlash('success', 'Artikel berhasil dihapus!');
        } else {
            Auth::setFlash('error', 'Gagal menghapus artikel.');
        }
        
        header('Location: ' . BASE_URL . '/admin/artikel');
        exit;
    }
    
    /**
     * Validasi input
     */
    private function validateInput($data)
    {
        $errors = [];
        
        if (empty(trim($data['judul'] ?? ''))) {
            $errors[] = 'Judul artikel wajib diisi.';
        } elseif (strlen(trim($data['judul'])) < 5) {
            $errors[] = 'Judul artikel minimal 5 karakter.';
        }
        
        if (empty(trim($data['konten'] ?? ''))) {
            $errors[] = 'Konten artikel wajib diisi.';
        } elseif (strlen(trim($data['konten'])) < 50) {
            $errors[] = 'Konten artikel minimal 50 karakter.';
        }
        
        return $errors;
    }
    
    /**
     * Upload gambar artikel
     */
    private function uploadImage($file)
    {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        $maxSize = 2 * 1024 * 1024; // 2MB
        
        // Validasi tipe file
        if (!in_array($file['type'], $allowedTypes)) {
            return [
                'success' => false,
                'message' => 'Format file tidak didukung. Gunakan JPG, PNG, atau WebP.'
            ];
        }
        
        // Validasi ukuran
        if ($file['size'] > $maxSize) {
            return [
                'success' => false,
                'message' => 'Ukuran file terlalu besar. Maksimal 2MB.'
            ];
        }
        
        // Buat direktori jika belum ada
        $uploadDir = PUBLIC_PATH . '/images/artikel/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Generate nama file unik
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'artikel_' . time() . '_' . uniqid() . '.' . $extension;
        $targetPath = $uploadDir . $filename;
        
        // Upload file
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return [
                'success' => true,
                'filename' => $filename
            ];
        }
        
        return [
            'success' => false,
            'message' => 'Gagal mengupload gambar. Silakan coba lagi.'
        ];
    }
}
