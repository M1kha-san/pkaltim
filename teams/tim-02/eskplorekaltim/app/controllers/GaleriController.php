<?php

class GaleriController {
    private $galeriModel;
    private $destinasiModel;
    
    public function __construct() {
        require_once APP_PATH . '/models/Galeri.php';
        require_once APP_PATH . '/models/DestinasiDB.php';
        $this->galeriModel = new Galeri();
        $this->destinasiModel = new DestinasiDB();
    }
    
    public function index() {
        // Get all destinations with photos
        $destinations = $this->destinasiModel->findAll();
        
        // Get gallery photos for each destination
        $galeriData = [];
        foreach ($destinations as $destinasi) {
            $photos = $this->galeriModel->getByDestinasi($destinasi['id']);
            if (!empty($photos)) {
                $galeriData[] = [
                    'destinasi' => $destinasi,
                    'photos' => $photos
                ];
            }
        }
        
        // Prepare data for view
        $data = [
            'title' => 'Galeri Wisata - ' . APP_NAME,
            'galeriData' => $galeriData
        ];
        
        // Load view
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/layouts/navbar.php';
        require_once APP_PATH . '/views/pages/galeri.php';
        require_once APP_PATH . '/views/layouts/footer.php';
    }
}
