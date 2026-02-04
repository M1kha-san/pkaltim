-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2026 at 12:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: wisata_alam_kaltim
-- Sistem Informasi Wisata Alam Kalimantan Timur

CREATE DATABASE IF NOT EXISTS wisata_alam_kaltim CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wisata_alam_kaltim;

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `konten` text NOT NULL,
  `excerpt` varchar(500) DEFAULT NULL,
  `foto_thumbnail` varchar(255) DEFAULT NULL,
  `kategori_artikel` varchar(100) DEFAULT NULL,
  `view_count` int(11) DEFAULT 0,
  `is_published` tinyint(1) DEFAULT 1,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `slug`, `konten`, `excerpt`, `foto_thumbnail`, `kategori_artikel`, `view_count`, `is_published`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Panduan Lengkap Berkunjung ke Kalimantan Timur', 'panduan-lengkap-berkunjung-kaltim', 'Kalimantan Timur menawarkan keindahan alam yang luar biasa. Dari hutan tropis hingga pantai yang eksotis, semuanya menunggu untuk dijelajahi...', 'Panduan lengkap untuk wisatawan yang ingin menjelajahi Kalimantan Timur', NULL, 'Panduan Wisata', 1234, 1, '2026-01-15 02:00:00', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(2, 'Musim Terbaik Mengunjungi Wisata Alam Kaltim', 'musim-terbaik-wisata-kaltim', 'Kalimantan Timur memiliki iklim tropis dengan dua musim utama. Musim terbaik untuk berkunjung adalah antara bulan April hingga Oktober...', 'Kapan waktu terbaik untuk berlibur ke Kalimantan Timur?', NULL, 'Tips Perjalanan', 987, 1, '2026-01-10 06:30:00', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(3, '10 Kuliner Khas yang Wajib Dicoba di Kaltim', '10-kuliner-khas-kaltim', 'Selain keindahan alamnya, Kalimantan Timur juga kaya dengan kuliner khas yang menggugah selera. Dari amplang, ikan patin, hingga nasi bekepor...', 'Jelajahi kelezatan kuliner tradisional Kalimantan Timur', NULL, 'Kuliner', 2156, 1, '2026-01-05 01:00:00', '2026-01-28 13:28:33', '2026-01-28 13:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `destinasi`
--

CREATE TABLE `destinasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `kabupaten_id` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `sejarah` text DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `harga_tiket` varchar(100) DEFAULT NULL,
  `jam_operasional` varchar(100) DEFAULT NULL,
  `foto_utama` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `view_count` int(11) DEFAULT 0,
  `rating` decimal(3,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinasi`
--

INSERT INTO `destinasi` (`id`, `nama`, `slug`, `kategori_id`, `kabupaten_id`, `deskripsi`, `sejarah`, `alamat`, `latitude`, `longitude`, `harga_tiket`, `jam_operasional`, `foto_utama`, `is_featured`, `view_count`, `rating`, `created_at`, `updated_at`) VALUES
(1, 'Hutan Mangrove Kariangau', 'hutan-mangrove-kariangau', 1, 2, 'Hutan Mangrove Kariangau adalah kawasan konservasi mangrove yang terletak di Balikpapan. Tempat ini menawarkan pengalaman wisata edukasi dengan jembatan kayu sepanjang 1,2 km yang menembus hutan mangrove. Terdapat juga sekitar 400 ekor bekantan (Nasalis larvatus, atau proboscis monkey, kera berhidung mancung dan berbulu oranye). Di Hutan Mangrove Center Kariangau kita bisa menyewa perahu klotok untuk berkeliling menyusuri sungai Somber selama 1 jam bolak-balik dan tentunya ditemani oleh tur guide.', 'Kawasan ini mulai dikembangkan sejak tahun 2010 sebagai upaya konservasi ekosistem pesisir dan menjadi destinasi wisata edukasi lingkungan.', 'Jl. Kariangau, Balikpapan Barat, Kota Balikpapan', -1.21370460, 116.81029887, 'Gratis', '06:00 - 18:00 WITA', 'mangrove-kariangau.jpg', 1, 1255, 4.70, '2026-01-28 13:28:33', '2026-02-01 12:40:37'),
(2, 'Pantai Manggar Segara Sari', 'pantai-manggar-segara-sari', 2, 2, 'Pantai Manggar atau yang dikenal dengan Segara Sari adalah pantai populer di Balikpapan dengan pasir putih dan ombak yang tenang. Cocok untuk berenang dan bersantai bersama keluarga.', 'Pantai ini telah menjadi destinasi favorit warga Balikpapan sejak era 1980-an dan terus berkembang dengan berbagai fasilitas modern.', 'Manggar, Balikpapan Timur, Kota Balikpapan', -1.21419570, 116.98066070, 'Rp 5.000 - Rp 10.000', '24 Jam', 'Pantai-Manggar-Segarasari.jpg', 1, 2165, 4.50, '2026-01-28 13:28:33', '2026-02-01 08:14:15'),
(3, 'Pulau Beras Basah', 'pulau-beras-basah', 2, 7, 'Pulau Beras Basah di Bontang, Kalimantan Timur, adalah destinasi wisata pantai yang eksotis dengan keindahan alam bawah laut yang memukau. Terletak di tengah Laut Jawa, pulau ini menjadi surga bagi para pencinta alam', 'Asal mula nama Beras Basah menurut cerita rakyat setempat berasal dari kata \"beras\" dan \"basah\". Dahulu kala, terdapat kapal milik kesultanan kutai yang sedang berlayar di Selat Makassar. Kapal tersebut membawa bahan pangan yang diantaranya adalah beras. Kapal tersebut tiba - tiba saja karam dan menumpahkan bawaannya. Karena perairan tempat kapal karam tersebut dangkal maka bawaan kapal tersebut yang sebagian besar adalah beras tidak tenggelam, melainkan muncul sebagian seperti gundukan. Lama - kelamaan gundukan beras tersebut berubah menjadi pulau berpasir putih seperti beras yang selalu basah karena dikelilingi oleh lautan.', 'Kabupaten Berau, Kalimantan Timur', 2.12340000, 117.45670000, 'Gratis', '24 Jam', 'Pulau-Beras-Basah.jpg', 1, 880, 4.60, '2026-01-28 13:28:33', '2026-02-01 08:14:29'),
(4, 'Taman Nasional Kutai', 'taman-nasional-kutai', 1, 5, 'Taman Nasional Kutai adalah salah satu kawasan konservasi tertua di Indonesia dengan luas lebih dari 198.000 hektar. Habitat berbagai satwa langka seperti orangutan dan bekantan.', 'Ditetapkan sebagai taman nasional pada tahun 1982, kawasan ini memiliki keanekaragaman hayati yang sangat tinggi.', 'Kabupaten Kutai Timur, Kalimantan Timur', 0.56780000, 117.23450000, 'Rp 10.000 - Rp 50.000', '07:00 - 17:00 WITA', 'taman-nasional-kutai.jpeg', 1, 3428, 4.80, '2026-01-28 13:28:33', '2026-02-01 12:39:57'),
(5, 'Labuan Cermin', 'labuan-cermin', 4, 7, 'Labuan Cermin adalah salah satu destinasi wisata Kalimantan Timur terfavorit tepatnya berada di Berau. Air danaunya yang bening seperti cermin dan kondisi airnya yang sangat jernih membuat wisatawan penasaran karena keindahan alam yang memuaskan mata. Lokasi wisata danau alami ini berada di Desa Labuan Kelambu, Kecamatan Biduk-biduk, Kabupaten Berau, Kaltim.', 'Pantai Amal telah menjadi ikon wisata Kutai Kartanegara sejak lama dan terus dikembangkan fasilitasnya.', 'Desa Labuan Kelambu, Kecamatan Biduk-biduk, Kabupaten Berau, Kalimantan Timur', -0.41230000, 117.02340000, 'Rp. 10.000 per orang', '24 Jam', 'Danau-Labuan-Cermin.jpg', 1, 1987, 4.40, '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(6, 'Air Terjun Tanah Merah', 'air-terjun-tanah-merah', 6, 1, 'Air terjun yang tersembunyi di tengah hutan dengan ketinggian sekitar 25 meter. Air yang jernih dan suasana yang sejuk membuat tempat ini sempurna untuk refreshing.', 'Ditemukan oleh penduduk lokal dan kini menjadi destinasi favorit untuk pecinta alam.', 'Samarinda, Kalimantan Timur', -0.50120000, 117.15340000, 'Rp 5.000', '08:00 - 16:00 WITA', 'air-terjun-tanah-merah.jpg', 1, 1548, 4.60, '2026-01-28 13:28:33', '2026-02-01 12:40:30'),
(7, 'Bukit Steling', 'bukit-steling', 5, 1, 'Bukit Steling adalah sebuah perbukitan rendah di Samarinda, Kalimantan Timur. Lokasinya strategis di Kelurahan Selili dan Sungai Dama, Kecamatan Samarinda Ilir.', 'Dulu konon jadi pos pantau tentara Belanda dan permukiman sejak 2000-an, kini jadi wisata alam meski dekat pemukiman serta Sungai Mahakam. Antara Gunung Manggah dan Gunung Selili, aksesnya 1 km menanjak melalui hutan kota.', 'Selili, Kec. Samarinda Ilir, Kota Samarinda, Kalimantan Timur 75251', -0.51708065, 117.16028737, 'Gratis', '24/7', 'destinasi_697aa0dcd9c70_1769644252.webp', 1, 8, 4.40, '2026-01-28 06:40:02', '2026-02-02 23:20:28'),
(8, 'Bukit Biru', 'bukit-biru', 5, 4, 'Bukit Biru di Desa Sumber Sari, Kecamatan Loa Kulu (dekat Tenggarong), Kutai Kartanegara, merupakan destinasi wisata alam populer setinggi 600 mdpl yang terkenal dengan julukan \"negeri di atas awan\". Tempat ini menawarkan pemandangan matahari terbit (sunrise) dan terbenam (sunset) yang memukau, suasana sejuk, serta spot perkemahan. ', '', 'Desa Sumber Sari, Kecamatan Loa Kulu, Kabupaten Kutai Kartanegara.', NULL, NULL, 'Rp. 5.000 - Rp. 10.000', '24/7', 'destinasi_697aaddfdee65_1769647583.jpg', 1, 1, 4.30, '2026-01-28 16:46:23', '2026-01-28 16:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `destinasi_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `tersedia` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `destinasi_id`, `nama`, `icon`, `tersedia`, `created_at`) VALUES
(1, 1, 'Area Parkir', 'fa-parking', 1, '2026-01-28 13:28:33'),
(2, 1, 'Toilet', 'fa-restroom', 1, '2026-01-28 13:28:33'),
(3, 1, 'Mushola', 'fa-mosque', 1, '2026-01-28 13:28:33'),
(4, 1, 'Warung Makan', 'fa-utensils', 1, '2026-01-28 13:28:33'),
(9, 4, 'Pemandu Wisata', 'fa-user-tie', 1, '2026-01-28 13:28:33'),
(10, 4, 'Area Camping', 'fa-campground', 1, '2026-01-28 13:28:33'),
(13, 2, 'Area Parkir', 'fa-parking', 0, '2026-01-28 15:42:49'),
(14, 2, 'Toilet', 'fa-restroom', 0, '2026-01-28 15:42:49'),
(15, 2, 'Penginapan', 'fa-hotel', 0, '2026-01-28 15:42:49'),
(16, 2, 'Restoran', 'fa-utensils', 0, '2026-01-28 15:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `destinasi_id` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `destinasi_id`, `nama_file`, `caption`, `urutan`, `created_at`) VALUES
(21, 1, 'mangrove-path-1.jpg', 'Jembatan Kayu Menara Pandang', 1, '2026-02-01 08:13:47'),
(22, 1, 'mangrove-path-2.jpg', 'Suasana Hutan Mangrove', 2, '2026-02-01 08:13:47'),
(23, 1, 'mangrove-sunset.jpg', 'Sunset di Mangrove Kariangau', 3, '2026-02-01 08:13:47'),
(24, 1, 'mangrove-birds.jpg', 'Burung-burung di Hutan Mangrove', 4, '2026-02-01 08:13:47'),
(25, 2, 'labuan-cermin-1.jpg', 'Air Jernih Labuan Cermin', 1, '2026-02-01 08:13:47'),
(26, 2, 'labuan-cermin-diving.jpg', 'Snorkeling di Danau Dua Rasa', 2, '2026-02-01 08:13:47'),
(27, 2, 'labuan-cermin-boat.jpg', 'Perahu Tradisional', 3, '2026-02-01 08:13:47'),
(28, 2, 'labuan-cermin-underwater.jpg', 'Pemandangan Bawah Air', 4, '2026-02-01 08:13:47'),
(29, 2, 'labuan-cermin-forest.jpg', 'Hutan di Sekitar Danau', 5, '2026-02-01 08:13:47'),
(30, 3, 'derawan-beach-1.jpg', 'Pantai Pulau Derawan', 1, '2026-02-01 08:13:47'),
(31, 3, 'derawan-turtle.jpg', 'Penyu di Perairan Derawan', 2, '2026-02-01 08:13:47'),
(32, 3, 'derawan-pier.jpg', 'Dermaga Pulau Derawan', 3, '2026-02-01 08:13:47'),
(33, 3, 'derawan-underwater.jpg', 'Terumbu Karang Derawan', 4, '2026-02-01 08:13:47'),
(34, 3, 'derawan-sunset.jpg', 'Sunset di Pulau Derawan', 5, '2026-02-01 08:13:47'),
(35, 3, 'derawan-jellyfish.jpg', 'Ubur-ubur di Kakaban', 6, '2026-02-01 08:13:47'),
(36, 4, 'kutai-orangutan-1.jpg', 'Orangutan di Habitatnya', 1, '2026-02-01 08:13:47'),
(37, 4, 'kutai-forest.jpg', 'Hutan Hujan Tropis', 2, '2026-02-01 08:13:47'),
(38, 4, 'kutai-river.jpg', 'Sungai di Taman Nasional', 3, '2026-02-01 08:13:47'),
(39, 4, 'kutai-proboscis.jpg', 'Bekantan Khas Kalimantan', 4, '2026-02-01 08:13:47'),
(40, 4, 'kutai-canopy.jpg', 'Canopy Walk', 5, '2026-02-01 08:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `provinsi` varchar(100) DEFAULT 'Kalimantan Timur',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `nama`, `slug`, `provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Samarinda', 'samarinda', 'Kalimantan Timur', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(2, 'Balikpapan', 'balikpapan', 'Kalimantan Timur', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(3, 'Bontang', 'bontang', 'Kalimantan Timur', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(4, 'Kutai Kartanegara', 'kutai-kartanegara', 'Kalimantan Timur', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(5, 'Kutai Timur', 'kutai-timur', 'Kalimantan Timur', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(6, 'Kutai Barat', 'kutai-barat', 'Kalimantan Timur', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(7, 'Berau', 'berau', 'Kalimantan Timur', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(8, 'Paser', 'paser', 'Kalimantan Timur', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(9, 'Penajam Paser Utara', 'penajam-paser-utara', 'Kalimantan Timur', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(10, 'Mahakam Ulu', 'mahakam-ulu', 'Kalimantan Timur', '2026-01-28 13:28:33', '2026-01-28 13:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `slug`, `deskripsi`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Hutan', 'hutan', 'Wisata hutan tropis dan konservasi', 'fa-tree', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(2, 'Pantai', 'pantai', 'Pesona pantai dan laut Kalimantan Timur', 'fa-umbrella-beach', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(3, 'Sungai', 'sungai', 'Keindahan sungai dan wisata air', 'fa-water', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(4, 'Danau', 'danau', 'Danau dan telaga alami', 'fa-water', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(5, 'Gunung', 'gunung', 'Pendakian dan wisata pegunungan', 'fa-mountain', '2026-01-28 13:28:33', '2026-01-28 13:28:33'),
(6, 'Air Terjun', 'air-terjun', 'Keindahan air terjun alami', 'fa-water', '2026-01-28 13:28:33', '2026-01-28 13:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

CREATE TABLE `tips` (
  `id` int(11) NOT NULL,
  `destinasi_id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `konten` text NOT NULL,
  `tipe` enum('tips','larangan','perhatian') DEFAULT 'tips',
  `urutan` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tips`
--

INSERT INTO `tips` (`id`, `destinasi_id`, `judul`, `konten`, `tipe`, `urutan`, `created_at`) VALUES
(1, 1, 'Gunakan Alas Kaki yang Nyaman', 'Jembatan kayu cukup panjang, gunakan alas kaki yang nyaman untuk berjalan.', 'tips', 1, '2026-01-28 13:28:33'),
(2, 1, 'Jangan Membuang Sampah Sembarangan', 'Jagalah kebersihan kawasan mangrove dengan tidak membuang sampah sembarangan.', 'larangan', 2, '2026-01-28 13:28:33'),
(5, 4, 'Gunakan Pemandu Lokal', 'Untuk keamanan dan informasi lengkap, disarankan menggunakan pemandu wisata lokal.', 'tips', 1, '2026-01-28 13:28:33'),
(6, 4, 'Jangan Mengganggu Satwa Liar', 'Hormati habitat satwa liar dan jangan memberi makan atau mengganggu mereka.', 'larangan', 2, '2026-01-28 13:28:33'),
(7, 2, 'Datang Saat Sore Hari', 'Pemandangan sunset di Pantai Manggar sangat indah, datanglah saat sore hari.', 'tips', 1, '2026-01-28 15:42:49'),
(8, 2, 'Bawa Perlengkapan Renang', 'Ombak tenang dan cocok untuk berenang, jangan lupa bawa perlengkapan renang.', 'tips', 2, '2026-01-28 15:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(11) NOT NULL,
  `lang_code` char(2) NOT NULL,
  `translation_key` varchar(100) NOT NULL,
  `translation_value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `lang_code`, `translation_key`, `translation_value`, `created_at`, `updated_at`) VALUES
(1, 'id', 'nav.home', 'Beranda', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(2, 'en', 'nav.home', 'Home', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(3, 'id', 'nav.about', 'Tentang', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(4, 'en', 'nav.about', 'About', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(5, 'id', 'nav.destinations', 'Destinasi', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(6, 'en', 'nav.destinations', 'Destinations', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(7, 'id', 'nav.gallery', 'Galeri', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(8, 'en', 'nav.gallery', 'Gallery', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(9, 'id', 'nav.contact', 'Kontak', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(10, 'en', 'nav.contact', 'Contact', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(11, 'id', 'common.read_more', 'Baca Selengkapnya', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(12, 'en', 'common.read_more', 'Read More', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(13, 'id', 'common.search', 'Cari', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(14, 'en', 'common.search', 'Search', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(15, 'id', 'common.filter', 'Filter', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(16, 'en', 'common.filter', 'Filter', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(17, 'id', 'common.all', 'Semua', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(18, 'en', 'common.all', 'All', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(19, 'id', 'common.location', 'Lokasi', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(20, 'en', 'common.location', 'Location', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(21, 'id', 'common.price', 'Harga', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(22, 'en', 'common.price', 'Price', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(23, 'id', 'common.rating', 'Rating', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(24, 'en', 'common.rating', 'Rating', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(25, 'id', 'common.view_details', 'Lihat Detail', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(26, 'en', 'common.view_details', 'View Details', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(27, 'id', 'detail.description', 'Deskripsi', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(28, 'en', 'detail.description', 'Description', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(29, 'id', 'detail.history', 'Sejarah', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(30, 'en', 'detail.history', 'History', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(31, 'id', 'detail.facilities', 'Fasilitas', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(32, 'en', 'detail.facilities', 'Facilities', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(33, 'id', 'detail.tips', 'Tips Berkunjung', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(34, 'en', 'detail.tips', 'Visiting Tips', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(35, 'id', 'detail.gallery', 'Galeri Foto', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(36, 'en', 'detail.gallery', 'Photo Gallery', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(37, 'id', 'detail.open_maps', 'Buka Google Maps', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(38, 'en', 'detail.open_maps', 'Open Google Maps', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(39, 'id', 'detail.ticket_price', 'Harga Tiket', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(40, 'en', 'detail.ticket_price', 'Ticket Price', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(41, 'id', 'detail.opening_hours', 'Jam Operasional', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(42, 'en', 'detail.opening_hours', 'Opening Hours', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(43, 'id', 'detail.address', 'Alamat', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(44, 'en', 'detail.address', 'Address', '2026-02-01 08:13:47', '2026-02-01 08:13:47'),
(45, 'id', 'dest.page_title', 'Destinasi Wisata Alam', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(46, 'en', 'dest.page_title', 'Natural Tourism Destinations', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(47, 'id', 'dest.page_subtitle', 'Temukan destinasi wisata alam terbaik di Kalimantan Timur', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(48, 'en', 'dest.page_subtitle', 'Discover the best natural tourism destinations in East Kalimantan', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(49, 'id', 'dest.search_placeholder', 'Cari destinasi...', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(50, 'en', 'dest.search_placeholder', 'Search destinations...', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(51, 'id', 'dest.filter_all', 'Semua', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(52, 'en', 'dest.filter_all', 'All', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(53, 'id', 'dest.not_found', 'Destinasi Tidak Ditemukan', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(54, 'en', 'dest.not_found', 'Destinations Not Found', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(55, 'id', 'dest.not_found_desc', 'Coba kata kunci atau filter lain', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(56, 'en', 'dest.not_found_desc', 'Try other keywords or filters', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(57, 'id', 'dest.detail_btn', 'Detail', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(58, 'en', 'dest.detail_btn', 'Details', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(59, 'id', 'home.hero_title', 'WISATA ALAM', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(60, 'en', 'home.hero_title', 'NATURAL TOURISM', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(61, 'id', 'home.hero_subtitle', 'KALTIM', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(62, 'en', 'home.hero_subtitle', 'EAST KALIMANTAN', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(63, 'id', 'home.hero_desc', 'Temukan ketenangan di surga tersembunyi Borneo. Hutan tropis, sungai legendaris, dan kepulauan eksotis menunggu Anda.', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(64, 'en', 'home.hero_desc', 'Find tranquility in the hidden paradise of Borneo. Tropical forests, legendary rivers, and exotic islands await you.', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(65, 'id', 'home.search_placeholder', 'Cari destinasi...', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(66, 'en', 'home.search_placeholder', 'Search destinations...', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(67, 'id', 'home.all_categories', 'Semua Kategori', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(68, 'en', 'home.all_categories', 'All Categories', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(69, 'id', 'home.search_btn', 'Cari', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(70, 'en', 'home.search_btn', 'Search', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(71, 'id', 'home.featured_label', 'Destinasi Pilihan', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(72, 'en', 'home.featured_label', 'Featured Destinations', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(73, 'id', 'home.featured_title', 'Temukan Petualangan', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(74, 'en', 'home.featured_title', 'Find Your Adventure', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(75, 'id', 'home.featured_subtitle', 'Impianmu', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(76, 'en', 'home.featured_subtitle', 'Dream', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(77, 'id', 'home.featured_here', 'Disini', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(78, 'en', 'home.featured_here', 'Here', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(79, 'id', 'home.featured_desc', 'Kami memberikan rekomendasi destinasi terbaik di Kalimantan Timur, dari puncak gunung yang berkabut hingga kedalaman laut yang mempesona.', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(80, 'en', 'home.featured_desc', 'We provide recommendations for the best destinations in East Kalimantan, from misty mountain peaks to mesmerizing ocean depths.', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(81, 'id', 'home.filter_all', 'Semua', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(82, 'en', 'home.filter_all', 'All', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(83, 'id', 'home.about_label', 'Tentang Wisata', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(84, 'en', 'home.about_label', 'About Tourism', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(85, 'id', 'home.about_title', 'Menjelajahi Jantung', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(86, 'en', 'home.about_title', 'Exploring the Heart of', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(87, 'id', 'home.about_subtitle', 'Kalimantan', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(88, 'en', 'home.about_subtitle', 'Kalimantan', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(89, 'id', 'home.about_desc', 'Nikmati keindahan alam Kaltim Etam yang menakjubkan. Dari kedalaman hutan hujan yang menyimpan ribuan spesies langka hingga keindahan bawah laut Kepulauan Derawan yang mempesona.', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(90, 'en', 'home.about_desc', 'Enjoy the stunning natural beauty of East Kalimantan. From the depths of rainforests that harbor thousands of rare species to the mesmerizing underwater beauty of the Derawan Islands.', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(91, 'id', 'home.gallery_title', 'Galeri Visual', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(92, 'en', 'home.gallery_title', 'Visual Gallery', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(93, 'id', 'home.gallery_link', 'Lihat Semua', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(94, 'en', 'home.gallery_link', 'View All', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(95, 'id', 'detail.breadcrumb_home', 'Beranda', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(96, 'en', 'detail.breadcrumb_home', 'Home', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(97, 'id', 'detail.breadcrumb_dest', 'Destinasi', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(98, 'en', 'detail.breadcrumb_dest', 'Destinations', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(99, 'id', 'detail.about_title', 'Tentang Destinasi', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(100, 'en', 'detail.about_title', 'About Destination', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(101, 'id', 'detail.history_title', 'Sejarah & Latar Belakang', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(102, 'en', 'detail.history_title', 'History & Background', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(103, 'id', 'detail.facilities_title', 'Fasilitas Tersedia', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(104, 'en', 'detail.facilities_title', 'Available Facilities', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(105, 'id', 'detail.tips_title', 'Panduan & Tips Penting', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(106, 'en', 'detail.tips_title', 'Guide & Important Tips', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(107, 'id', 'detail.map_title', 'Lokasi di Peta', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(108, 'en', 'detail.map_title', 'Location on Map', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(109, 'id', 'detail.open_gmaps', 'Buka di Google Maps', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(110, 'en', 'detail.open_gmaps', 'Open in Google Maps', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(111, 'id', 'detail.open_waze', 'Buka di Waze', '2026-02-01 12:39:29', '2026-02-01 12:39:29'),
(112, 'en', 'detail.open_waze', 'Open in Waze', '2026-02-01 12:39:29', '2026-02-01 12:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `role` enum('admin','penulis') DEFAULT 'penulis',
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `nama_lengkap`, `foto_profil`, `role`, `is_active`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@explorekaltim.com', '$2y$10$5tJaJDUIj/ATxVVV17qkL.brzd8OTiqghLpQN9/IfOolUEZJmZYSu', 'Administrator', NULL, 'admin', 1, '2026-02-01 23:42:23', '2026-01-28 14:11:19', '2026-02-01 23:42:23'),
(2, 'penulis', 'penulis@explorekaltim.com', '$2y$10$5tJaJDUIj/ATxVVV17qkL.brzd8OTiqghLpQN9/IfOolUEZJmZYSu', 'Tim Penulis', NULL, 'penulis', 1, '2026-02-02 23:18:08', '2026-01-28 14:11:19', '2026-02-02 23:18:08'),
(3, 'Andi', 'wahyu@gmail.com', '$2y$10$pDA1gPCDqnXnp5lmP6e/1OOPiZfxaUb9TQ7D8XCfRcC8fDz7LbZBG', 'Andi kayanya yah', NULL, 'penulis', 1, '2026-01-28 14:59:31', '2026-01-28 14:59:17', '2026-01-28 14:59:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_published` (`is_published`);
ALTER TABLE `artikel` ADD FULLTEXT KEY `idx_search_artikel` (`judul`,`konten`);

--
-- Indexes for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_kategori` (`kategori_id`),
  ADD KEY `idx_kabupaten` (`kabupaten_id`),
  ADD KEY `idx_featured` (`is_featured`);
ALTER TABLE `destinasi` ADD FULLTEXT KEY `idx_search` (`nama`,`deskripsi`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_destinasi` (`destinasi_id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_destinasi` (`destinasi_id`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_destinasi` (`destinasi_id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_translation` (`lang_code`,`translation_key`),
  ADD KEY `idx_lang` (`lang_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_username` (`username`),
  ADD KEY `idx_users_email` (`email`),
  ADD KEY `idx_users_role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `destinasi`
--
ALTER TABLE `destinasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tips`
--
ALTER TABLE `tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD CONSTRAINT `destinasi_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `destinasi_ibfk_2` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD CONSTRAINT `fasilitas_ibfk_1` FOREIGN KEY (`destinasi_id`) REFERENCES `destinasi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galeri`
--
ALTER TABLE `galeri`
  ADD CONSTRAINT `galeri_ibfk_1` FOREIGN KEY (`destinasi_id`) REFERENCES `destinasi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tips`
--
ALTER TABLE `tips`
  ADD CONSTRAINT `tips_ibfk_1` FOREIGN KEY (`destinasi_id`) REFERENCES `destinasi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
