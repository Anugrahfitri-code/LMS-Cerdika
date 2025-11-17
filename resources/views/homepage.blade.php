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
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
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
                        <div class="flex space-x-8 overflow-x-auto no-scrollbar pb-1">
                            {{-- Loop Kategori untuk Menu --}}
                            @foreach($categories as $index => $category)
                                <a href="{{ route('course.catalog', ['category' => $category->slug]) }}" 
                                class="whitespace-nowrap pb-3 text-sm font-bold transition-colors border-b-2 
                                {{ $index === 0 ? 'text-gray-900 border-gray-900' : 'text-gray-500 border-transparent hover:text-gray-800' }}">
                                    {{ $category->name }}
                                </a>
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

                        @if($popularCourses->isEmpty())
                            <div class="text-center py-16">
                                <p class="text-gray-500 font-medium">Belum ada data kursus populer saat ini.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($popularCourses->take(4) as $course)
                                    <div class="group bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 cursor-pointer flex flex-col h-full">
                                        <a href="{{ route('public.course.show', $course) }}" class="block h-full flex flex-col">
                                            <div class="relative h-40 bg-gray-200 rounded-t-lg overflow-hidden">
                                                {{-- Placeholder Gambar --}}
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($course->title) }}&background=random&size=400" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                                <div class="absolute top-0 right-0 bg-black/50 text-white text-xs font-bold px-2 py-1 m-2 rounded">
                                                    {{ $course->category->name }}
                                                </div>
                                            </div>

                                            <div class="p-4 flex flex-col flex-grow">
                                                <h4 class="text-base font-bold text-gray-900 line-clamp-2 leading-snug group-hover:text-blue-700 transition-colors">
                                                    {{ $course->title }}
                                                </h4>
                                                <p class="text-xs text-gray-500 mt-1 truncate">{{ $course->teacher->name }}</p>
                                                
                                                <div class="flex items-center mt-2 mb-1">
                                                    <span class="text-sm font-bold text-orange-800 mr-1">4.8</span>
                                                    <div class="flex text-orange-400 text-xs">
                                                        ★★★★★
                                                    </div>
                                                    <span class="text-xs text-gray-400 ml-1">({{ $course->students_count * 12 }})</span>
                                                </div>

                                                <div class="mt-auto pt-2 flex items-center justify-between">
                                                    <div class="flex flex-col">
                                                        <span class="text-lg font-bold text-gray-900">Gratis</span>
                                                        <span class="text-xs text-gray-500 line-through">Rp 149.000</span>
                                                    </div>
                                                    
                                                    @if($course->students_count > 5)
                                                        <span class="bg-yellow-100 text-yellow-800 text-[10px] font-bold px-2 py-1 rounded-sm uppercase">
                                                            Terlaris
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-8 text-center">
                            <a href="{{ route('course.catalog') }}" class="inline-block px-6 py-3 border border-gray-900 text-gray-900 font-bold rounded-md hover:bg-gray-100 transition">
                                Tampilkan semua kursus
                            </a>
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
</body>
</html>