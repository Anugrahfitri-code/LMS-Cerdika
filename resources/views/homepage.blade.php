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
                            <a href="{{ route('login') }}" class="text-white/90 font-medium hover:text-white transition px-3">Masuk</a>
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
                        <input type="text" name="search" class="block w-full pl-11 pr-4 py-4 border-none text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-0 rounded-xl bg-gray-50 focus:bg-white transition-colors" placeholder="Apa yang ingin Anda pelajari hari ini?">
                    </div>

                    <div class="hidden md:block w-px bg-gray-200 my-2"></div>

                    <div class="relative md:w-1/4 group">
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
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="flex items-end justify-between mb-10">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Kursus Terpopuler 🔥</h2>
                        <p class="mt-2 text-gray-600">Pilihan kursus terbaik yang paling diminati oleh siswa kami.</p>
                    </div>
                    <a href="{{ route('course.catalog') }}" class="hidden md:flex items-center text-blue-600 font-semibold hover:text-blue-800 transition">
                        Lihat Semua Kursus <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                @if($popularCourses->isEmpty())
                    <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                        <div class="bg-blue-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada data kursus populer saat ini.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                        @foreach($popularCourses as $course)
                            <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                                <div class="h-32 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-t-2xl relative overflow-hidden p-4">
                                    <div class="absolute top-0 right-0 w-16 h-16 bg-blue-100 rounded-bl-full opacity-50 transition-transform group-hover:scale-110"></div>
                                    <span class="relative z-10 inline-block px-2 py-1 bg-white/80 backdrop-blur-sm text-blue-700 text-[10px] font-bold uppercase tracking-wider rounded-md shadow-sm">
                                        {{ $course->category->name }}
                                    </span>
                                </div>

                                <div class="p-5 flex-grow flex flex-col">
                                    <h3 class="text-lg font-bold text-gray-900 leading-tight mb-2 group-hover:text-blue-600 transition-colors">
                                        {{ Str::limit($course->title, 40) }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mb-4 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        {{ $course->teacher->name }}
                                    </p>

                                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                                        <div class="flex items-center text-xs text-gray-500 font-medium bg-gray-100 px-2 py-1 rounded-md">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                                            {{ $course->students_count }} Peserta
                                        </div>
                                        <a href="{{ route('public.course.show', $course) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-10 text-center md:hidden">
                     <a href="{{ route('course.catalog') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Lihat Semua Kursus
                    </a>
                </div>
            </div>
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