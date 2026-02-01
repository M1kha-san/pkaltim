<?php
/**
 * Admin Kategori Controller
 * Menangani operasi kategori di admin panel
 */

class AdminKategoriController {
    private $kategoriModel;
    
    public function __construct() {
        require_once APP_PATH . '/helpers/Auth.php';
        require_once APP_PATH . '/models/KategoriDB.php';
        
        // Cek login
        Auth::requireLogin();
        
        $this->kategoriModel = new KategoriDB();
    }
    
    /**
     * Daftar semua kategori
     */
    public function index() {
        $kategoris = $this->kategoriModel->getAllWithCount();
        
        $data = [
            'pageTitle' => 'Kelola Kategori',
            'kategoris' => $kategoris
        ];
        
        $this->view('admin/kategori/index', $data);
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
