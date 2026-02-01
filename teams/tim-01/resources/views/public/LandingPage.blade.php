@extends('layouts.app')

@section('title', 'Jelajahi Permata Alam')

@section('content')
    <!-- Hero Section -->
    <!-- Added -mt-20 to pull hero up behind the fixed navbar (counteracting main's pt-20) -->
    <header class="relative pt-32 pb-32 md:pt-48 md:pb-40 overflow-hidden -mt-20">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?q=80&w=1948&auto=format&fit=crop"
                alt="Kalimantan Nature" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/70 via-gray-900/50 to-[#F8F9FA] dark:to-gray-900">
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
        
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Jelajahi Wisata Alam<br> <span class="text-brand-500">Kalimantan Timur</span>
            </h1>
            <p class="text-gray-200 text-lg max-w-2xl mx-auto mb-10 font-light leading-relaxed">
                Mulai dari hutan hujan tropis yang alami hingga keindahan laut di Kepulauan Derawan. Nikmati pengalaman wisata yang autentik di tanah Borneo.
            </p>
        </div>
    </header>

    <!-- Main Content Wrapper (was <main>) -->
    <div class="container mx-auto px-4 md:px-8 pb-20 -mt-20 relative z-20 space-y-20">

        <!-- Features Grid -->
        <section>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div
                        class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Jungle Trekking</span>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div
                        class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064">
                            </path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Island Hopping</span>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div
                        class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Wildlife</span>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div
                        class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">River Cruise</span>
                </div>
            </div>
        </section>

        <!-- Ionic Destinations -->
        <section>
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Destinasi</h2>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Pilihan terbaik untuk petualangan Anda di Bumi
                        Etam.</p>
                </div>
                <a href="{{ route('destination.index') }}"
                    class="hidden md:flex text-brand-500 dark:text-brand-400 font-semibold hover:underline items-center gap-1 group">
                    Lihat Semua <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach($destinations as $item)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg border border-gray-100 dark:border-gray-700 group hover:shadow-xl transition duration-300">

                        <div class="relative h-56 overflow-hidden">
                            @php
                                $imagePath = $item->images->first()
                                    ? asset('storage/' . $item->images->first()->path)
                                    : 'https://via.placeholder.com/400x300?text=No+Image';
                            @endphp

                            <img src="{{ $imagePath }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                alt="{{ $item->name }}">

                            <div
                                class="absolute top-4 right-4 bg-white/90 dark:bg-gray-900/90 backdrop-blur px-2.5 py-1 rounded-lg text-xs font-bold shadow-sm flex items-center gap-1">
                                <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                {{ $item->rating ?? 'New' }}
                            </div>
                        </div>

                        <div class="p-5">
                            <p class="text-xs text-brand-500 font-semibold mb-1 uppercase tracking-wide">
                                {{ $item->location ?? 'Kalimantan Timur' }}
                            </p>

                            <h3
                                class="font-bold text-gray-900 dark:text-white text-lg mb-4 group-hover:text-brand-500 transition line-clamp-1">
                                <a href="{{ route('destinations.show', $item->slug) }}">
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

                                <button
                                    class="w-8 h-8 rounded-full bg-gray-50 dark:bg-gray-700 flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


        <section
            class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-brand-50 dark:bg-gray-800/50 rounded-[2.5rem] overflow-hidden">
            <div class="p-10 md:p-16 flex flex-col justify-center">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Menjaga Paru-Paru Dunia</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                    Kalimantan Timur adalah benteng terakhir hutan hujan tropis kita. Kontribusi perjalanan Anda
                    mendukung pelestarian habitat.
                </p>

                <div class="space-y-6">
                    <div
                        class="flex gap-4 p-4 rounded-xl bg-white dark:bg-gray-800 shadow-sm border border-brand-100 dark:border-gray-700">
                        <div
                            class="w-10 h-10 bg-brand-100 dark:bg-brand-900/30 rounded-lg flex-shrink-0 flex items-center justify-center text-brand-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white">Reboisasi Aktif</h4>
                            <p class="text-sm text-gray-500 mt-1">Program penanaman kembali di area bekas tambang.</p>
                        </div>
                    </div>
                    <div
                        class="flex gap-4 p-4 rounded-xl bg-white dark:bg-gray-800 shadow-sm border border-brand-100 dark:border-gray-700">
                        <div
                            class="w-10 h-10 bg-brand-100 dark:bg-brand-900/30 rounded-lg flex-shrink-0 flex items-center justify-center text-brand-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
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
                    <svg class="w-24 h-24 mx-auto mb-6 opacity-90" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <h3 class="text-2xl font-bold uppercase tracking-widest border-y border-white/40 py-4 inline-block">
                        Sustainable<br>Tourism</h3>
                </div>
            </div>
        </section>

    </div>
@endsection