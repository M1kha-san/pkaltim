    <!-- Footer -->
    <footer class="bg-custom-primary text-gray-400 font-light border-t border-custom-secondary/30">
        <div class="container mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- About Section -->
                <div class="col-span-1 md:col-span-2">
                    <a href="<?= BASE_URL ?>" class="flex items-center space-x-2 group mb-6">
                        <i class="fas fa-leaf text-2xl text-custom-accent"></i>
                        <span class="text-2xl font-display font-bold tracking-tight text-white">
                            Explore<span class="text-custom-accent">Kaltim</span>
                        </span>
                    </a>
                    <p class="mb-8 leading-relaxed max-w-md text-sm">
                        Platform informasi wisata alam premium Kalimantan Timur. Kami menghadirkan referensi destasi eksotis dari hutan hujan hingga surga bawah laut, didedikasikan untuk pelestarian dan apresiasi alam Borneo.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="w-10 h-10 rounded-full border border-custom-secondary flex items-center justify-center text-custom-accent hover:bg-custom-accent hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-custom-secondary flex items-center justify-center text-custom-accent hover:bg-custom-accent hover:text-white transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-custom-secondary flex items-center justify-center text-custom-accent hover:bg-custom-accent hover:text-white transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-custom-secondary flex items-center justify-center text-custom-accent hover:bg-custom-accent hover:text-white transition duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-display font-bold text-lg mb-6">Eksplorasi</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="<?= BASE_URL ?>" class="hover:text-custom-accent transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-custom-secondary"></i>Beranda</a></li>
                        <li><a href="<?= BASE_URL ?>destinasi" class="hover:text-custom-accent transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-custom-secondary"></i>Semua Destinasi</a></li>
                        <li><a href="#" class="hover:text-custom-accent transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-custom-secondary"></i>Kategori Populer</a></li>
                        <li><a href="#galeri" class="hover:text-custom-accent transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-custom-secondary"></i>Galeri Alam</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h4 class="text-white font-display font-bold text-lg mb-6">Hubungi Kami</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-custom-accent"></i>
                            <span>Samarinda, Kalimantan Timur,<br>Indonesia</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-custom-accent"></i>
                            <span>halo@explorekaltim.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-custom-accent"></i>
                            <span>+62 812 3456 7890</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-custom-secondary/30 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <p>&copy; <?= date('Y') ?> Kelompok 02. All rights reserved.</p>
                <div class="mt-4 md:mt-0 flex space-x-6">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript -->
    <script src="<?= BASE_URL ?>public/js/main.js"></script>
    
    <!-- GLightbox JS -->
    <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>
    <script>
        // Initialize GLightbox for gallery
        if (typeof GLightbox !== 'undefined') {
            const lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true,
                zoomable: true,
                draggable: true,
                slideEffect: 'zoom'
            });
        }
    </script>
</body>
</html>
