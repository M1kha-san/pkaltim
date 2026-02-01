<?php
/**
 * Admin Destinasi Controller
 * Menangani CRUD destinasi di panel admin
 */

class AdminDestinasiController {
    private $destinasiModel;
    private $kategoriModel;
    private $kabupatenModel;
    
    public function __construct() {
        require_once APP_PATH . '/helpers/Auth.php';
        require_once APP_PATH . '/models/DestinasiDB.php';
        require_once APP_PATH . '/models/KategoriDB.php';
        require_once APP_PATH . '/models/KabupatenDB.php';
        
        Auth::requireLogin();
        
        $this->destinasiModel = new DestinasiDB();
        $this->kategoriModel = new KategoriDB();
        $this->kabupatenModel = new KabupatenDB();
    }
    
    /**
     * Daftar semua destinasi
     */
    public function index() {
        $destinasis = $this->destinasiModel->findAll();
        
        $data = [
            'pageTitle' => 'Kelola Destinasi',
            'destinasis' => $destinasis
        ];
        
        $this->view('admin/destinasi/index', $data);
    }
    
    /**
     * Form tambah destinasi
     */
    public function create() {
        $kategoris = $this->kategoriModel->findAll();
        $kabupatens = $this->kabupatenModel->findAll();
        
        $data = [
            'pageTitle' => 'Tambah Destinasi',
            'kategoris' => $kategoris,
            'kabupatens' => $kabupatens,
            'csrf_token' => Auth::generateCsrfToken()
        ];
        
        $this->view('admin/destinasi/create', $data);
    }
    
    /**
     * Simpan destinasi baru
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/destinasi');
            exit;
        }
        
        // Validasi CSRF
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Auth::validateCsrfToken($csrfToken)) {
            Auth::setFlash('error', 'Token keamanan tidak valid.');
            header('Location: ' . BASE_URL . 'admin/destinasi/create');
            exit;
        }
        
        // Validasi input
        $errors = $this->validateInput($_POST);
        if (!empty($errors)) {
            Auth::setFlash('error', implode('<br>', $errors));
            header('Location: ' . BASE_URL . 'admin/destinasi/create');
            exit;
        }
        
        // Handle upload foto
        $fotoUtama = null;
        if (isset($_FILES['foto_utama']) && $_FILES['foto_utama']['error'] === UPLOAD_ERR_OK) {
            $fotoUtama = $this->uploadFoto($_FILES['foto_utama']);
            if ($fotoUtama === false) {
                Auth::setFlash('error', 'Gagal mengunggah foto. Pastikan format dan ukuran file sesuai.');
                header('Location: ' . BASE_URL . 'admin/destinasi/create');
                exit;
            }
        }
        
        // Siapkan data
        $data = [
            'nama' => trim($_POST['nama']),
            'kategori_id' => (int)$_POST['kategori_id'],
            'kabupaten_id' => (int)$_POST['kabupaten_id'],
            'deskripsi' => trim($_POST['deskripsi']),
            'sejarah' => trim($_POST['sejarah'] ?? ''),
            'alamat' => trim($_POST['alamat'] ?? ''),
            'latitude' => !empty($_POST['latitude']) ? (float)$_POST['latitude'] : null,
            'longitude' => !empty($_POST['longitude']) ? (float)$_POST['longitude'] : null,
            'harga_tiket' => trim($_POST['harga_tiket'] ?? ''),
            'jam_operasional' => trim($_POST['jam_operasional'] ?? ''),
            'foto_utama' => $fotoUtama,
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
            'rating' => !empty($_POST['rating']) ? (float)$_POST['rating'] : 0
        ];
        
        // Simpan ke database
        $destinasiId = $this->destinasiModel->create($data);
        
        if ($destinasiId) {
            // Simpan fasilitas jika ada
            if (!empty($_POST['fasilitas'])) {
                $this->saveFasilitas($destinasiId, $_POST['fasilitas']);
            }
            
            // Simpan tips jika ada
            if (!empty($_POST['tips'])) {
                $this->saveTips($destinasiId, $_POST['tips']);
            }
            
            Auth::setFlash('success', 'Destinasi berhasil ditambahkan.');
            header('Location: ' . BASE_URL . 'admin/destinasi');
        } else {
            Auth::setFlash('error', 'Gagal menambahkan destinasi. Silakan coba lagi.');
            header('Location: ' . BASE_URL . 'admin/destinasi/create');
        }
        exit;
    }
    
    /**
     * Form edit destinasi
     */
    public function edit($id) {
        $destinasi = $this->destinasiModel->findById($id);
        
        if (!$destinasi) {
            Auth::setFlash('error', 'Destinasi tidak ditemukan.');
            header('Location: ' . BASE_URL . 'admin/destinasi');
            exit;
        }
        
        $kategoris = $this->kategoriModel->findAll();
        $kabupatens = $this->kabupatenModel->findAll();
        $fasilitas = $this->destinasiModel->getFasilitas($id);
        $tips = $this->destinasiModel->getTips($id);
        
        $data = [
            'pageTitle' => 'Edit Destinasi',
            'destinasi' => $destinasi,
            'kategoris' => $kategoris,
            'kabupatens' => $kabupatens,
            'fasilitas' => $fasilitas,
            'tips' => $tips,
            'csrf_token' => Auth::generateCsrfToken()
        ];
        
        $this->view('admin/destinasi/edit', $data);
    }
    
    /**
     * Update destinasi
     */
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/destinasi');
            exit;
        }
        
        $destinasi = $this->destinasiModel->findById($id);
        if (!$destinasi) {
            Auth::setFlash('error', 'Destinasi tidak ditemukan.');
            header('Location: ' . BASE_URL . 'admin/destinasi');
            exit;
        }
        
        // Validasi CSRF
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Auth::validateCsrfToken($csrfToken)) {
            Auth::setFlash('error', 'Token keamanan tidak valid.');
            header('Location: ' . BASE_URL . 'admin/destinasi/edit/' . $id);
            exit;
        }
        
        // Validasi input
        $errors = $this->validateInput($_POST);
        if (!empty($errors)) {
            Auth::setFlash('error', implode('<br>', $errors));
            header('Location: ' . BASE_URL . 'admin/destinasi/edit/' . $id);
            exit;
        }
        
        // Handle upload foto baru
        $fotoUtama = null;
        if (isset($_FILES['foto_utama']) && $_FILES['foto_utama']['error'] === UPLOAD_ERR_OK) {
            $fotoUtama = $this->uploadFoto($_FILES['foto_utama']);
            if ($fotoUtama === false) {
                Auth::setFlash('error', 'Gagal mengunggah foto.');
                header('Location: ' . BASE_URL . 'admin/destinasi/edit/' . $id);
                exit;
            }
            
            // Hapus foto lama jika ada
            if (!empty($destinasi['foto_utama'])) {
                $oldPath = PUBLIC_PATH . '/images/destinations/' . $destinasi['foto_utama'];
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
        }
        
        // Siapkan data
        $data = [
            'nama' => trim($_POST['nama']),
            'kategori_id' => (int)$_POST['kategori_id'],
            'kabupaten_id' => (int)$_POST['kabupaten_id'],
            'deskripsi' => trim($_POST['deskripsi']),
            'sejarah' => trim($_POST['sejarah'] ?? ''),
            'alamat' => trim($_POST['alamat'] ?? ''),
            'latitude' => !empty($_POST['latitude']) ? (float)$_POST['latitude'] : null,
            'longitude' => !empty($_POST['longitude']) ? (float)$_POST['longitude'] : null,
            'harga_tiket' => trim($_POST['harga_tiket'] ?? ''),
            'jam_operasional' => trim($_POST['jam_operasional'] ?? ''),
            'foto_utama' => $fotoUtama,
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
            'rating' => !empty($_POST['rating']) ? (float)$_POST['rating'] : 0
        ];
        
        // Update database
        if ($this->destinasiModel->update($id, $data)) {
            // Update fasilitas
            $this->destinasiModel->deleteFasilitas($id);
            if (!empty($_POST['fasilitas'])) {
                $this->saveFasilitas($id, $_POST['fasilitas']);
            }
            
            // Update tips
            $this->destinasiModel->deleteTips($id);
            if (!empty($_POST['tips'])) {
                $this->saveTips($id, $_POST['tips']);
            }
            
            Auth::setFlash('success', 'Destinasi berhasil diperbarui.');
            header('Location: ' . BASE_URL . 'admin/destinasi');
        } else {
            Auth::setFlash('error', 'Gagal memperbarui destinasi.');
            header('Location: ' . BASE_URL . 'admin/destinasi/edit/' . $id);
        }
        exit;
    }
    
    /**
     * Hapus destinasi
     */
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/destinasi');
            exit;
        }
        
        // Validasi CSRF
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Auth::validateCsrfToken($csrfToken)) {
            Auth::setFlash('error', 'Token keamanan tidak valid.');
            header('Location: ' . BASE_URL . 'admin/destinasi');
            exit;
        }
        
        if ($this->destinasiModel->delete($id)) {
            Auth::setFlash('success', 'Destinasi berhasil dihapus.');
        } else {
            Auth::setFlash('error', 'Gagal menghapus destinasi.');
        }
        
        header('Location: ' . BASE_URL . 'admin/destinasi');
        exit;
    }
    
    /**
     * Validasi input
     */
    private function validateInput($data) {
        $errors = [];
        
        if (empty($data['nama'])) {
            $errors[] = 'Nama destinasi wajib diisi.';
        }
        
        if (empty($data['kategori_id'])) {
            $errors[] = 'Kategori wajib dipilih.';
        }
        
        if (empty($data['kabupaten_id'])) {
            $errors[] = 'Kabupaten/Kota wajib dipilih.';
        }
        
        if (empty($data['deskripsi'])) {
            $errors[] = 'Deskripsi wajib diisi.';
        }
        
        return $errors;
    }
    
    /**
     * Upload foto destinasi
     */
    private function uploadFoto($file) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB
        
        // Validasi tipe file
        if (!in_array($file['type'], $allowedTypes)) {
            return false;
        }
        
        // Validasi ukuran
        if ($file['size'] > $maxSize) {
            return false;
        }
        
        // Generate nama file unik
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('destinasi_') . '_' . time() . '.' . $extension;
        
        // Pastikan direktori ada
        $uploadDir = PUBLIC_PATH . '/images/destinations/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Pindahkan file
        $destination = $uploadDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $filename;
        }
        
        return false;
    }
    
    /**
     * Simpan fasilitas destinasi
     */
    private function saveFasilitas($destinasiId, $fasilitasData) {
        if (!is_array($fasilitasData)) return;
        
        foreach ($fasilitasData as $fasilitas) {
            if (!empty($fasilitas['nama'])) {
                $this->destinasiModel->addFasilitas($destinasiId, [
                    'nama' => $fasilitas['nama'],
                    'icon' => $fasilitas['icon'] ?? 'fa-check',
                    'tersedia' => isset($fasilitas['tersedia']) ? 1 : 0
                ]);
            }
        }
    }
    
    /**
     * Simpan tips destinasi
     */
    private function saveTips($destinasiId, $tipsData) {
        if (!is_array($tipsData)) return;
        
        $urutan = 1;
        foreach ($tipsData as $tips) {
            if (!empty($tips['judul']) && !empty($tips['konten'])) {
                $this->destinasiModel->addTips($destinasiId, [
                    'judul' => $tips['judul'],
                    'konten' => $tips['konten'],
                    'tipe' => $tips['tipe'] ?? 'tips',
                    'urutan' => $urutan
                ]);
                $urutan++;
            }
        }
    }
    
    /**
     * Load view
     */
    private function view($viewPath, $data = []) {
        $data['user'] = Auth::user();
        $data['flash'] = Auth::getFlash();
        extract($data);
        require_once VIEW_PATH . '/' . $viewPath . '.php';
    }
}
