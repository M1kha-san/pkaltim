<?php
/**
 * ArtikelDB Model
 * Model untuk operasi database tabel artikel
 */

class ArtikelDB {
    private $db;
    private $table = 'artikel';
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Ambil semua artikel
     */
    public function findAll($limit = null, $offset = 0) {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT :limit OFFSET :offset";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        } else {
            $stmt = $this->db->prepare($sql);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Ambil artikel yang dipublikasi
     */
    public function getPublished($limit = 6) {
        $sql = "SELECT * FROM {$this->table} WHERE is_published = 1 ORDER BY published_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Ambil artikel terbaru
     */
    public function getRecent($limit = 5) {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Cari artikel berdasarkan ID
     */
    public function findById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Cari artikel berdasarkan slug
     */
    public function findBySlug($slug) {
        $sql = "SELECT * FROM {$this->table} WHERE slug = :slug LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Hitung total artikel
     */
    public function count() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    /**
     * Tambah artikel baru
     */
    public function create($data) {
        $sql = "INSERT INTO {$this->table} 
                (judul, slug, konten, excerpt, foto_thumbnail, kategori_artikel, is_published, published_at) 
                VALUES 
                (:judul, :slug, :konten, :excerpt, :foto_thumbnail, :kategori_artikel, :is_published, :published_at)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':judul', $data['judul'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $this->createSlug($data['judul']), PDO::PARAM_STR);
        $stmt->bindValue(':konten', $data['konten'], PDO::PARAM_STR);
        $stmt->bindValue(':excerpt', $data['excerpt'] ?? $this->createExcerpt($data['konten']), PDO::PARAM_STR);
        $stmt->bindValue(':foto_thumbnail', $data['foto_thumbnail'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':kategori_artikel', $data['kategori_artikel'] ?? 'Umum', PDO::PARAM_STR);
        $stmt->bindValue(':is_published', $data['is_published'] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(':published_at', $data['is_published'] ? date('Y-m-d H:i:s') : null);
        
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    
    /**
     * Update artikel
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET 
                judul = :judul, 
                slug = :slug, 
                konten = :konten, 
                excerpt = :excerpt, 
                kategori_artikel = :kategori_artikel, 
                is_published = :is_published";
        
        // Update foto jika ada
        if (!empty($data['foto_thumbnail'])) {
            $sql .= ", foto_thumbnail = :foto_thumbnail";
        }
        
        // Update published_at jika status berubah
        if (!empty($data['is_published'])) {
            $sql .= ", published_at = COALESCE(published_at, NOW())";
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':judul', $data['judul'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $this->createSlug($data['judul']), PDO::PARAM_STR);
        $stmt->bindValue(':konten', $data['konten'], PDO::PARAM_STR);
        $stmt->bindValue(':excerpt', $data['excerpt'] ?? $this->createExcerpt($data['konten']), PDO::PARAM_STR);
        $stmt->bindValue(':kategori_artikel', $data['kategori_artikel'] ?? 'Umum', PDO::PARAM_STR);
        $stmt->bindValue(':is_published', $data['is_published'] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        if (!empty($data['foto_thumbnail'])) {
            $stmt->bindValue(':foto_thumbnail', $data['foto_thumbnail'], PDO::PARAM_STR);
        }
        
        return $stmt->execute();
    }
    
    /**
     * Hapus artikel
     */
    public function delete($id) {
        // Ambil data artikel dulu untuk menghapus foto
        $artikel = $this->findById($id);
        
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // Hapus foto jika ada
            if ($artikel && !empty($artikel['foto_thumbnail'])) {
                $fotoPath = PUBLIC_PATH . '/images/artikel/' . $artikel['foto_thumbnail'];
                if (file_exists($fotoPath)) {
                    unlink($fotoPath);
                }
            }
            return true;
        }
        return false;
    }
    
    /**
     * Increment view count
     */
    public function incrementViewCount($id) {
        $sql = "UPDATE {$this->table} SET view_count = view_count + 1 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Buat slug dari judul
     */
    private function createSlug($string) {
        $slug = strtolower(trim($string));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }
    
    /**
     * Buat excerpt dari konten
     */
    private function createExcerpt($content, $length = 150) {
        $content = strip_tags($content);
        if (strlen($content) <= $length) {
            return $content;
        }
        return substr($content, 0, $length) . '...';
    }
}
