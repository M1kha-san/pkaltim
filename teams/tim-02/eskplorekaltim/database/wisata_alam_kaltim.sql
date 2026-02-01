-- Database: wisata_alam_kaltim
-- Sistem Informasi Wisata Alam Kalimantan Timur

CREATE DATABASE IF NOT EXISTS wisata_alam_kaltim CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wisata_alam_kaltim;

-- Tabel Kategori Wisata
CREATE TABLE IF NOT EXISTS kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    deskripsi TEXT,
    icon VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel Kabupaten/Kota
CREATE TABLE IF NOT EXISTS kabupaten (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    provinsi VARCHAR(100) DEFAULT 'Kalimantan Timur',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel Destinasi Wisata
CREATE TABLE IF NOT EXISTS destinasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    kategori_id INT NOT NULL,
    kabupaten_id INT NOT NULL,
    deskripsi TEXT NOT NULL,
    sejarah TEXT,
    alamat VARCHAR(255),
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    harga_tiket VARCHAR(100),
    jam_operasional VARCHAR(100),
    foto_utama VARCHAR(255),
    is_featured BOOLEAN DEFAULT FALSE,
    view_count INT DEFAULT 0,
    rating DECIMAL(3, 2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE CASCADE,
    FOREIGN KEY (kabupaten_id) REFERENCES kabupaten(id) ON DELETE CASCADE,
    INDEX idx_kategori (kategori_id),
    INDEX idx_kabupaten (kabupaten_id),
    INDEX idx_featured (is_featured),
    FULLTEXT INDEX idx_search (nama, deskripsi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel Fasilitas
CREATE TABLE IF NOT EXISTS fasilitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    destinasi_id INT NOT NULL,
    nama VARCHAR(100) NOT NULL,
    icon VARCHAR(50),
    tersedia BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destinasi_id) REFERENCES destinasi(id) ON DELETE CASCADE,
    INDEX idx_destinasi (destinasi_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel Galeri Foto
CREATE TABLE IF NOT EXISTS galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    destinasi_id INT NOT NULL,
    nama_file VARCHAR(255) NOT NULL,
    caption VARCHAR(255),
    urutan INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destinasi_id) REFERENCES destinasi(id) ON DELETE CASCADE,
    INDEX idx_destinasi (destinasi_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel Artikel
CREATE TABLE IF NOT EXISTS artikel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    konten TEXT NOT NULL,
    excerpt VARCHAR(500),
    foto_thumbnail VARCHAR(255),
    kategori_artikel VARCHAR(100),
    view_count INT DEFAULT 0,
    is_published BOOLEAN DEFAULT TRUE,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_published (is_published),
    FULLTEXT INDEX idx_search_artikel (judul, konten)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel Tips & Panduan
CREATE TABLE IF NOT EXISTS tips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    destinasi_id INT NOT NULL,
    judul VARCHAR(200) NOT NULL,
    konten TEXT NOT NULL,
    tipe ENUM('tips', 'larangan', 'perhatian') DEFAULT 'tips',
    urutan INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destinasi_id) REFERENCES destinasi(id) ON DELETE CASCADE,
    INDEX idx_destinasi (destinasi_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Data Kategori
INSERT INTO kategori (nama, slug, deskripsi, icon) VALUES
('Hutan', 'hutan', 'Wisata hutan tropis dan konservasi', 'fa-tree'),
('Pantai', 'pantai', 'Pesona pantai dan laut Kalimantan Timur', 'fa-umbrella-beach'),
('Sungai', 'sungai', 'Keindahan sungai dan wisata air', 'fa-water'),
('Danau', 'danau', 'Danau dan telaga alami', 'fa-water'),
('Gunung', 'gunung', 'Pendakian dan wisata pegunungan', 'fa-mountain'),
('Air Terjun', 'air-terjun', 'Keindahan air terjun alami', 'fa-water');

-- Insert Data Kabupaten/Kota
INSERT INTO kabupaten (nama, slug) VALUES
('Samarinda', 'samarinda'),
('Balikpapan', 'balikpapan'),
('Bontang', 'bontang'),
('Kutai Kartanegara', 'kutai-kartanegara'),
('Kutai Timur', 'kutai-timur'),
('Kutai Barat', 'kutai-barat'),
('Berau', 'berau'),
('Paser', 'paser'),
('Penajam Paser Utara', 'penajam-paser-utara'),
('Mahakam Ulu', 'mahakam-ulu');

-- Insert Data Destinasi Sample (Featured) - Sesuai dengan Mock Data
INSERT INTO destinasi (nama, slug, kategori_id, kabupaten_id, deskripsi, sejarah, alamat, latitude, longitude, harga_tiket, jam_operasional, foto_utama, is_featured, view_count, rating) VALUES
(
    'Hutan Mangrove Kariangau',
    'hutan-mangrove-kariangau',
    1,
    2,
    'Hutan Mangrove Kariangau adalah kawasan konservasi mangrove yang terletak di Balikpapan. Tempat ini menawarkan pengalaman wisata edukasi dengan jembatan kayu sepanjang 1,2 km yang menembus hutan mangrove. Terdapat juga sekitar 400 ekor bekantan (Nasalis larvatus, atau proboscis monkey, kera berhidung mancung dan berbulu oranye). Di Hutan Mangrove Center Kariangau kita bisa menyewa perahu klotok untuk berkeliling menyusuri sungai Somber selama 1 jam bolak-balik dan tentunya ditemani oleh tur guide.',
    'Kawasan ini mulai dikembangkan sejak tahun 2010 sebagai upaya konservasi ekosistem pesisir dan menjadi destinasi wisata edukasi lingkungan.',
    'Jl. Kariangau, Balikpapan Barat, Kota Balikpapan',
    -1.21370460,
    116.81029887,
    'Gratis',
    '06:00 - 18:00 WITA',
    'mangrove-kariangau.jpg',
    TRUE,
    1245,
    4.7
),
(
    'Pantai Manggar Segara Sari',
    'pantai-manggar-segara-sari',
    2,
    2,
    'Pantai Manggar atau yang dikenal dengan Segara Sari adalah pantai populer di Balikpapan dengan pasir putih dan ombak yang tenang. Cocok untuk berenang dan bersantai bersama keluarga.',
    'Pantai ini telah menjadi destinasi favorit warga Balikpapan sejak era 1980-an dan terus berkembang dengan berbagai fasilitas modern.',
    'Manggar, Balikpapan Timur, Kota Balikpapan',
    -1.12340000,
    116.98760000,
    'Rp 5.000 - Rp 10.000',
    '24 Jam',
    'Pantai-Manggar-Segarasari.jpg',
    TRUE,
    2156,
    4.5
),
(
    'Pulau Beras Basah',
    'pulau-beras-basah',
    2,
    7,
    'Pulau Beras Basah di Bontang, Kalimantan Timur, adalah destinasi wisata pantai yang eksotis dengan keindahan alam bawah laut yang memukau. Terletak di tengah Laut Jawa, pulau ini menjadi surga bagi para pencinta alam',
    'Asal mula nama Beras Basah menurut cerita rakyat setempat berasal dari kata "beras" dan "basah". Dahulu kala, terdapat kapal milik kesultanan kutai yang sedang berlayar di Selat Makassar. Kapal tersebut membawa bahan pangan yang diantaranya adalah beras. Kapal tersebut tiba - tiba saja karam dan menumpahkan bawaannya. Karena perairan tempat kapal karam tersebut dangkal maka bawaan kapal tersebut yang sebagian besar adalah beras tidak tenggelam, melainkan muncul sebagian seperti gundukan. Lama - kelamaan gundukan beras tersebut berubah menjadi pulau berpasir putih seperti beras yang selalu basah karena dikelilingi oleh lautan.',
    'Kabupaten Berau, Kalimantan Timur',
    2.12340000,
    117.45670000,
    'Gratis',
    '24 Jam',
    'Pulau-Beras-Basah.jpg',
    TRUE,
    876,
    4.6
),
(
    'Taman Nasional Kutai',
    'taman-nasional-kutai',
    1,
    5,
    'Taman Nasional Kutai adalah salah satu kawasan konservasi tertua di Indonesia dengan luas lebih dari 198.000 hektar. Habitat berbagai satwa langka seperti orangutan dan bekantan.',
    'Ditetapkan sebagai taman nasional pada tahun 1982, kawasan ini memiliki keanekaragaman hayati yang sangat tinggi.',
    'Kabupaten Kutai Timur, Kalimantan Timur',
    0.56780000,
    117.23450000,
    'Rp 10.000 - Rp 50.000',
    '07:00 - 17:00 WITA',
    'taman-nasional-kutai.jpeg',
    TRUE,
    3421,
    4.8
),
(
    'Labuan Cermin',
    'labuan-cermin',
    4,
    7,
    'Labuan Cermin adalah salah satu destinasi wisata Kalimantan Timur terfavorit tepatnya berada di Berau. Air danaunya yang bening seperti cermin dan kondisi airnya yang sangat jernih membuat wisatawan penasaran karena keindahan alam yang memuaskan mata. Lokasi wisata danau alami ini berada di Desa Labuan Kelambu, Kecamatan Biduk-biduk, Kabupaten Berau, Kaltim.',
    'Pantai Amal telah menjadi ikon wisata Kutai Kartanegara sejak lama dan terus dikembangkan fasilitasnya.',
    'Desa Labuan Kelambu, Kecamatan Biduk-biduk, Kabupaten Berau, Kalimantan Timur',
    -0.41230000,
    117.02340000,
    'Rp. 10.000 per orang',
    '24 Jam',
    'Danau-Labuan-Cermin.jpg',
    TRUE,
    1987,
    4.4
),
(
    'Air Terjun Tanah Merah',
    'air-terjun-tanah-merah',
    6,
    1,
    'Air terjun yang tersembunyi di tengah hutan dengan ketinggian sekitar 25 meter. Air yang jernih dan suasana yang sejuk membuat tempat ini sempurna untuk refreshing.',
    'Ditemukan oleh penduduk lokal dan kini menjadi destinasi favorit untuk pecinta alam.',
    'Samarinda, Kalimantan Timur',
    -0.50120000,
    117.15340000,
    'Rp 5.000',
    '08:00 - 16:00 WITA',
    'air-terjun-tanah-merah.jpg',
    TRUE,
    1543,
    4.6
);

-- Insert Data Fasilitas
INSERT INTO fasilitas (destinasi_id, nama, icon, tersedia) VALUES
-- Hutan Mangrove Kariangau (ID: 1)
(1, 'Area Parkir', 'fa-parking', TRUE),
(1, 'Toilet', 'fa-restroom', TRUE),
(1, 'Mushola', 'fa-mosque', TRUE),
(1, 'Warung Makan', 'fa-utensils', TRUE),
-- Pantai Manggar Segara Sari (ID: 2)
(2, 'Area Parkir', 'fa-parking', TRUE),
(2, 'Toilet', 'fa-restroom', TRUE),
(2, 'Penginapan', 'fa-hotel', TRUE),
(2, 'Restoran', 'fa-utensils', TRUE),
-- Taman Nasional Kutai (ID: 4)
(4, 'Pemandu Wisata', 'fa-user-tie', TRUE),
(4, 'Area Camping', 'fa-campground', TRUE);

-- Insert Data Artikel Sample
INSERT INTO artikel (judul, slug, konten, excerpt, kategori_artikel, view_count, is_published, published_at) VALUES
(
    'Panduan Lengkap Berkunjung ke Kalimantan Timur',
    'panduan-lengkap-berkunjung-kaltim',
    'Kalimantan Timur menawarkan keindahan alam yang luar biasa. Dari hutan tropis hingga pantai yang eksotis, semuanya menunggu untuk dijelajahi...',
    'Panduan lengkap untuk wisatawan yang ingin menjelajahi Kalimantan Timur',
    'Panduan Wisata',
    1234,
    TRUE,
    '2026-01-15 10:00:00'
),
(
    'Musim Terbaik Mengunjungi Wisata Alam Kaltim',
    'musim-terbaik-wisata-kaltim',
    'Kalimantan Timur memiliki iklim tropis dengan dua musim utama. Musim terbaik untuk berkunjung adalah antara bulan April hingga Oktober...',
    'Kapan waktu terbaik untuk berlibur ke Kalimantan Timur?',
    'Tips Perjalanan',
    987,
    TRUE,
    '2026-01-10 14:30:00'
),
(
    '10 Kuliner Khas yang Wajib Dicoba di Kaltim',
    '10-kuliner-khas-kaltim',
    'Selain keindahan alamnya, Kalimantan Timur juga kaya dengan kuliner khas yang menggugah selera. Dari amplang, ikan patin, hingga nasi bekepor...',
    'Jelajahi kelezatan kuliner tradisional Kalimantan Timur',
    'Kuliner',
    2156,
    TRUE,
    '2026-01-05 09:00:00'
);

-- Insert Tips untuk Destinasi
INSERT INTO tips (destinasi_id, judul, konten, tipe, urutan) VALUES
(1, 'Gunakan Alas Kaki yang Nyaman', 'Jembatan kayu cukup panjang, gunakan alas kaki yang nyaman untuk berjalan.', 'tips', 1),
(1, 'Jangan Membuang Sampah Sembarangan', 'Jagalah kebersihan kawasan mangrove dengan tidak membuang sampah sembarangan.', 'larangan', 2),
(2, 'Datang Saat Sore Hari', 'Pemandangan sunset di Pantai Manggar sangat indah, datanglah saat sore hari.', 'tips', 1),
(2, 'Bawa Perlengkapan Renang', 'Ombak tenang dan cocok untuk berenang, jangan lupa bawa perlengkapan renang.', 'tips', 2),
(4, 'Gunakan Pemandu Lokal', 'Untuk keamanan dan informasi lengkap, disarankan menggunakan pemandu wisata lokal.', 'tips', 1),
(4, 'Jangan Mengganggu Satwa Liar', 'Hormati habitat satwa liar dan jangan memberi makan atau mengganggu mereka.', 'larangan', 2);
