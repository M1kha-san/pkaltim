<?php

class AdminTranslationController {
    private $db;
    
    public function __construct() {
        // Check authentication
        require_once APP_PATH . '/helpers/Auth.php';
        if (!Auth::check()) {
            header('Location: ' . BASE_URL . 'admin/login');
            exit;
        }
        
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Display list of all translations
     */
    public function index() {
        $user = Auth::user();
        
        // Get filter params
        $lang_code = isset($_GET['lang']) ? $_GET['lang'] : '';
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        
        // Build query
        $sql = "SELECT * FROM translations WHERE 1=1";
        $params = [];
        
        if ($lang_code) {
            $sql .= " AND lang_code = :lang_code";
            $params[':lang_code'] = $lang_code;
        }
        
        if ($search) {
            $sql .= " AND (translation_key LIKE :search OR translation_value LIKE :search)";
            $params[':search'] = "%$search%";
        }
        
        $sql .= " ORDER BY lang_code, translation_key";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $translations = $stmt->fetchAll();
        
        // Count by language
        $stmt = $this->db->query("SELECT lang_code, COUNT(*) as total FROM translations GROUP BY lang_code");
        $stats = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        
        $data = [
            'title' => 'Kelola Translations - Admin',
            'user' => $user,
            'translations' => $translations,
            'stats' => $stats,
            'filter_lang' => $lang_code,
            'filter_search' => $search
        ];
        
        extract($data);
        
        include VIEW_PATH . '/admin/layouts/header.php';
        include VIEW_PATH . '/admin/layouts/sidebar.php';
        include VIEW_PATH . '/admin/translations/index.php';
        include VIEW_PATH . '/admin/layouts/footer.php';
    }
    
    /**
     * Show create form
     */
    public function create() {
        $user = Auth::user();
        
        $data = [
            'title' => 'Tambah Translation - Admin',
            'user' => $user
        ];
        
        extract($data);
        
        include VIEW_PATH . '/admin/layouts/header.php';
        include VIEW_PATH . '/admin/layouts/sidebar.php';
        include VIEW_PATH . '/admin/translations/create.php';
        include VIEW_PATH . '/admin/layouts/footer.php';
    }
    
    /**
     * Store new translation
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/translations');
            exit;
        }
        
        $lang_code = $_POST['lang_code'] ?? '';
        $translation_key = $_POST['translation_key'] ?? '';
        $translation_value = $_POST['translation_value'] ?? '';
        
        // Validation
        if (empty($lang_code) || empty($translation_key) || empty($translation_value)) {
            $_SESSION['error'] = 'Semua field wajib diisi!';
            header('Location: ' . BASE_URL . 'admin/translations/create');
            exit;
        }
        
        // Check duplicate
        $stmt = $this->db->prepare("SELECT id FROM translations WHERE lang_code = ? AND translation_key = ?");
        $stmt->execute([$lang_code, $translation_key]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = 'Translation key sudah ada untuk bahasa ini!';
            header('Location: ' . BASE_URL . 'admin/translations/create');
            exit;
        }
        
        // Insert
        $sql = "INSERT INTO translations (lang_code, translation_key, translation_value) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt->execute([$lang_code, $translation_key, $translation_value])) {
            $_SESSION['success'] = 'Translation berhasil ditambahkan!';
        } else {
            $_SESSION['error'] = 'Gagal menambahkan translation!';
        }
        
        header('Location: ' . BASE_URL . 'admin/translations');
        exit;
    }
    
    /**
     * Show edit form
     */
    public function edit($id) {
        $user = Auth::user();
        
        $stmt = $this->db->prepare("SELECT * FROM translations WHERE id = ?");
        $stmt->execute([$id]);
        $translation = $stmt->fetch();
        
        if (!$translation) {
            $_SESSION['error'] = 'Translation tidak ditemukan!';
            header('Location: ' . BASE_URL . 'admin/translations');
            exit;
        }
        
        $data = [
            'title' => 'Edit Translation - Admin',
            'user' => $user,
            'translation' => $translation
        ];
        
        extract($data);
        
        include VIEW_PATH . '/admin/layouts/header.php';
        include VIEW_PATH . '/admin/layouts/sidebar.php';
        include VIEW_PATH . '/admin/translations/edit.php';
        include VIEW_PATH . '/admin/layouts/footer.php';
    }
    
    /**
     * Update translation
     */
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/translations');
            exit;
        }
        
        $translation_value = $_POST['translation_value'] ?? '';
        
        // Validation
        if (empty($translation_value)) {
            $_SESSION['error'] = 'Translation value wajib diisi!';
            header('Location: ' . BASE_URL . 'admin/translations/edit/' . $id);
            exit;
        }
        
        // Update
        $sql = "UPDATE translations SET translation_value = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt->execute([$translation_value, $id])) {
            $_SESSION['success'] = 'Translation berhasil diupdate!';
        } else {
            $_SESSION['error'] = 'Gagal mengupdate translation!';
        }
        
        header('Location: ' . BASE_URL . 'admin/translations');
        exit;
    }
    
    /**
     * Delete translation
     */
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/translations');
            exit;
        }
        
        $stmt = $this->db->prepare("DELETE FROM translations WHERE id = ?");
        
        if ($stmt->execute([$id])) {
            $_SESSION['success'] = 'Translation berhasil dihapus!';
        } else {
            $_SESSION['error'] = 'Gagal menghapus translation!';
        }
        
        header('Location: ' . BASE_URL . 'admin/translations');
        exit;
    }
}
