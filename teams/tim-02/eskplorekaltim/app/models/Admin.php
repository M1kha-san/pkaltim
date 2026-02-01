<?php
/**
 * User Model (Admin & Penulis)
 * Menangani operasi database untuk tabel users
 */

class Admin {
    private $db;
    private $table = 'users';
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Cari user berdasarkan username
     */
    public function findByUsername($username) {
        $sql = "SELECT * FROM {$this->table} WHERE username = :username AND is_active = 1 LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Cari user berdasarkan email
     */
    public function findByEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email AND is_active = 1 LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Cari user berdasarkan ID
     */
    public function findById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Verifikasi password
     */
    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }
    
    /**
     * Update waktu login terakhir
     */
    public function updateLastLogin($id) {
        $sql = "UPDATE {$this->table} SET last_login = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Ambil semua users
     */
    public function findAll() {
        $sql = "SELECT id, username, email, nama_lengkap, role, is_active, last_login, created_at FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
    
    /**
     * Ambil users berdasarkan role
     */
    public function findByRole($role) {
        $sql = "SELECT id, username, email, nama_lengkap, role, is_active, last_login, created_at 
                FROM {$this->table} WHERE role = :role ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':role', $role, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Hitung total users berdasarkan role
     */
    public function countByRole($role) {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE role = :role";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':role', $role, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    /**
     * Tambah user baru
     */
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (username, email, password, nama_lengkap, role) 
                VALUES (:username, :email, :password, :nama_lengkap, :role)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':username', $data['username'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':password', password_hash($data['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindValue(':nama_lengkap', $data['nama_lengkap'], PDO::PARAM_STR);
        $stmt->bindValue(':role', $data['role'] ?? 'penulis', PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    /**
     * Update user
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET 
                username = :username, 
                email = :email, 
                nama_lengkap = :nama_lengkap, 
                role = :role, 
                is_active = :is_active";
        
        // Update password jika diisi
        if (!empty($data['password'])) {
            $sql .= ", password = :password";
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':username', $data['username'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':nama_lengkap', $data['nama_lengkap'], PDO::PARAM_STR);
        $stmt->bindValue(':role', $data['role'], PDO::PARAM_STR);
        $stmt->bindValue(':is_active', $data['is_active'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        if (!empty($data['password'])) {
            $stmt->bindValue(':password', password_hash($data['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        }
        
        return $stmt->execute();
    }
    
    /**
     * Update profil user
     */
    public function updateProfile($id, $data) {
        $sql = "UPDATE {$this->table} SET nama_lengkap = :nama_lengkap, email = :email WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nama_lengkap', $data['nama_lengkap'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Update password
     */
    public function updatePassword($id, $newPassword) {
        $sql = "UPDATE {$this->table} SET password = :password WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':password', password_hash($newPassword, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Hapus user
     */
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Toggle active status
     */
    public function toggleActive($id) {
        $sql = "UPDATE {$this->table} SET is_active = NOT is_active WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
