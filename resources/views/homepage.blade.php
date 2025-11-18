<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LMS-Cerdika') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .hero-pattern {
            background-color: #1e40af;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.12'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        /* Hide scrollbar for category tabs */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        
        <nav class="absolute w-full z-50 top-0 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center">
                        <a href="{{ route('homepage') }}" class="flex items-center gap-2">
                            <div class="bg-white p-1.5 rounded-lg shadow-sm">
                                <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <span class="text-2xl font-bold text-white tracking-tight">LMS-Cerdika</span>
                        </a>
                    </div>

                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-white/90 font-medium hover:text-white transition">Dashboard</a>
                            <a href="{{ route('course.catalog') }}" class="px-5 py-2.5 bg-white/10 backdrop-blur-sm border border-white/20 text-white rounded-full text-sm font-bold hover:bg-white/20 transition">
                                Katalog
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 text-white text-sm font-bold border-2 border-white rounded-full hover:bg-white hover:text-blue-700 transition-all duration-300">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-white text-blue-700 rounded-full text-sm font-bold hover:bg-blue-50 transition shadow-lg shadow-blue-900/20">
                                Daftar Gratis
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <header class="relative bg-blue-700 hero-pattern pt-32 pb-48 overflow-hidden">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-blue-500/30 rounded-full blur-3xl"></div>
                <div class="absolute bottom-[-10%] left-[-10%] w-[600px] h-[600px] bg-indigo-600/30 rounded-full blur-3xl"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-800/50 border border-blue-400/30 text-blue-100 text-xs font-bold tracking-wider mb-6 uppercase">
                    Platform Belajar Masa Depan
                </span>
                <h1 class="text-5xl md:text-6xl font-extrabold text-white tracking-tight mb-6 leading-tight">
                    Bangun Karir Impianmu <br>Bersama <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-indigo-200">LMS Cerdika</span>
                </h1>
                <p class="mt-4 text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed">
                    Akses ribuan materi pembelajaran berkualitas tinggi dari mentor berpengalaman. Tingkatkan skill, raih sertifikat, dan siap kerja.
                </p>
            </div>
        </header>

        <div class="relative z-20 -mt-24 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl shadow-blue-900/10 p-2 md:p-3">
                <form action="{{ route('course.catalog') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                    <div class="flex-grow relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" class="block w-full pl-11 pr-4 py-4 border-none text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-0 rounded-xl bg-gray-50 focus:bg-white transition-colors" placeholder="Cari kursus...">
                    </div>

                    <div class="hidden md:block w-px bg-gray-200 my-2"></div>

                    <div class="relative md:w-auto md:min-w-[220px] group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </div>
                        <select name="category" class="block w-full pl-11 pr-10 py-4 border-none text-gray-900 focus:outline-none focus:ring-0 rounded-xl bg-gray-50 focus:bg-white cursor-pointer appearance-none transition-colors">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <button type="submit" class="md:w-auto px-8 py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-all shadow-lg shadow-blue-600/30 flex items-center justify-center gap-2">
                        Cari Kursus
                    </button>
                </form>
            </div>
        </div>

        <main class="flex-grow py-20">
            
            <section class="py-12 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">
                            Skill yang mengubah karier dan kehidupan Anda
                        </h2>
                        <p class="mt-3 text-lg text-gray-600">
                            Mulai dari topik dengan skill yang sangat penting hingga teknis, LMS-Cerdika mendukung pengembangan profesional Anda.
                        </p>
                    </div>

                    <div class="relative border-b border-gray-200 mb-8">
                        <div class="flex space-x-8 overflow-x-auto no-scrollbar pb-1" id="categoryTabs">
                            <button id="btn-all" onclick="filterCourses('all', this)" class="category-btn whitespace-nowrap pb-3 text-sm font-bold transition-colors border-b-2 text-gray-900 border-gray-900">
                                Semua Kursus
                            </button>
                            @foreach($categories as $category)
                                <button id="btn-{{ $category->slug }}" onclick="filterCourses('{{ $category->slug }}', this)" class="category-btn whitespace-nowrap pb-3 text-sm font-bold transition-colors border-b-2 text-gray-500 border-transparent hover:text-gray-800">
                                    {{ $category->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-8">
                        
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Kursus Pilihan untuk Memulai</h3>
                            <a href="{{ route('course.catalog') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition">
                                Lihat Semua Kursus &rarr;
                            </a>
                        </div>

                        <div id="courseContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 min-h-[300px] transition-opacity duration-300">
                            @include('partials.course-cards', ['courses' => $popularCourses->take(4)])
                        </div>

                        <div class="mt-8 text-center">
                            <a href="{{ route('course.catalog') }}" class="inline-block px-6 py-3 border border-gray-900 text-gray-900 font-bold rounded-md hover:bg-gray-100 transition">
                                Tampilkan semua kursus
                            </a>
                        </div>

                    </div>
                </div>
            </section>

            <section class="py-16 bg-white border-t border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <div class="mb-10">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                            Bergabung dengan mereka yang mengubah hidup melalui belajar
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col h-full">
                            <div class="text-5xl text-gray-900 font-serif leading-none mb-4">“</div>
                            <p class="text-gray-600 text-sm mb-6 flex-grow leading-relaxed">
                                LMS-Cerdika dinilai sebagai platform kursus online terpopuler untuk belajar coding. Materi yang disajikan sangat terstruktur.
                            </p>
                            <div class="flex items-center gap-3 border-t border-gray-50 pt-4 mt-auto">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold text-xs">SO</div>
                                <div>
                                    <h5 class="font-bold text-sm text-gray-900">StackOverflow</h5>
                                    <p class="text-xs text-gray-500">37,076 responden</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="#categoryTabs" onclick="filterAndNotify('web-development', 'Web Development')" class="text-blue-600 font-bold text-sm hover:underline">
                                    Lihat kursus Web Dev &rarr;
                                </a>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col h-full">
                            <div class="text-5xl text-gray-900 font-serif leading-none mb-4">“</div>
                            <p class="text-gray-600 text-sm mb-6 flex-grow leading-relaxed">
                                LMS-Cerdika benar-benar menjadi game-changer bagi saya. Saya bisa membangun startup saya sendiri berkat ilmu ini.
                            </p>
                            <div class="flex items-center gap-3 border-t border-gray-50 pt-4 mt-auto">
                                <img src="https://ui-avatars.com/api/?name=Alvin+Lim&background=random" alt="Alvin" class="w-10 h-10 rounded-full">
                                <div>
                                    <h5 class="font-bold text-sm text-gray-900">Alvin Lim</h5>
                                    <p class="text-xs text-gray-500">Technical Co-Founder</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="#categoryTabs" onclick="filterAndNotify('digital-marketing', 'Digital Marketing')" class="text-blue-600 font-bold text-sm hover:underline">
                                    Lihat kursus Bisnis &rarr;
                                </a>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col h-full">
                            <div class="text-5xl text-gray-900 font-serif leading-none mb-4">“</div>
                            <p class="text-gray-600 text-sm mb-6 flex-grow leading-relaxed">
                                Platform ini memberi kemampuan untuk konsisten. Saya belajar apa yang dibutuhkan di dunia kerja nyata.
                            </p>
                            <div class="flex items-center gap-3 border-t border-gray-50 pt-4 mt-auto">
                                <img src="https://ui-avatars.com/api/?name=William+Wachlin&background=random" alt="William" class="w-10 h-10 rounded-full">
                                <div>
                                    <h5 class="font-bold text-sm text-gray-900">William A. Wachlin</h5>
                                    <p class="text-xs text-gray-500">Partner Account Manager</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="#categoryTabs" onclick="filterAndNotify('mobile-development', 'Mobile Development')" class="text-blue-600 font-bold text-sm hover:underline">
                                    Lihat kursus Mobile &rarr;
                                </a>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col h-full">
                            <div class="text-5xl text-gray-900 font-serif leading-none mb-4">“</div>
                            <p class="text-gray-600 text-sm mb-6 flex-grow leading-relaxed">
                                Karyawan kami mampu menggabungkan teknologi dan soft skills. Ini sangat membantu mendorong karier mereka.
                            </p>
                            <div class="flex items-center gap-3 border-t border-gray-50 pt-4 mt-auto">
                                <img src="https://ui-avatars.com/api/?name=Ian+Stevens&background=random" alt="Ian" class="w-10 h-10 rounded-full">
                                <div>
                                    <h5 class="font-bold text-sm text-gray-900">Ian Stevens</h5>
                                    <p class="text-xs text-gray-500">Head of Capability Dev</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="#categoryTabs" onclick="filterAndNotify('all', 'Semua Kategori')" class="text-blue-600 font-bold text-sm hover:underline">
                                    Baca cerita lengkap &rarr;
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8">
                        <a href="#" class="text-blue-600 font-bold hover:text-blue-800 flex items-center gap-1 transition">
                            Lihat semua cerita sukses 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>

                </div>
            </section>

            <section class="py-12 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <div class="bg-[#1e1e2c] rounded-3xl p-8 md:p-12 flex flex-col lg:flex-row items-center gap-12 shadow-2xl overflow-hidden relative">
                        
                        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                        <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl -ml-16 -mb-16 pointer-events-none"></div>

                        <div class="lg:w-1/3 relative z-10">
                            <h2 class="text-3xl md:text-4xl font-extrabold text-white leading-tight mb-4">
                                Dapatkan sertifikasi dan maju dalam karier Anda
                            </h2>
                            <p class="text-gray-300 mb-8 text-lg leading-relaxed">
                                Persiapkan diri untuk dunia kerja profesional. Selesaikan materi, kerjakan tugas akhir, dan raih sertifikat kompetensi resmi dari LMS-Cerdika.
                            </p>
                            <a href="{{ route('login', ['notice' => 'certification']) }}" class="inline-flex items-center text-white font-bold hover:text-blue-300 transition group">
                                Jelajahi Sertifikasi 
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>

                        <div class="lg:w-2/3 w-full relative z-10">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                
                                <a href="#categoryTabs" onclick="filterAndNotify('web-development', 'Web Development')" class="block group">
                                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition duration-300 h-full flex flex-col">
                                        <div class="bg-white w-full h-32 rounded-lg mb-4 flex items-center justify-center overflow-hidden relative">
                                            <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-blue-50"></div>
                                            <span class="relative text-4xl font-bold text-blue-600">&lt;/&gt;</span>
                                        </div>
                                        <h4 class="text-white font-bold text-lg mb-1 group-hover:text-blue-300 transition">Web Dev</h4>
                                        <p class="text-gray-400 text-xs">Laravel, React, Vue, Tailwind</p>
                                    </div>
                                </a>

                                <a href="#categoryTabs" onclick="filterAndNotify('data-science', 'Data Science')" class="block group">
                                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition duration-300 h-full flex flex-col">
                                        <div class="bg-white w-full h-32 rounded-lg mb-4 flex items-center justify-center overflow-hidden relative">
                                            <div class="absolute inset-0 bg-gradient-to-br from-purple-100 to-purple-50"></div>
                                            <span class="relative text-4xl font-bold text-purple-600">Data</span>
                                        </div>
                                        <h4 class="text-white font-bold text-lg mb-1 group-hover:text-purple-300 transition">Data Science</h4>
                                        <p class="text-gray-400 text-xs">Python, SQL, Machine Learning</p>
                                    </div>
                                </a>

                                <a href="#categoryTabs" onclick="filterAndNotify('digital-marketing', 'Digital Marketing')" class="block group">
                                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4 hover:bg-white/10 transition duration-300 h-full flex flex-col">
                                        <div class="bg-white w-full h-32 rounded-lg mb-4 flex items-center justify-center overflow-hidden relative">
                                            <div class="absolute inset-0 bg-gradient-to-br from-orange-100 to-orange-50"></div>
                                            <span class="relative text-4xl font-bold text-orange-600">SEO</span>
                                        </div>
                                        <h4 class="text-white font-bold text-lg mb-1 group-hover:text-orange-300 transition">Marketing</h4>
                                        <p class="text-gray-400 text-xs">Ads, Copywriting, Branding</p>
                                    </div>
                                </a>

                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main>

        <footer class="bg-white border-t border-gray-200 pt-12 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <div class="col-span-1 md:col-span-2">
                        <span class="text-2xl font-bold text-blue-600 tracking-tight">LMS-Cerdika</span>
                        <p class="mt-4 text-gray-500 max-w-sm">
                            Platform belajar daring yang didesain untuk membantu Anda meningkatkan skill dengan materi berkualitas dan instruktur ahli.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-4">Navigasi</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li><a href="{{ route('homepage') }}" class="hover:text-blue-600">Beranda</a></li>
                            <li><a href="{{ route('course.catalog') }}" class="hover:text-blue-600">Katalog Kursus</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-blue-600">Masuk / Daftar</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-4">Hubungi Kami</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li>support@lmscerdika.com</li>
                            <li>Jl. Pendidikan No. 1, Makassar</li>
                            <li>+62 812 3456 7890</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-8 text-center">
                    <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} LMS-Cerdika. All rights reserved.</p>
                </div>
            </div>
        </footer>

    </div>

    <div id="login-toast" class="fixed bottom-5 right-5 bg-white border-l-4 border-blue-600 text-gray-800 px-6 py-4 rounded shadow-2xl transform translate-y-full opacity-0 transition-all duration-500 z-50 max-w-md">
        <div class="flex items-center">
            <div class="text-blue-600 mr-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-sm">Mode Preview Tamu</h4>
                <p class="text-sm text-gray-600 mt-1" id="toast-message">Menampilkan kursus pilihan. Silakan login untuk akses penuh.</p>
            </div>
            <button onclick="closeToast()" class="ml-6 text-gray-400 hover:text-gray-900">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="mt-3 text-right">
            <a href="{{ route('login') }}" class="text-xs font-bold text-blue-600 hover:underline">Login Sekarang &rarr;</a>
        </div>
    </div>

    <script>
        function filterCourses(categorySlug, btnElement) {
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.remove('text-gray-900', 'border-gray-900');
                btn.classList.add('text-gray-500', 'border-transparent');
            });
            btnElement.classList.remove('text-gray-500', 'border-transparent');
            btnElement.classList.add('text-gray-900', 'border-gray-900');

            const container = document.getElementById('courseContainer');
            container.style.opacity = '0.5';

            fetch(`{{ route('courses.filter') }}?category=${categorySlug}`)
                .then(response => response.text())
                .then(html => {
                    container.innerHTML = html;
                    container.style.opacity = '1';
                })
                .catch(error => {
                    console.error('Error:', error);
                    container.style.opacity = '1';
                });
        }

        function selectCategory(slug) {
            const btn = document.getElementById('btn-' + slug);
            if (btn) {
                btn.click();
                btn.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        function filterAndNotify(slug, name) {
            selectCategory(slug);
            const toast = document.getElementById('login-toast');
            const toastMsg = document.getElementById('toast-message');
            
            toastMsg.innerText = `Menampilkan preview kursus ${name}. Untuk akses materi lengkap dan sertifikat, Anda perlu Login.`;
            toast.classList.remove('translate-y-full', 'opacity-0');

            setTimeout(() => { closeToast(); }, 6000);
        }

        function closeToast() {
            const toast = document.getElementById('login-toast');
            toast.classList.add('translate-y-full', 'opacity-0');
        }
    </script>
</body>
</html>