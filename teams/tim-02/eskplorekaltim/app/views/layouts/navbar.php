<!-- Navigation Bar -->
<nav id="mainNavbar" class="fixed w-full top-0 left-0 z-50 transition-all duration-500">
    <div class="container mx-auto px-6 py-5 transition-all duration-500" id="navContainer">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="<?= BASE_URL ?>" class="flex items-center space-x-3 group z-50 relative">
                <div class="w-10 h-10 rounded-full bg-custom-accent/20 flex items-center justify-center group-hover:bg-custom-accent/30 transition-all duration-300">
                    <i class="fas fa-leaf text-xl text-custom-accent"></i>
                </div>
                <span class="text-2xl font-display font-bold tracking-tight text-white group-hover:text-custom-accent transition-colors duration-300">
                    Explore<span class="text-custom-accent">Kaltim</span>
                </span>
            </a>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="<?= BASE_URL ?>" class="nav-link text-white hover:text-custom-accent font-medium text-sm uppercase tracking-wider transition-all duration-300 relative py-2">
                    <?= Language::get('nav.home', 'Beranda') ?>
                    <span class="nav-underline absolute bottom-0 left-0 w-0 h-0.5 bg-custom-accent transition-all duration-300"></span>
                </a>
                <a href="<?= BASE_URL ?>#tentang" class="nav-link text-gray-300 hover:text-white font-medium text-sm uppercase tracking-wider transition-all duration-300 relative py-2">
                    <?= Language::get('nav.about', 'Tentang') ?>
                    <span class="nav-underline absolute bottom-0 left-0 w-0 h-0.5 bg-custom-accent transition-all duration-300"></span>
                </a>
                <a href="<?= BASE_URL ?>destinasi" class="nav-link text-gray-300 hover:text-white font-medium text-sm uppercase tracking-wider transition-all duration-300 relative py-2">
                    <?= Language::get('nav.destinations', 'Destinasi') ?>
                    <span class="nav-underline absolute bottom-0 left-0 w-0 h-0.5 bg-custom-accent transition-all duration-300"></span>
                </a>
                
                <!-- Language Switcher -->
                <div class="relative language-switcher">
                    <button id="langBtn" class="text-gray-300 hover:text-white font-medium transition-all duration-300 flex items-center gap-2 py-2" aria-label="Change Language">
                        <i class="fas fa-globe text-lg"></i>
                        <span class="uppercase text-sm"><?= Language::getCurrentLanguage() ?? 'ID' ?></span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div id="langDropdown" class="absolute top-full right-0 mt-2 w-40 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden opacity-0 invisible transform translate-y-2 transition-all duration-300">
                        <form method="POST" action="<?= BASE_URL ?>language/switch">
                            <button type="submit" name="lang" value="id" class="w-full px-4 py-3 flex items-center gap-3 hover:bg-gray-50 transition-colors text-left <?= Language::getCurrentLanguage() === 'id' ? 'bg-custom-accent/10' : '' ?>">
                                <span class="text-xl">🇮🇩</span>
                                <span class="text-sm font-medium text-gray-700">Indonesia</span>
                                <?php if (Language::getCurrentLanguage() === 'id'): ?>
                                <i class="fas fa-check ml-auto text-custom-secondary"></i>
                                <?php endif; ?>
                            </button>
                            <button type="submit" name="lang" value="en" class="w-full px-4 py-3 flex items-center gap-3 hover:bg-gray-50 transition-colors text-left <?= Language::getCurrentLanguage() === 'en' ? 'bg-custom-accent/10' : '' ?>">
                                <span class="text-xl">🇬🇧</span>
                                <span class="text-sm font-medium text-gray-700">English</span>
                                <?php if (Language::getCurrentLanguage() === 'en'): ?>
                                <i class="fas fa-check ml-auto text-custom-secondary"></i>
                                <?php endif; ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn" class="md:hidden focus:outline-none text-white z-50 relative w-10 h-10 flex items-center justify-center" aria-label="Toggle Menu">
                <i id="menuIcon" class="fas fa-bars text-2xl transition-transform duration-300"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div id="mobileMenuOverlay" class="fixed inset-0 bg-custom-primary/95 backdrop-blur-xl z-40 opacity-0 invisible transition-all duration-500 md:hidden">
    <div class="h-full flex flex-col items-center justify-center space-y-8">
        <a href="<?= BASE_URL ?>" class="mobile-link text-white text-3xl font-display font-bold hover:text-custom-accent transition-all duration-300 transform translate-y-4 opacity-0">
            <?= Language::get('nav.home', 'Beranda') ?>
        </a>
        <a href="<?= BASE_URL ?>#tentang" class="mobile-link text-white text-3xl font-display font-bold hover:text-custom-accent transition-all duration-300 transform translate-y-4 opacity-0">
            <?= Language::get('nav.about', 'Tentang') ?>
        </a>
        <a href="<?= BASE_URL ?>destinasi" class="mobile-link text-white text-3xl font-display font-bold hover:text-custom-accent transition-all duration-300 transform translate-y-4 opacity-0">
            <?= Language::get('nav.destinations', 'Destinasi') ?>
        </a>
        
        <!-- Mobile Language Switcher -->
        <div class="mobile-link transform translate-y-4 opacity-0">
            <form method="POST" action="<?= BASE_URL ?>language/switch" class="flex items-center gap-4">
                <button type="submit" name="lang" value="id" class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl border-2 transition-all duration-300 <?= Language::getCurrentLanguage() === 'id' ? 'border-custom-accent bg-custom-accent/20' : 'border-white/20 hover:border-white/40' ?>">
                    🇮🇩
                </button>
                <button type="submit" name="lang" value="en" class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl border-2 transition-all duration-300 <?= Language::getCurrentLanguage() === 'en' ? 'border-custom-accent bg-custom-accent/20' : 'border-white/20 hover:border-white/40' ?>">
                    🇬🇧
                </button>
            </form>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    // Navbar elements
    const navbar = document.getElementById('mainNavbar');
    const navContainer = document.getElementById('navContainer');
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mobileOverlay = document.getElementById('mobileMenuOverlay');
    const menuIcon = document.getElementById('menuIcon');
    const mobileLinks = document.querySelectorAll('.mobile-link');
    const navLinks = document.querySelectorAll('.nav-link');
    
    // Navbar scroll effect
    let lastScrollY = window.scrollY;
    let ticking = false;
    
    // Detect if on homepage
    const isHomePage = window.location.pathname === '<?= BASE_URL ?>' || 
                       window.location.pathname === '<?= BASE_URL ?>home' ||
                       window.location.pathname.endsWith('/pkaltim-tim02-main/') ||
                       window.location.pathname.endsWith('/pkaltim-tim02-main');
    
    function updateNavbar() {
        const scrollY = window.scrollY;
        
        // Always show solid background on non-home pages
        if (!isHomePage || scrollY > 50) {
            navbar.style.backgroundColor = 'rgba(6, 30, 41, 0.95)';
            navbar.style.backdropFilter = 'blur(20px)';
            navbar.style.borderBottom = '1px solid rgba(95, 149, 152, 0.1)';
            navbar.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.1)';
            navContainer.style.paddingTop = '1rem';
            navContainer.style.paddingBottom = '1rem';
        } else {
            // Transparent only on homepage at top
            navbar.style.backgroundColor = 'transparent';
            navbar.style.backdropFilter = 'none';
            navbar.style.borderBottom = 'none';
            navbar.style.boxShadow = 'none';
            navContainer.style.paddingTop = '1.25rem';
            navContainer.style.paddingBottom = '1.25rem';
        }
        
        lastScrollY = scrollY;
        ticking = false;
    }
    
    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(updateNavbar);
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', onScroll, { passive: true });
    updateNavbar(); // Initial call
    
    // Nav link hover effect
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            const underline = this.querySelector('.nav-underline');
            if (underline) {
                underline.style.width = '100%';
            }
        });
        
        link.addEventListener('mouseleave', function() {
            const underline = this.querySelector('.nav-underline');
            if (underline) {
                underline.style.width = '0%';
            }
        });
    });
    
    // Mobile menu toggle
    let isMenuOpen = false;
    
    mobileBtn.addEventListener('click', function() {
        isMenuOpen = !isMenuOpen;
        
        if (isMenuOpen) {
            // Open menu
            mobileOverlay.classList.remove('invisible');
            mobileOverlay.classList.add('opacity-100');
            menuIcon.classList.remove('fa-bars');
            menuIcon.classList.add('fa-times');
            menuIcon.style.transform = 'rotate(90deg)';
            document.body.style.overflow = 'hidden';
            
            // Animate links in
            mobileLinks.forEach((link, index) => {
                setTimeout(() => {
                    link.style.transform = 'translateY(0)';
                    link.style.opacity = '1';
                }, index * 100);
            });
        } else {
            // Close menu
            closeMenu();
        }
    });
    
    function closeMenu() {
        mobileOverlay.classList.remove('opacity-100');
        mobileOverlay.classList.add('invisible');
        menuIcon.classList.remove('fa-times');
        menuIcon.classList.add('fa-bars');
        menuIcon.style.transform = 'rotate(0deg)';
        document.body.style.overflow = '';
        isMenuOpen = false;
        
        // Reset links
        mobileLinks.forEach(link => {
            link.style.transform = 'translateY(1rem)';
            link.style.opacity = '0';
        });
    }
    
    // Language dropdown toggle
    const langBtn = document.getElementById('langBtn');
    const langDropdown = document.getElementById('langDropdown');
    
    if (langBtn && langDropdown) {
        langBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isVisible = !langDropdown.classList.contains('invisible');
            
            if (isVisible) {
                langDropdown.classList.add('invisible', 'opacity-0', 'translate-y-2');
            } else {
                langDropdown.classList.remove('invisible', 'opacity-0', 'translate-y-2');
            }
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!langBtn.contains(e.target) && !langDropdown.contains(e.target)) {
                langDropdown.classList.add('invisible', 'opacity-0', 'translate-y-2');
            }
        });
        
        // Close dropdown on language change
        langDropdown.querySelectorAll('button[type="submit"]').forEach(btn => {
            btn.addEventListener('click', function() {
                langDropdown.classList.add('invisible', 'opacity-0', 'translate-y-2');
            });
        });
    }
    
    // Close menu when clicking on a link
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });
    
    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMenuOpen) {
            closeMenu();
        }
    });
})();
</script>
