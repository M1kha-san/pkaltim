<?php
/**
 * Artikel Controller
 * Handles articles and tips
 */

class ArtikelController {
    private $artikelModel;
    
    public function __construct() {
        require_once APP_PATH . '/models/ArtikelDB.php';
        $this->artikelModel = new ArtikelDB();
    }
    
    public function index() {
        $artikel = $this->artikelModel->getPublished(12);
        
        $data = [
            'artikel' => $artikel
        ];
        
        $this->view('pages/artikel', $data);
    }
    
    private function view($viewPath, $data = []) {
        extract($data);
        require_once VIEW_PATH . '/' . $viewPath . '.php';
    }
}
