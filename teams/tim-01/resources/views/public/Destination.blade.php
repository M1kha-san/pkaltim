<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Kaltim - Jelajahi Borneo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#10B981', 
                            600: '#059669',
                            900: '#064e3b',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        *, *::before, *::after {
            transition-property: background-color, border-color, color, fill, stroke, box-shadow;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
        
        img {
            transition-property: transform; 
        }
    </style>
</head>
<body class="bg-[#F8F9FA] dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    <nav class="fixed w-full z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md shadow-sm border-b border-gray-100 dark:border-gray-800">
        <div class="container mx-auto px-4 md:px-8 h-20 flex justify-between items-center">
            
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 rounded-lg bg-brand-500 flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                </div>
                <span class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">Wisata<span class="text-brand-500">Kaltim</span></span>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="text-sm font-medium hover:text-brand-500">Jelajahi</a>
                <a href="#" class="text-sm font-medium hover:text-brand-500">Paket Wisata</a>
                <a href="#" class="text-sm font-medium hover:text-brand-500">Tentang Kami</a>
            </div>

            <div class="flex items-center gap-4">
            <button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 dark:text-gray-400">
                                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                            </button>
                            <a href="{{ route('login') }}" class="hidden md:block text-sm font-semibold hover:text-brand-500">Masuk</a>
            </div>
        </div>
    </nav>

    <header class="relative pt-32 pb-20 md:pt-48 md:pb-32 overflow-hidden">
        <div class="absolute top-24 left-4 md:left-8 z-30">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 rounded-full text-white transition-all duration-300 group shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="text-sm font-medium tracking-wide">Kembali ke Beranda</span>
            </a>
        </div>
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1540206351-d6465b3ac5c1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Kalimantan Nature" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/60 via-gray-900/40 to-[#F8F9FA] dark:to-gray-900"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-md text-white text-xs font-medium tracking-wider mb-4 border border-white/30">EKSPLORASI KALIMANTAN TIMUR</span>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Jelajahi Permata Alam <br> <span class="text-brand-500">Borneo</span>
            </h1>
            <p class="text-gray-200 text-lg md:text-xl max-w-2xl mx-auto mb-10 font-light">
                Dari kedalaman hutan hujan tropis hingga keindahan bawah laut Kepulauan Derawan. Alami keajaiban alam yang autentik.
            </p>

            <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-2 rounded-full shadow-2xl flex flex-col md:flex-row items-center gap-2">
                <div class="flex-1 flex items-center px-6 w-full h-12">
                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" placeholder="Mau kemana hari ini?" class="w-full bg-transparent outline-none text-gray-700 dark:text-gray-200 placeholder-gray-400">
                </div>
                <button class="w-full md:w-auto px-8 py-3 rounded-full bg-brand-500 hover:bg-brand-600 text-white font-bold shadow-lg shadow-brand-500/30">
                    Cari Wisata
                </button>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 md:px-8 pb-20 -mt-10 relative z-20">
        <div class="flex flex-col lg:flex-row gap-8">

            <aside class="w-full lg:w-3/12 space-y-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 sticky top-24">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-lg">Filter</h3>
                        <button class="text-xs text-brand-500 font-semibold hover:underline" onclick="window.location.reload()">Reset</button>
                    </div>

                    <div class="mb-8">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Kategori</h4>
                        <div class="space-y-3">
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="checkbox" checked class="w-5 h-5 rounded border-gray-300 text-brand-500 focus:ring-brand-500">
                                <span class="group-hover:text-brand-500">Semua Wisata</span>
                            </label>
                            @foreach(['Hutan Lindung', 'Sungai & Danau', 'Pantai & Kepulauan', 'Gua & Karst'] as $cat)
                            <label class="flex items-center space-x-3 cursor-pointer group">
                                <input type="checkbox" class="w-5 h-5 rounded border-gray-300 text-brand-500 focus:ring-brand-500">
                                <span class="text-gray-600 dark:text-gray-400 group-hover:text-brand-500">{{ $cat }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Maksimal Harga</h4>
                            <span id="price-label" class="text-xs font-bold text-brand-600 bg-brand-50 dark:bg-brand-900/30 px-2 py-1 rounded-md border border-brand-100 dark:border-brand-900">
                                IDR 5.000.000
                            </span>
                        </div>

                        <div class="relative w-full">
                            <input 
                                id="price-range" 
                                type="range" 
                                min="0" 
                                max="5000000" 
                                step="50000" 
                                value="5000000" 
                                class="w-full h-2 bg-gray-200 dark:bg-gray-600 rounded-lg appearance-none cursor-pointer accent-brand-500 hover:accent-brand-600 focus:outline-none"
                            >
                            <div class="flex justify-between text-[10px] text-gray-400 mt-2 font-medium">
                                <span>IDR 0</span>
                                <span>IDR 5jt+</span>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-2 italic">*Geser untuk filter (kelipatan 50rb)</p>
                    </div>
                    <div class="bg-brand-50 dark:bg-brand-900/20 rounded-xl p-5 mt-6 text-center border border-brand-100 dark:border-brand-900">
                        <p class="text-sm font-medium text-brand-800 dark:text-brand-200 mb-3">Butuh bantuan merencanakan perjalanan?</p>
                        <button class="w-full py-2 bg-white dark:bg-gray-800 text-brand-600 font-bold text-xs rounded-lg shadow hover:shadow-md">Hubungi Konsultan</button>
                    </div>
                </div>
            </aside>

            <div class="w-full lg:w-9/12">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <p class="text-gray-500 mb-4 md:mb-0">Menampilkan <span id="count-display" class="font-bold text-gray-900 dark:text-white">{{ $destinations->count() }}</span> Destinasi</p>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500">Urutkan:</span>
                        <select class="bg-transparent font-bold text-gray-900 dark:text-white border-none focus:ring-0 cursor-pointer text-sm">
                            <option>Terpopuler</option>
                            <option>Harga Terendah</option>
                            <option>Rating Tertinggi</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="destination-grid">
                    @forelse($destinations as $item)
                    <div class="destination-card bg-white dark:bg-gray-800 rounded-2xl p-3 shadow-sm hover:shadow-xl group border border-gray-100 dark:border-gray-700 flex flex-col h-full"
                         data-price="{{ $item->price ?? 0 }}">
                        
                        <div class="relative rounded-xl overflow-hidden h-48 mb-4">
                            @if($item->images->count() > 0)
                                <img src="{{ asset('storage/' . $item->images->first()->path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            @else
                                <img src="https://source.unsplash.com/400x300/?nature,water" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            @endif
                            
                            <span class="absolute top-3 left-3 bg-brand-500 text-white text-[10px] font-bold px-2 py-1 rounded-md shadow-md uppercase tracking-wide">
                                {{ $item->category->name ?? 'Wisata' }}
                            </span>

                            <div class="absolute top-3 right-3 bg-white dark:bg-gray-900 text-xs font-bold px-2 py-1 rounded-md flex items-center shadow-md">
                                <svg class="w-3 h-3 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                4.8
                            </div>
                        </div>

                        <div class="px-2 pb-2 flex flex-col flex-grow">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1 line-clamp-1 group-hover:text-brand-500">{{ $item->name }}</h3>
                            
                            <div class="flex items-center text-gray-400 text-xs mb-4">
                                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $item->location ?? 'Kalimantan Timur' }}
                            </div>

                            <div class="mt-auto flex items-end justify-between border-t border-gray-50 dark:border-gray-700 pt-3">
                                <div>
                                    <p class="text-[10px] text-gray-400 uppercase font-semibold">Mulai Dari</p>
                                    <p class="font-bold text-gray-900 dark:text-white">IDR {{ number_format($item->price ?? 0, 0, ',', '.') }}</p>
                                </div>
                                <a href="{{ url('detail/' . $item->slug) }}" class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-500 group-hover:bg-brand-500 group-hover:text-white transform group-hover:rotate-45">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-20 bg-white dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300">
                        <p class="text-gray-400">Belum ada data wisata.</p>
                    </div>
                    @endforelse
                </div>

                <div id="no-result-message" class="hidden text-center py-20 bg-white dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300 mt-6">
                    <p class="text-gray-400">Tidak ada wisata dengan range harga tersebut.</p>
                </div>

                <div class="mt-10 flex justify-center">
                    <button class="px-8 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full text-sm font-bold shadow hover:bg-gray-50 dark:hover:bg-gray-700">
                        Muat Lebih Banyak
                    </button>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 pt-16 pb-8">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-wrap justify-between mb-12">
                <div class="w-full md:w-1/3 mb-8 md:mb-0">
                    <a href="#" class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-brand-500 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Wisata<span class="text-brand-500">Kaltim</span></span>
                    </a>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-xs">
                        Platform resmi pariwisata Kalimantan Timur. Menghubungkan Anda dengan keindahan alam Borneo yang tak terlupakan.
                    </p>
                </div>
                <div class="w-1/2 md:w-auto mb-8">
                    <h5 class="font-bold text-gray-900 dark:text-white mb-4">Destinasi</h5>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-brand-500">Berau & Derawan</a></li>
                        <li><a href="#" class="hover:text-brand-500">Kutai Kartanegara</a></li>
                        <li><a href="#" class="hover:text-brand-500">Mahakam Ulu</a></li>
                        <li><a href="#" class="hover:text-brand-500">Samarinda</a></li>
                    </ul>
                </div>
                <div class="w-1/2 md:w-auto mb-8">
                    <h5 class="font-bold text-gray-900 dark:text-white mb-4">Informasi</h5>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-brand-500">Panduan Wisata</a></li>
                        <li><a href="#" class="hover:text-brand-500">Blog Travel</a></li>
                        <li><a href="#" class="hover:text-brand-500">Kontak Kami</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-auto">
                    <h5 class="font-bold text-gray-900 dark:text-white mb-4">Ikuti Kami</h5>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 hover:bg-brand-500 hover:text-white"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 hover:bg-brand-500 hover:text-white"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.072 3.269.153 5.023 1.938 5.176 5.176.06 1.265.071 1.645.071 4.851 0 3.205-.012 3.584-.072 4.849-.153 3.269-1.938 5.021-5.176 5.176-1.266.06-1.646.072-4.85.072-3.205 0-3.584-.012-4.85-.072-3.269-.153-5.021-1.938-5.176-5.176-.06-1.265-.072-1.644-.072-4.849 0-3.204.012-3.583.072-4.849.153-3.269 1.938-5.021 5.176-5.176 1.266-.06 1.645-.072 4.85-.072zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-100 dark:border-gray-800 pt-8 text-center">
                <p class="text-xs text-gray-400">© 2026 Wisata Kaltim. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            lightIcon.classList.remove('hidden');
            document.documentElement.classList.add('dark');
        } else {
            darkIcon.classList.remove('hidden');
            document.documentElement.classList.remove('dark');
        }

        themeToggleBtn.addEventListener('click', function() {
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.getElementById('price-range');
            const label = document.getElementById('price-label');
            const cards = document.querySelectorAll('.destination-card');
            const noResult = document.getElementById('no-result-message');
            const countDisplay = document.getElementById('count-display');

            // Format Rupiah
            const formatRupiah = (number) => {
                return new Intl.NumberFormat('id-ID', { 
                    style: 'currency', 
                    currency: 'IDR', 
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(number);
            };

            // Event Listener Slider
            slider.addEventListener('input', function () {
                const maxPrice = parseInt(this.value);
                
                // 1. Update Label Harga
                label.innerText = formatRupiah(maxPrice);

                // 2. Filter Logika
                let visibleCount = 0;
                
                cards.forEach(card => {
                    const itemPrice = parseInt(card.getAttribute('data-price'));

                    if (itemPrice <= maxPrice) {
                        card.style.display = 'flex'; // Gunakan flex agar layout card tidak rusak
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // 3. Update Jumlah dan Pesan Kosong
                if (countDisplay) countDisplay.innerText = visibleCount + " Destinasi";

                if (visibleCount === 0) {
                    noResult.classList.remove('hidden');
                } else {
                    noResult.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>