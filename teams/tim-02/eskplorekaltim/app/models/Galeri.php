<?php
/**
 * Galeri Model
 * Manage gallery photos for destinations
 */

class Galeri {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Get all photos for a specific destination
     */
    public function getByDestinasi($destinasi_id) {
        $sql = "SELECT * FROM galeri 
                WHERE destinasi_id = :destinasi_id 
                ORDER BY urutan ASC, created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':destinasi_id', $destinasi_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    /**
     * Create new gallery photo
     */
    public function create($data) {
        $sql = "INSERT INTO galeri 
                (destinasi_id, nama_file, caption, urutan) 
                VALUES 
                (:destinasi_id, :nama_file, :caption, :urutan)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':destinasi_id', $data['destinasi_id'], PDO::PARAM_INT);
        $stmt->bindValue(':nama_file', $data['nama_file'], PDO::PARAM_STR);
        $stmt->bindValue(':caption', $data['caption'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':urutan', $data['urutan'] ?? 0, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * Update gallery photo
     */
    public function update($id, $data) {
        $sql = "UPDATE galeri 
                SET caption = :caption, 
                    urutan = :urutan 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':caption', $data['caption'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':urutan', $data['urutan'] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * Delete gallery photo
     */
    public function delete($id) {
        $sql = "DELETE FROM galeri WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * Count photos for a destination
     */
    public function countByDestinasi($destinasi_id) {
        $sql = "SELECT COUNT(*) as total FROM galeri WHERE destinasi_id = :destinasi_id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':destinasi_id', $destinasi_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch();
        return $result['total'];
    }
}
