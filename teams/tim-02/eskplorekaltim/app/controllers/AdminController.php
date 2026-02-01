<?php
/**
 * Admin Controller
 * Menangani dashboard dan operasi admin utama
 */

class AdminController {
    private $destinasiModel;
    private $kategoriModel;
    private $artikelModel;
    private $userModel;
    
    public function __construct() {
        require_once APP_PATH . '/helpers/Auth.php';
        require_once APP_PATH . '/models/DestinasiDB.php';
        require_once APP_PATH . '/models/KategoriDB.php';
        require_once APP_PATH . '/models/ArtikelDB.php';
        require_once APP_PATH . '/models/Admin.php';
        
        // Cek login untuk semua method
        Auth::requireLogin();
        
        $this->destinasiModel = new DestinasiDB();
        $this->kategoriModel = new KategoriDB();
        $this->artikelModel = new ArtikelDB();
        $this->userModel = new Admin();
    }
    
    /**
     * Dashboard
     */
    public function dashboard() {
        $totalDestinasi = $this->destinasiModel->count();
        $totalKategori = $this->kategoriModel->count();
        $totalArtikel = $this->artikelModel->count();
        
        // Statistik users (hanya untuk admin)
        $currentUser = Auth::user();
        $totalAdmin = 0;
        $totalPenulis = 0;
        
        if ($currentUser['role'] === 'admin') {
            $totalAdmin = $this->userModel->countByRole('admin');
            $totalPenulis = $this->userModel->countByRole('penulis');
        }
        
        $recentDestinasi = $this->destinasiModel->getRecent(5);
        $recentArtikel = $this->artikelModel->getRecent(5);
        $topDestinasi = $this->destinasiModel->getTopViewed(5);
        
        $data = [
            'pageTitle' => 'Dashboard',
            'stats' => [
                'destinasi' => $totalDestinasi,
                'kategori' => $totalKategori,
                'artikel' => $totalArtikel,
                'admin' => $totalAdmin,
                'penulis' => $totalPenulis
            ],
            'recentDestinasi' => $recentDestinasi,
            'recentArtikel' => $recentArtikel,
            'topDestinasi' => $topDestinasi,
            'user' => $currentUser
        ];
        
        $this->view('admin/dashboard', $data);
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
