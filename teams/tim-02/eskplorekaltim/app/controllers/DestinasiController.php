<?php
/**
 * Destinasi Controller
 * Handles destination listing and details
 */

class DestinasiController {
    private $destinasiModel;
    private $kategoriModel;
    
    public function __construct() {
        require_once APP_PATH . '/models/DestinasiDB.php';
        require_once APP_PATH . '/models/KategoriDB.php';
        
        $this->destinasiModel = new DestinasiDB();
        $this->kategoriModel = new KategoriDB();
    }
    
    public function index() {
        $kategoriId = isset($_GET['kategori']) ? (int)$_GET['kategori'] : null;
        $search = isset($_GET['search']) ? trim($_GET['search']) : null;
        
        if ($search) {
            $destinasis = $this->destinasiModel->search($search, 12);
        } elseif ($kategoriId) {
            $destinasis = $this->destinasiModel->getByKategori($kategoriId, 12);
        } else {
            $destinasis = $this->destinasiModel->findAll(12);
        }
        
        $kategoris = $this->kategoriModel->findAll();
        
        $data = [
            'destinasis' => $destinasis,
            'kategoris' => $kategoris,
            'currentKategori' => $kategoriId,
            'searchKeyword' => $search
        ];
        
        $this->view('pages/destinasi', $data);
    }
    
    public function detail($id) {
        $destinasi = $this->destinasiModel->findById($id);
        
        if (!$destinasi) {
            http_response_code(404);
            echo "Destinasi tidak ditemukan";
            return;
        }
        
        // Increment view count
        $this->destinasiModel->incrementViewCount($id);
        
        // Get related data
        $fasilitas = $this->destinasiModel->getFasilitas($id);
        $tips = $this->destinasiModel->getTips($id);
        
        // Get gallery photos
        require_once APP_PATH . '/models/Galeri.php';
        $galeriModel = new Galeri();
        $galeri = $galeriModel->getByDestinasi($id);
        
        // Get related destinations (same category)
        $relatedDestinasi = $this->destinasiModel->getByKategori($destinasi['kategori_id'], 4);
        
        $data = [
            'destinasi' => $destinasi,
            'fasilitas' => $fasilitas,
            'tips' => $tips,
            'galeri' => $galeri,
            'relatedDestinasi' => $relatedDestinasi
        ];
        
        $this->view('pages/detail', $data);
    }
    
    private function view($viewPath, $data = []) {
        extract($data);
        require_once VIEW_PATH . '/' . $viewPath . '.php';
    }
}
