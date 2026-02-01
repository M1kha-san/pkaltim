# Setup Guide - ExploreKaltim

Panduan lengkap untuk setup project dari awal sampai jalan.

## Kebutuhan Sistem

Sebelum mulai, pastikan komputer kamu sudah punya:

- **PHP** versi 7.4 atau lebih baru
- **MySQL** atau **MariaDB**
- **Composer** (untuk manage dependencies PHP)
- **Node.js & npm** (opsional, kalau mau edit styling)
- Web server (**Apache** atau **Nginx**)

> 💡 **Tips:** Kalau belum punya semua itu, install aja XAMPP - udah lengkap semuanya!

---

## Langkah 1: Clone atau Download Project

```bash
# Clone via Git
git clone <repository-url> explore-kaltim
cd explore-kaltim

# Atau download ZIP, lalu extract ke folder htdocs
```

---

## Langkah 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies (opsional)
npm install
```

Ini akan download semua library yang dibutuhkan project.

---

## Langkah 3: Setup Database

### 3.1 Buat Database Baru

Buka **phpMyAdmin** (biasanya di `http://localhost/phpmyadmin`), lalu:

1. Klik **New** di sidebar
2. Nama database: `wisata_alam_kaltim`
3. Collation: `utf8mb4_unicode_ci`
4. Klik **Create**

### 3.2 Import Schema & Data

Import file SQL secara berurutan:

```sql
1. database/wisata_alam_kaltim.sql      -- Schema & data utama
2. database/new_features.sql            -- Fitur tambahan (galeri, translations)
3. database/translation_updates.sql     -- Translation keys terbaru
```

Cara import:

1. Pilih database `wisata_alam_kaltim`
2. Klik tab **Import**
3. Choose file → Pilih file SQL
4. Klik **Go**
5. Ulangi untuk file berikutnya

---

## Langkah 4: Konfigurasi Environment

### 4.1 Copy File `.env.example`

```bash
# Windows (PowerShell)
Copy-Item .env.example .env

# Mac/Linux
cp .env.example .env
```

### 4.2 Edit File `.env`

Buka file `.env` dengan text editor, lalu sesuaikan:

```env
# Database - sesuaikan dengan settingan MySQL kamu
DB_HOST=localhost
DB_USER=root
DB_PASS=               # Isi password MySQL (kosong kalau default XAMPP)
DB_NAME=wisata_alam_kaltim

# Base URL - sesuaikan dengan nama folder project kamu
BASE_URL=http://localhost/explore-kaltim/

# Weather API (opsional, kalau mau fitur cuaca jalan)
WEATHER_API_KEY=isi_api_key_openweathermap
```

> 📌 **Penting:** File `.env` ini **JANGAN** di-commit ke Git karena berisi data sensitif!

---

## Langkah 5: Setup File Permissions (Mac/Linux)

Kalau pakai Mac atau Linux, set permission untuk folder upload:

```bash
chmod 755 public/images/destinations
chmod 755 public/images/artikel
```

---

## Langkah 6: Compile Assets (Opsional)

Kalau kamu mau edit CSS/styling:

```bash
# Development mode (auto-refresh saat edit)
npm run dev

# Production build (optimized)
npm run build
```

---

## Langkah 7: Jalankan Project

### Via XAMPP:

1. Start **Apache** dan **MySQL** di XAMPP Control Panel
2. Buka browser: `http://localhost/explore-kaltim/`

### Via PHP Built-in Server:

```bash
php -S localhost:8000
```

Lalu buka: `http://localhost:8000`

---

## Langkah 8: Login Admin

Default akun admin:

- **Username:** `admin`
- **Password:** `admin123`

Panel admin: `http://localhost/explore-kaltim/admin/login`

> ⚠️ **Security:** Jangan lupa ganti password default setelah login pertama kali!

---

## Testing Fitur Translation

1. Klik icon **🌐** di pojok kanan atas navbar
2. Pilih bahasa:
   - 🇮🇩 Indonesia
   - 🇬🇧 English
3. Halaman akan reload dengan bahasa yang dipilih

---

## Troubleshooting

### Database connection error?

- Cek setting di file `.env` sudah benar
- Pastikan MySQL service sudah jalan
- Test koneksi database via phpMyAdmin

### Translation tidak muncul?

- Pastikan sudah import `translation_updates.sql`
- Clear browser cache (Ctrl + Shift + R)

### Upload image gagal?

- Cek folder `public/images/destinations` bisa di-write
- Pastikan ukuran file tidak melebihi limit PHP (default 2MB)

### CSS tidak muncul?

- Run `npm run build` untuk compile Tailwind CSS
- Atau copy file `public/css/output.css` dari backup

---

## Production Deployment

Sebelum deploy ke server production:

1. **Update `.env`**

   ```env
   APP_ENV=production
   BASE_URL=https://domain-kamu.com/
   ```

2. **Optimize Autoloader**

   ```bash
   composer install --optimize-autoloader --no-dev
   ```

3. **Build Assets**

   ```bash
   npm run build
   ```

4. **Set Permissions**

   ```bash
   chmod 644 .env
   chmod -R 755 public/images
   ```

5. **Backup Database**
   ```bash
   mysqldump -u root -p wisata_alam_kaltim > backup.sql
   ```

---

## Support

Kalau ada kesulitan atau menemukan bug:

- Buat issue di repository
- Atau hubungi tim developer

**Selamat Menggunakan!**
