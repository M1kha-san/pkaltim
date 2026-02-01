<?php
/**
 * DestinasiDB Model
 * Model untuk operasi database tabel destinasi
 */

class DestinasiDB {
    private $db;
    private $table = 'destinasi';
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Ambil semua destinasi dengan join kategori dan kabupaten
     */
    public function findAll($limit = null, $offset = 0) {
        $sql = "SELECT d.*, k.nama as kategori_nama, k.icon as kategori_icon, kb.nama as kabupaten_nama 
                FROM {$this->table} d 
                LEFT JOIN kategori k ON d.kategori_id = k.id 
                LEFT JOIN kabupaten kb ON d.kabupaten_id = kb.id 
                ORDER BY d.created_at DESC";
        
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
     * Ambil destinasi featured
     */
    public function getFeatured($limit = 6) {
        $sql = "SELECT d.*, k.nama as kategori_nama, k.icon as kategori_icon, kb.nama as kabupaten_nama 
                FROM {$this->table} d 
                LEFT JOIN kategori k ON d.kategori_id = k.id 
                LEFT JOIN kabupaten kb ON d.kabupaten_id = kb.id 
                WHERE d.is_featured = 1 
                ORDER BY d.rating DESC 
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Ambil destinasi terbaru
     */
    public function getRecent($limit = 5) {
        $sql = "SELECT d.*, k.nama as kategori_nama, kb.nama as kabupaten_nama 
                FROM {$this->table} d 
                LEFT JOIN kategori k ON d.kategori_id = k.id 
                LEFT JOIN kabupaten kb ON d.kabupaten_id = kb.id 
                ORDER BY d.created_at DESC 
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Ambil destinasi dengan view tertinggi
     */
    public function getTopViewed($limit = 5) {
        $sql = "SELECT d.*, k.nama as kategori_nama, kb.nama as kabupaten_nama 
                FROM {$this->table} d 
                LEFT JOIN kategori k ON d.kategori_id = k.id 
                LEFT JOIN kabupaten kb ON d.kabupaten_id = kb.id 
                ORDER BY d.view_count DESC 
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Cari destinasi berdasarkan ID
     */
    public function findById($id) {
        $sql = "SELECT d.*, k.nama as kategori_nama, k.icon as kategori_icon, kb.nama as kabupaten_nama 
                FROM {$this->table} d 
                LEFT JOIN kategori k ON d.kategori_id = k.id 
                LEFT JOIN kabupaten kb ON d.kabupaten_id = kb.id 
                WHERE d.id = :id LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Ambil destinasi berdasarkan kategori
     */
    public function getByKategori($kategoriId, $limit = 12) {
        $sql = "SELECT d.*, k.nama as kategori_nama, k.icon as kategori_icon, kb.nama as kabupaten_nama 
                FROM {$this->table} d 
                LEFT JOIN kategori k ON d.kategori_id = k.id 
                LEFT JOIN kabupaten kb ON d.kabupaten_id = kb.id 
                WHERE d.kategori_id = :kategori_id 
                ORDER BY d.rating DESC 
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':kategori_id', $kategoriId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Cari destinasi berdasarkan keyword
     */
    public function search($keyword, $limit = 12) {
        $sql = "SELECT d.*, k.nama as kategori_nama, k.icon as kategori_icon, kb.nama as kabupaten_nama 
                FROM {$this->table} d 
                LEFT JOIN kategori k ON d.kategori_id = k.id 
                LEFT JOIN kabupaten kb ON d.kabupaten_id = kb.id 
                WHERE d.nama LIKE :keyword OR d.deskripsi LIKE :keyword2 
                ORDER BY d.rating DESC 
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->bindValue(':keyword2', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Hitung total destinasi
     */
    public function count() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    /**
     * Tambah destinasi baru
     */
    public function create($data) {
        $sql = "INSERT INTO {$this->table} 
                (nama, slug, kategori_id, kabupaten_id, deskripsi, sejarah, alamat, latitude, longitude, harga_tiket, jam_operasional, foto_utama, is_featured, rating) 
                VALUES 
                (:nama, :slug, :kategori_id, :kabupaten_id, :deskripsi, :sejarah, :alamat, :latitude, :longitude, :harga_tiket, :jam_operasional, :foto_utama, :is_featured, :rating)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $this->createSlug($data['nama']), PDO::PARAM_STR);
        $stmt->bindValue(':kategori_id', $data['kategori_id'], PDO::PARAM_INT);
        $stmt->bindValue(':kabupaten_id', $data['kabupaten_id'], PDO::PARAM_INT);
        $stmt->bindValue(':deskripsi', $data['deskripsi'], PDO::PARAM_STR);
        $stmt->bindValue(':sejarah', $data['sejarah'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':alamat', $data['alamat'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':latitude', $data['latitude'] ?? null);
        $stmt->bindValue(':longitude', $data['longitude'] ?? null);
        $stmt->bindValue(':harga_tiket', $data['harga_tiket'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':jam_operasional', $data['jam_operasional'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':foto_utama', $data['foto_utama'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':is_featured', $data['is_featured'] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(':rating', $data['rating'] ?? 0);
        
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    
    /**
     * Update destinasi
     */
    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET 
                nama = :nama, 
                slug = :slug, 
                kategori_id = :kategori_id, 
                kabupaten_id = :kabupaten_id, 
                deskripsi = :deskripsi, 
                sejarah = :sejarah, 
                alamat = :alamat, 
                latitude = :latitude, 
                longitude = :longitude, 
                harga_tiket = :harga_tiket, 
                jam_operasional = :jam_operasional, 
                is_featured = :is_featured, 
                rating = :rating";
        
        // Update foto jika ada
        if (!empty($data['foto_utama'])) {
            $sql .= ", foto_utama = :foto_utama";
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $this->createSlug($data['nama']), PDO::PARAM_STR);
        $stmt->bindValue(':kategori_id', $data['kategori_id'], PDO::PARAM_INT);
        $stmt->bindValue(':kabupaten_id', $data['kabupaten_id'], PDO::PARAM_INT);
        $stmt->bindValue(':deskripsi', $data['deskripsi'], PDO::PARAM_STR);
        $stmt->bindValue(':sejarah', $data['sejarah'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':alamat', $data['alamat'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':latitude', $data['latitude'] ?? null);
        $stmt->bindValue(':longitude', $data['longitude'] ?? null);
        $stmt->bindValue(':harga_tiket', $data['harga_tiket'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':jam_operasional', $data['jam_operasional'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':is_featured', $data['is_featured'] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(':rating', $data['rating'] ?? 0);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        if (!empty($data['foto_utama'])) {
            $stmt->bindValue(':foto_utama', $data['foto_utama'], PDO::PARAM_STR);
        }
        
        return $stmt->execute();
    }
    
    /**
     * Hapus destinasi
     */
    public function delete($id) {
        // Ambil data destinasi dulu untuk menghapus foto
        $destinasi = $this->findById($id);
        
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // Hapus foto jika ada
            if ($destinasi && !empty($destinasi['foto_utama'])) {
                $fotoPath = PUBLIC_PATH . '/images/destinations/' . $destinasi['foto_utama'];
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
     * Ambil fasilitas destinasi
     */
    public function getFasilitas($destinasiId) {
        $sql = "SELECT * FROM fasilitas WHERE destinasi_id = :destinasi_id ORDER BY id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':destinasi_id', $destinasiId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Ambil tips destinasi
     */
    public function getTips($destinasiId) {
        $sql = "SELECT * FROM tips WHERE destinasi_id = :destinasi_id ORDER BY urutan";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':destinasi_id', $destinasiId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
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
    
    /**
     * Tambah fasilitas
     */
    public function addFasilitas($destinasiId, $data) {
        $sql = "INSERT INTO fasilitas (destinasi_id, nama, icon, tersedia) VALUES (:destinasi_id, :nama, :icon, :tersedia)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':destinasi_id', $destinasiId, PDO::PARAM_INT);
        $stmt->bindValue(':nama', $data['nama'], PDO::PARAM_STR);
        $stmt->bindValue(':icon', $data['icon'] ?? 'fa-check', PDO::PARAM_STR);
        $stmt->bindValue(':tersedia', $data['tersedia'] ?? 1, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Hapus semua fasilitas destinasi
     */
    public function deleteFasilitas($destinasiId) {
        $sql = "DELETE FROM fasilitas WHERE destinasi_id = :destinasi_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':destinasi_id', $destinasiId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Tambah tips
     */
    public function addTips($destinasiId, $data) {
        $sql = "INSERT INTO tips (destinasi_id, judul, konten, tipe, urutan) VALUES (:destinasi_id, :judul, :konten, :tipe, :urutan)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':destinasi_id', $destinasiId, PDO::PARAM_INT);
        $stmt->bindValue(':judul', $data['judul'], PDO::PARAM_STR);
        $stmt->bindValue(':konten', $data['konten'], PDO::PARAM_STR);
        $stmt->bindValue(':tipe', $data['tipe'] ?? 'tips', PDO::PARAM_STR);
        $stmt->bindValue(':urutan', $data['urutan'] ?? 0, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * Hapus semua tips destinasi
     */
    public function deleteTips($destinasiId) {
        $sql = "DELETE FROM tips WHERE destinasi_id = :destinasi_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':destinasi_id', $destinasiId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
