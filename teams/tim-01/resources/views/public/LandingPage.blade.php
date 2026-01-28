<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Kaltim - Jelajahi Permata Alam</title>
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
                            500: '#10B981', // Emerald sesuai brand asli
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
    <script>
        // Script sederhana untuk handle dark mode toggle
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            // Change the icons inside the button based on previous settings
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                lightIcon.classList.remove('hidden');
            } else {
                document.documentElement.classList.remove('dark');
                darkIcon.classList.remove('hidden');
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
        });
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Smooth transition for dark mode */
        *, *::before, *::after {
            transition-property: background-color, border-color, color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
        img { transition-property: transform; }
    </style>
</head>
<body class="bg-[#F8F9FA] dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    <nav class="fixed w-full z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md shadow-sm border-b border-gray-100 dark:border-gray-800">
        <div class="container mx-auto px-4 md:px-8 h-20 flex justify-between items-center">
            
            <a href="#" class="flex items-center gap-2 group">
                <div class="w-8 h-8 rounded-lg bg-brand-500 flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                </div>
                <span class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">Wisata<span class="text-brand-500">Kaltim</span></span>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="text-sm font-medium hover:text-brand-500 dark:text-gray-300 dark:hover:text-brand-400">Destinasi</a>
                <a href="#" class="text-sm font-medium hover:text-brand-500 dark:text-gray-300 dark:hover:text-brand-400">Peta Interaktif</a>
                <a href="#" class="text-sm font-medium hover:text-brand-500 dark:text-gray-300 dark:hover:text-brand-400">Konservasi</a>
                <a href="#" class="text-sm font-medium hover:text-brand-500 dark:text-gray-300 dark:hover:text-brand-400">Ekowisata</a>
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

    <header class="relative pt-32 pb-32 md:pt-48 md:pb-40 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?q=80&w=1948&auto=format&fit=crop" alt="Kalimantan Nature" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/70 via-gray-900/50 to-[#F8F9FA] dark:to-gray-900"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <span class="inline-block py-1 px-4 rounded-full bg-white/10 backdrop-blur-md text-white text-xs font-semibold tracking-widest uppercase mb-6 border border-white/20">
                Eksplorasi Kalimantan Timur
            </span>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Jelajahi Permata Alam <br> <span class="text-brand-500">Kalimantan Timur</span>
            </h1>
            <p class="text-gray-200 text-lg max-w-2xl mx-auto mb-10 font-light leading-relaxed">
                Dari kedalaman hutan hujan tropis hingga keajaiban bawah laut Kepulauan Derawan. Alami keajaiban alam Borneo yang autentik.
            </p>
        </div>
    </header>

    <main class="container mx-auto px-4 md:px-8 pb-20 -mt-20 relative z-20 space-y-20">

        <section>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Jungle Trekking</span>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Island Hopping</span>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Wildlife</span>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">River Cruise</span>
                </div>
            </div>
        </section>

        <section>
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Destinasi Ikonik</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Pilihan terbaik untuk petualangan Anda di Bumi Etam.</p>
        </div>
        <a href="{{ route('destination.index') }}" class="hidden md:flex text-brand-500 dark:text-brand-400 font-semibold hover:underline items-center gap-1 group">
            Lihat Semua <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        @foreach($destinations as $item)
        <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg border border-gray-100 dark:border-gray-700 group hover:shadow-xl transition duration-300">
            
            <div class="relative h-56 overflow-hidden">
                @php
                    $imagePath = $item->images->first() 
                        ? asset('storage/' . $item->images->first()->path) 
                        : 'https://via.placeholder.com/400x300?text=No+Image';
                @endphp
                
                <img src="{{ $imagePath }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $item->name }}">
                
                <div class="absolute top-4 right-4 bg-white/90 dark:bg-gray-900/90 backdrop-blur px-2.5 py-1 rounded-lg text-xs font-bold shadow-sm flex items-center gap-1">
                    <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> 
                    {{ $item->rating ?? 'New' }}
                </div>
            </div>

            <div class="p-5">
                <p class="text-xs text-brand-500 font-semibold mb-1 uppercase tracking-wide">
                    {{ $item->location ?? 'Kalimantan Timur' }}
                </p>
                
                <h3 class="font-bold text-gray-900 dark:text-white text-lg mb-4 group-hover:text-brand-500 transition line-clamp-1">
                    <a href="{{ route('destination.show', $item->slug) }}">
                        {{ $item->name }}
                    </a>
                </h3>

                <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-gray-700">
                    <div>
                        <p class="text-xs text-gray-400">Mulai dari</p>
                        <span class="text-brand-600 dark:text-brand-400 font-bold text-lg">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </span>
                    </div>
                    
                    <button class="w-8 h-8 rounded-full bg-gray-50 dark:bg-gray-700 flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
        </div>
</section>

        <section class="bg-white dark:bg-gray-800 rounded-[2.5rem] p-8 md:p-12 shadow-xl border border-gray-100 dark:border-gray-700">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="w-full md:w-1/2">
                    <span class="text-brand-500 font-bold text-xs tracking-widest uppercase mb-3 block">Digital Experience</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">Peta Interaktif Kaltim</h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-8 leading-relaxed">
                        Temukan lokasi-lokasi tersembunyi di seluruh Kalimantan Timur. Dari pesisir hingga pegunungan, peta kami membantu anda merencanakan rute perjalanan dengan lebih efisien.
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            <div class="w-6 h-6 rounded-full bg-brand-100 dark:bg-brand-900/50 flex items-center justify-center text-brand-600 dark:text-brand-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            Titik Point of Interest (POI) Akurat
                        </li>
                        <li class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                            <div class="w-6 h-6 rounded-full bg-brand-100 dark:bg-brand-900/50 flex items-center justify-center text-brand-600 dark:text-brand-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            Informasi Jalur Utama Terkini
                        </li>
                    </ul>
                    <button class="bg-brand-500 hover:bg-brand-600 text-white px-8 py-3 rounded-full font-semibold transition shadow-lg shadow-brand-500/25">
                        Buka Peta Digital
                    </button>
                </div>
                <div class="w-full md:w-1/2 relative group">
                    <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white dark:border-gray-700 rotate-1 group-hover:rotate-0 transition duration-500">
                        <img src="https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?q=80&w=1000&auto=format&fit=crop" class="w-full h-auto object-cover" alt="Map">
                    </div>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-brand-50 dark:bg-gray-800/50 rounded-[2.5rem] overflow-hidden">
            <div class="p-10 md:p-16 flex flex-col justify-center">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Menjaga Paru-Paru Dunia</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                    Kalimantan Timur adalah benteng terakhir hutan hujan tropis kita. Kontribusi perjalanan Anda mendukung pelestarian habitat.
                </p>
                
                <div class="space-y-6">
                    <div class="flex gap-4 p-4 rounded-xl bg-white dark:bg-gray-800 shadow-sm border border-brand-100 dark:border-gray-700">
                        <div class="w-10 h-10 bg-brand-100 dark:bg-brand-900/30 rounded-lg flex-shrink-0 flex items-center justify-center text-brand-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Reboisasi Aktif</h4>
                            <p class="text-sm text-gray-500 mt-1">Program penanaman kembali di area bekas tambang.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-4 rounded-xl bg-white dark:bg-gray-800 shadow-sm border border-brand-100 dark:border-gray-700">
                        <div class="w-10 h-10 bg-brand-100 dark:bg-brand-900/30 rounded-lg flex-shrink-0 flex items-center justify-center text-brand-600">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Perlindungan Satwa</h4>
                            <p class="text-sm text-gray-500 mt-1">Mendukung patroli habitat liar Orangutan.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-[#709536] relative flex items-center justify-center min-h-[300px]">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="text-white text-center z-10 p-8">
                     <svg class="w-24 h-24 mx-auto mb-6 opacity-90" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path></svg>
                     <h3 class="text-2xl font-bold uppercase tracking-widest border-y border-white/40 py-4 inline-block">Sustainable<br>Tourism</h3>
                </div>
            </div>
        </section>

        <section class="bg-gray-900 dark:bg-black rounded-[2.5rem] p-10 md:p-20 text-center relative overflow-hidden">
             <div class="absolute top-0 left-0 w-64 h-64 bg-brand-500/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
             <div class="absolute bottom-0 right-0 w-64 h-64 bg-brand-500/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
             
             <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Siap Menjelajahi Kalimantan?</h2>
                <p class="text-gray-400 mb-10 max-w-lg mx-auto leading-relaxed">Dapatkan panduan wisata eksklusif dan info penawaran tiket kapal/pesawat langsung di inbox Anda.</p>
                
                <form class="flex flex-col md:flex-row gap-4 justify-center max-w-xl mx-auto">
                    <input type="email" placeholder="Alamat email Anda" class="px-6 py-4 rounded-full bg-white/10 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:bg-white/20 w-full md:flex-1 transition">
                    <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white px-8 py-4 rounded-full font-bold transition shadow-lg shadow-brand-500/40">
                        Mulai Sekarang
                    </button>
                </form>
             </div>
        </section>
    </main>

    <footer class="bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 pt-16 pb-8">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                         <div class="w-8 h-8 rounded-lg bg-brand-500 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                        </div>
                        <span class="font-bold text-lg text-gray-900 dark:text-white">Wisata Kaltim</span>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed max-w-xs">
                        Platform informasi pariwisata resmi untuk mengeksplorasi keindahan alam dan budaya Kalimantan Timur.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-6">Navigasi</h4>
                    <ul class="space-y-3 text-sm text-gray-500 dark:text-gray-400">
                        <li><a href="#" class="hover:text-brand-500 transition">Destinasi</a></li>
                        <li><a href="#" class="hover:text-brand-500 transition">Jadwal Penerbangan</a></li>
                        <li><a href="#" class="hover:text-brand-500 transition">Paket Tour</a></li>
                        <li><a href="#" class="hover:text-brand-500 transition">Blog Perjalanan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-6">Bantuan</h4>
                    <ul class="space-y-3 text-sm text-gray-500 dark:text-gray-400">
                        <li><a href="#" class="hover:text-brand-500 transition">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-brand-500 transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-brand-500 transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-brand-500 transition">Kontak Kami</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-6">Sosial Media</h4>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 hover:bg-brand-500 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769 1.079-2.692 3.35-2.692.88 0 1.801.099 1.801.099v1.989z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 hover:bg-brand-500 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-center text-xs text-gray-400 border-t border-gray-100 dark:border-gray-800 pt-8">
                <p>© 2026 Eksplorasi Kalimantan Timur. Seluruh Hak Cipta Dilindungi.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-gray-600 dark:hover:text-gray-300">Kebijakan Cookies</a>
                    <a href="#" class="hover:text-gray-600 dark:hover:text-gray-300">Keamanan</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>