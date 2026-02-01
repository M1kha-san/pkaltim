<?php
/**
 * Home Controller
 * Handles landing page and home functionality
 */

class HomeController {
    private $destinasiModel;
    private $kategoriModel;
    private $artikelModel;
    
    public function __construct() {
        require_once APP_PATH . '/models/DestinasiDB.php';
        require_once APP_PATH . '/models/KategoriDB.php';
        require_once APP_PATH . '/models/ArtikelDB.php';
        
        $this->destinasiModel = new DestinasiDB();
        $this->kategoriModel = new KategoriDB();
        $this->artikelModel = new ArtikelDB();
    }
    
    public function index() {
        // Get featured destinations
        $featuredDestinasi = $this->destinasiModel->getFeatured(6);
        
        // Get all categories with count
        $kategoris = $this->kategoriModel->getAllWithCount();
        
        // Get latest articles
        $artikel = $this->artikelModel->getPublished(3);
        
        // Statistics
        $totalDestinasi = $this->destinasiModel->count();
        $totalKategori = $this->kategoriModel->count();
        
        // Pass data to view
        $data = [
            'featuredDestinasi' => $featuredDestinasi,
            'kategoris' => $kategoris,
            'artikel' => $artikel,
            'stats' => [
                'destinasi' => $totalDestinasi,
                'kategori' => $totalKategori
            ]
        ];
        
        $this->view('pages/home', $data);
    }
    
    private function view($viewPath, $data = []) {
        extract($data);
        require_once VIEW_PATH . '/' . $viewPath . '.php';
    }
}
