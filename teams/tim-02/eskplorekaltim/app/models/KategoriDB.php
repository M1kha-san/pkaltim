<?php
/**
 * KategoriDB Model
 * Model untuk operasi database tabel kategori
 */

class KategoriDB {
    private $db;
    private $table = 'kategori';
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Ambil semua kategori
     */
    public function findAll($limit = null, $offset = 0) {
        $sql = "SELECT * FROM {$this->table} ORDER BY nama ASC";
        
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
     * Ambil semua kategori dengan jumlah destinasi
     */
    public function getAllWithCount() {
        $sql = "SELECT k.*, COUNT(d.id) as jumlah_destinasi 
                FROM {$this->table} k 
                LEFT JOIN destinasi d ON k.id = d.kategori_id 
                GROUP BY k.id 
                ORDER BY k.nama ASC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
    
    /**
     * Cari kategori berdasarkan ID
     */
    public function findById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Hitung total kategori
     */
    public function count() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    /**
     * Tambah kategori baru
     */
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (nama, slug, deskripsi, icon) VALUES (:nama, :slug, :deskripsi, :icon)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $this->createSlug($data['nama']), PDO::PARAM_STR);
        $stmt->bindValue(':deskripsi', $data['deskripsi'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':icon', $data['icon'] ?? 'fa-map-marker', PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    
    /**
     * Update kategori
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET nama = :nama, slug = :slug, deskripsi = :deskripsi, icon = :icon WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $this->createSlug($data['nama']), PDO::PARAM_STR);
        $stmt->bindValue(':deskripsi', $data['deskripsi'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':icon', $data['icon'] ?? 'fa-map-marker', PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Hapus kategori
     */
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Buat slug dari nama
     */
    private function createSlug($string) {
        $slug = strtolower(trim($string));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }
}
