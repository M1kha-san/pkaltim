# Image Upload Directory

Folder ini untuk menyimpan gambar yang di-upload via admin panel.

## Struktur

```
public/images/
├── destinations/     # Foto destinasi wisata
│   └── .gitkeep     # Placeholder agar folder ter-track di Git
├── artikel/         # Thumbnail artikel/blog posts
│   └── .gitkeep
└── reviews/         # Foto review user (future feature)
    └── .gitkeep
```

## Guidelines Upload

### Format yang Diizinkan

- JPG/JPEG
- PNG
- WebP (recommended untuk size kecil)
- GIF (untuk animasi)

### Ukuran Optimal

**Foto Destinasi:**

- Minimum: 800x600px
- Recommended: 1920x1080px (Full HD)
- Maximum: 4000x3000px
- File size: < 5MB

**Thumbnail Artikel:**

- Size: 800x450px (16:9 ratio)
- File size: < 2MB

## Naming Convention

Gunakan kebab-case untuk nama file:

```
✅ Good:
hutan-mangrove-kariangau.jpg
pantai-manggar-segara-sari.png
danau-labuan-cermin-2024.jpg

❌ Bad:
IMG_001.JPG
Foto Pantai.jpg
pantai manggar.PNG
```

## Image Optimization

Sebelum upload, compress image untuk faster loading:

### Tools:

- **TinyPNG** - https://tinypng.com (online, free)
- **ImageOptim** - https://imageoptim.com (Mac)
- **RIOT** - https://riot-optimizer.com (Windows)

### Via Command Line:

```bash
# JPG - dengan ImageMagick
convert input.jpg -quality 85 -strip output.jpg

# PNG - dengan pngquant
pngquant --quality=65-80 input.png --output output.png
```

## Security

Folder ini **tidak** di-commit ke Git (lihat `.gitignore`).

Untuk development, gunakan sample images dari:

- Free stock photos: Unsplash, Pexels
- Atau copy dari `_backup_mock_data/sample_images/`

## Permissions (Linux/Mac)

Set permission agar web server bisa write:

```bash
chmod 755 public/images/destinations
chmod 755 public/images/artikel
```

## Backup

Untuk production, pastikan folder ini ter-backup secara regular:

```bash
# Backup script example
tar -czf images-backup-$(date +%Y%m%d).tar.gz public/images/
```

---

**Note:** File `.gitkeep` hanya sebagai placeholder agar empty folder bisa di-commit ke Git. Folder tetap bisa diisi dengan file lain.
