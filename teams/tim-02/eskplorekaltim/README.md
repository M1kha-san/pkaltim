# ExploreKaltim

> Platform digital untuk menjelajahi keindahan wisata alam Kalimantan Timur

Website katalog destinasi wisata alam yang memudahkan wisatawan menemukan dan mengeksplorasi keindahan alam Kalimantan Timur, dari hutan mangrove sampai pantai-pantai eksotis.

[![PHP Version](https://img.shields.io/badge/PHP-7.4+-blue.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

---

## Tentang Project

Kalimantan Timur punya banyak destinasi wisata alam yang menakjubkan, tapi informasinya masih tersebar dan susah diakses. ExploreKaltim hadir sebagai solusi - sebuah platform terpusat yang menampilkan berbagai destinasi wisata lengkap dengan detail informasi, foto, lokasi, dan tips berkunjung.

Website ini dibangun menggunakan PHP native dengan pola MVC, MySQL untuk database, dan Tailwind CSS untuk tampilan. Kenapa native PHP? Karena dalam diskusi proyek tim sepakat untuk memilih php native sebagai backend dan ingin punya kontrol penuh atas setiap aspek aplikasi.

---

## ✨ Fitur Utama

### Untuk Pengunjung

- **🗺️ Jelajahi Destinasi** - Browse koleksi destinasi dengan filter kategori (hutan, pantai, danau, dll)
- **🔍 Pencarian** - Cari destinasi berdasarkan nama atau deskripsi
- **📍 Detail Lengkap** - Info komprehensif: deskripsi, lokasi (Google Maps), jam operasional, harga tiket, fasilitas, tips
- **🌍 Multi-bahasa** - Support Bahasa Indonesia & English
- **☁️ Info Cuaca** - Real-time weather untuk kota-kota di Kaltim
- **📱 Responsive** - Tampilan optimal di desktop, tablet, dan mobile

### Untuk Admin

- **📊 Dashboard Analytics** - Overview destinasi, kategori, dan user
- **✏️ Manajemen Destinasi** - CRUD lengkap untuk data destinasi
- **👥 Manajemen User** - Kelola akun admin dengan role-based access
- **🖼️ Upload Gambar** - Upload foto destinasi langsung dari panel
- **🌐 Kelola Translations** - Manage konten multi-bahasa via admin panel
- **🔐 Autentikasi Aman** - Login dengan password hashing (bcrypt)

---

## 🛠️ Tech Stack

### Backend

- **PHP 7.4+** - Server-side scripting (Native, no framework)
- **MySQL 5.7+** / MariaDB 10.2+ - Database
- **Composer** - Dependency management
- **phpdotenv** - Environment configuration

### Frontend

- **HTML5, CSS3, JavaScript** - Core web technologies
- **Tailwind CSS 3.x** - Utility-first CSS framework
- **Font Awesome 6.5.1** - Icon library
- **AOS** - Scroll animation library
- **Swiper.js** - Touch slider/carousel
- **Leaflet.js** - Interactive maps

### Architecture & Patterns

- **MVC Pattern** - Separation of concerns
- **Singleton Pattern** - Database connection
- **RESTful Routing** - Clean URL structure
- **Environment Variables** - Secure configuration

---

## 🚀 Quick Start

### Prerequisites

Yang harus dipersipakan yaitu:

- PHP >= 7.4
- MySQL >= 5.7 atau MariaDB >= 10.2
- Composer
- Web server (Apache/Nginx) atau XAMPP

### Installation

1. **Clone atau extract project ke htdocs**

   ```bash
   cd C:/xampp/htdocs/
   # atau lokasi htdocs Anda
   ```

2. **Import database**
   - Buka phpMyAdmin (http://localhost/phpmyadmin)
   - Buat database baru: `wisata_alam_kaltim`
   - Import file: `database/wisata_alam_kaltim.sql`

3. **Konfigurasi database** (jika perlu)

Edit `config/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // sesuaikan password MySQL Anda
define('DB_NAME', 'wisata_alam_kaltim');
```

4. **Update BASE_URL** (jika nama folder berbeda)

   Edit `config/config.php`:

   ```php
   define('BASE_URL', 'http://localhost/pkaltim-tim02/');
   // ganti dengan nama folder Anda
   ```

5. **Akses website**
   - Public: http://localhost/pkaltim-tim02-main/

**Login Admin:**

- URL: `http://localhost/explore-kaltim/admin/login`

### Default Admin Account

```
Username: admin
Password: admin123
```


---

## 📁 Struktur Project

```
explore-kaltim/
├── app/
│   ├── controllers/     # Business logic & request handling
│   ├── models/          # Database operations & data logic
│   ├── views/           # UI templates
│   │   ├── admin/       # Admin panel views
│   │   ├── layouts/     # Reusable layouts (header, footer, navbar)
│   │   └── pages/       # Public pages
│   └── helpers/         # Utility functions (Auth, Language)
├── config/
│   ├── config.php       # App configuration
│   └── database.php     # Database connection class
├── database/            # SQL schema & migrations
├── public/              # Web-accessible files
│   ├── css/             # Stylesheets
│   ├── js/              # JavaScript
│   └── images/          # Uploaded images
├── vendor/              # Composer dependencies
├── .env.example         # Environment template
├── .gitignore           # Git ignore rules
├── index.php            # Front controller & router
└── README.md           # Dokumentasi penting nih!
```

---

## 🔒 Security Features

Project ini dibangun dengan security best practices:

- ✅ **SQL Injection Prevention** - PDO prepared statements di semua query
- ✅ **XSS Prevention** - `htmlspecialchars()` untuk semua user input
- ✅ **Password Security** - Bcrypt hashing dengan `password_hash()`
- ✅ **Session Security** - Proper session management
- ✅ **Environment Variables** - Credentials tidak di-commit ke Git
- ✅ **CSRF Protection** - Token validation di form (ready untuk enable)
- ✅ **Role-Based Access** - Admin dan Penulis role dengan permission berbeda

---

## 📦 Dependencies

### PHP Libraries (via Composer)

```json
{
  "vlucas/phpdotenv": "^5.5", // Environment configuration
  "graham-campbell/result-type": "*", // Type safety for phpdotenv
  "phpoption/phpoption": "*" // Optional values handling
}
```

### Frontend Libraries (via CDN)

- **Tailwind CSS** - Utility-first CSS framework
- **Font Awesome** - 1,500+ free icons
- **AOS** - Animate on scroll library
- **Swiper** - Modern mobile touch slider
- **GLightbox** - Pure JavaScript lightbox
- **Leaflet** - Mobile-friendly interactive maps

---

## 🗄️ Database Schema

### Tabel Utama

| Tabel          | Deskripsi                                              |
| -------------- | ------------------------------------------------------ |
| `destinasi`    | Data destinasi wisata (nama, deskripsi, lokasi, harga) |
| `kategori`     | Kategori wisata (hutan, pantai, danau, dll)            |
| `kabupaten`    | Master data kabupaten/kota di Kaltim                   |
| `users`        | Admin & penulis accounts                               |
| `galeri`       | Galeri foto destinasi                                  |
| `fasilitas`    | Fasilitas yang tersedia di destinasi                   |
| `tips`         | Tips berkunjung untuk setiap destinasi                 |
| `translations` | Multi-language translations (ID/EN)                    |

---

## 🎨 Customization

### Update Styling

```bash
# Edit file: public/css/input.css atau tailwind.config.js
npm run dev    # Development mode (watch mode)
npm run build  # Production build
```

### Add Translation

```sql
INSERT INTO translations (lang_code, translation_key, translation_value) VALUES
('id', 'footer.copyright', 'Hak Cipta © 2026'),
('en', 'footer.copyright', 'Copyright © 2026');
```

```php
<p><?= Language::get('footer.copyright') ?></p>
```

---

## 📄 License

Project ini open source dan available under the [MIT License](LICENSE).

---

## 👥 Tim Pengembang

Dikembangkan oleh **Tim 02** sebagai project pembelajaran web development.

---

## Kontribusi

Project ini masih dalam pengembangan aktif. Silakan fork dan submit pull request untuk improvement atau bug fixes.

---


**Selamat menjelajahi keindahan alam Kalimantan Timur! 🌿**
