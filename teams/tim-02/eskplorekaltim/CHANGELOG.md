# Changelog

All notable changes to ExploreKaltim project will be documented here.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/).

---

## [1.1.0] - 2026-02-01

### Added

- ✨ Multi-language system (Indonesia & English)
- 🌐 Language switcher UI di navbar
- 🗄️ Translation management via admin panel
- 📍 Interactive maps dengan Leaflet.js
- 🖼️ Lightbox gallery untuk foto destinasi
- ☁️ Real-time weather widget untuk 4 kota di Kaltim
- 📱 Fully responsive design untuk mobile
- 🔄 Swiper carousel untuk featured destinations
- 🎨 AOS scroll animations
- 📋 Comprehensive setup documentation

### Changed

- 🔧 Refactored environment configuration dengan phpdotenv
- 📝 Updated README dengan format lebih friendly
- 🎨 Improved UI/UX dengan Tailwind CSS
- 🗃️ Optimized database queries dengan prepared statements
- 📁 Reorganized project structure

### Security

- 🔐 Implemented prepared statements untuk SQL injection prevention
- 🛡️ Added XSS prevention dengan htmlspecialchars
- 🔑 Password hashing dengan bcrypt
- 🚫 Environment variables tidak di-commit ke Git
- 🔒 Proper session management

### Documentation

- 📚 Added SETUP-GUIDE.md untuk detailed installation
- 🤝 Added CONTRIBUTING.md untuk contributor guidelines
- 🌍 Added TRANSLATION-FIX.md untuk multi-language guide
- 📄 Added LICENSE file (MIT)
- 📝 Updated all documentation dengan bahasa yang lebih accessible

---

## [1.0.0] - 2026-01-15

### Added

- 🎉 Initial release
- 🏠 Homepage dengan hero section & featured destinations
- 🗺️ Destinasi list page dengan search & filter
- 📄 Detail page untuk setiap destinasi
- 👤 Admin panel untuk manage content
- 🔐 User authentication system
- 📊 Dashboard analytics
- 🗄️ Database schema & sample data
- 📁 MVC architecture implementation

### Features

- CRUD operations untuk destinasi, kategori, users
- Upload image functionality
- Role-based access control
- Search & filter destinations
- Category management
- Rating system

---

## Roadmap

### [1.2.0] - Planned

- [ ] User review & rating system
- [ ] Favorite/bookmark destinations
- [ ] Advanced search dengan multiple filters
- [ ] Export destinasi ke PDF
- [ ] Social media sharing
- [ ] Email notification system

### [1.3.0] - Future

- [ ] Mobile app (Progressive Web App)
- [ ] Artikel management (currently disabled)
- [ ] Virtual tour integration
- [ ] Booking/reservation system
- [ ] Integration dengan payment gateway
- [ ] Gamification (badges, points)

---

## Contributing

Lihat [CONTRIBUTING.md](CONTRIBUTING.md) untuk cara berkontribusi.

## Support

- 🐛 Report bugs: [Create an issue](../../issues)
- 💡 Request features: [Start a discussion](../../discussions)

---

**Legend:**

- ✨ New feature
- 🔧 Configuration
- 🐛 Bug fix
- 📝 Documentation
- 🎨 UI/UX improvement
- 🔐 Security
- ♻️ Code refactoring
- 🗃️ Database changes
