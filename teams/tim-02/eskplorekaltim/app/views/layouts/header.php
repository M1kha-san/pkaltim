<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . ' - ' : '' ?><?= APP_NAME ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? $pageDescription : 'Jelajahi keindahan wisata alam Kalimantan Timur' ?>">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <link href="<?= BASE_URL ?>public/css/output.css" rel="stylesheet">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- GLightbox for Photo Gallery -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css">
    
    <!-- Leaflet Maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- Custom Styles -->
    <style>
        /* ========================================
           CUSTOM COLOR PALETTE
           ======================================== */
        :root {
            --color-primary: #061E29;   /* Deep Navy/Black */
            --color-secondary: #1D546D; /* Ocean Teal */
            --color-accent: #5F9598;    /* Soft Cyan */
            --color-light: #F3F4F4;     /* Off White */
        }

        /* ========================================
           GLOBAL STYLES
           ======================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--color-light);
            color: var(--color-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }
        
        /* Font Display for Headings */
        .font-display {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }
        
        /* Enhanced Typography */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            letter-spacing: -0.01em;
        }
        
        button, .btn {
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            letter-spacing: 0.02em;
        }
        
        /* ========================================
           CUSTOM UTILITY CLASSES
           ======================================== */
        .bg-custom-primary { background-color: var(--color-primary); }
        .bg-custom-secondary { background-color: var(--color-secondary); }
        .bg-custom-accent { background-color: var(--color-accent); }
        .bg-custom-light { background-color: var(--color-light); }
        
        .text-custom-primary { color: var(--color-primary); }
        .text-custom-secondary { color: var(--color-secondary); }
        .text-custom-accent { color: var(--color-accent); }
        .text-custom-light { color: var(--color-light); }
        
        .border-custom-primary { border-color: var(--color-primary); }
        .border-custom-secondary { border-color: var(--color-secondary); }
        .border-custom-accent { border-color: var(--color-accent); }

        /* ========================================
           GLASSMORPHISM EFFECTS
           ======================================== */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .glass-dark {
            background: rgba(6, 30, 41, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(95, 149, 152, 0.1);
        }

        /* ========================================
           TEXT & SHADOW UTILITIES
           ======================================== */
        .text-shadow-lg {
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }
        
        .drop-shadow-2xl {
            filter: drop-shadow(0 25px 25px rgba(0, 0, 0, 0.4));
        }
        
        /* ========================================
           LINE CLAMP UTILITIES
           ======================================== */
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* ========================================
           SWIPER CUSTOMIZATION
           ======================================== */
        .swiper-button-next-custom,
        .swiper-button-prev-custom {
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            user-select: none;
        }
        
        .swiper-button-next-custom:hover,
        .swiper-button-prev-custom:hover {
            transform: scale(1.05);
        }
        
        .swiper-button-next-custom:active,
        .swiper-button-prev-custom:active {
            transform: scale(0.95);
        }
        
        /* ========================================
           CUSTOM SCROLLBAR
           ======================================== */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--color-light);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--color-secondary);
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--color-accent);
        }
    </style>
</head>
<body class="antialiased">
    <!-- Initialize AOS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                once: true,
                offset: 120,
                easing: 'ease-out-cubic',
                delay: 50
            });
        });
    </script>
    
    <?php include VIEW_PATH . '/layouts/navbar.php'; ?>
