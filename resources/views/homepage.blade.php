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
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #6366f1 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-pattern::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background-image: 
                radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 50px 50px, 80px 80px;
            background-position: 0 0, 40px 40px;
            animation: movePattern 20s linear infinite;
        }
        @keyframes movePattern {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.1); }
        }
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .search-box {
            transition: all 0.3s ease;
        }
        .search-box:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.3);
        }
        
        .category-pill {
            transition: all 0.3s ease;
        }
        .category-pill:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }
        .particle-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(147, 197, 253, 0.3) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            animation: pulse-slow 8s infinite;
        }
        .particle-2 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(167, 139, 250, 0.3) 0%, transparent 70%);
            bottom: 50px;
            left: 10%;
            animation: pulse-slow 10s infinite 2s;
        }
        .particle-3 {
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(96, 165, 250, 0.3) 0%, transparent 70%);
            top: 40%;
            left: -50px;
            animation: pulse-slow 12s infinite 4s;
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        
        <nav class="absolute w-full z-50 top-0 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center animate-fade-in-up">
                        <a href="{{ route('homepage') }}" class="flex items-center gap-3 group">
                            <div class="bg-white/10 backdrop-blur-md p-2 rounded-xl shadow-lg border border-white/20 group-hover:bg-white/20 transition-all duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <span class="text-2xl font-extrabold text-white tracking-tight drop-shadow-lg">LMS-Cerdika</span>
                        </a>
                    </div>
                    <div class="flex items-center gap-4 animate-fade-in-up" style="animation-delay: 0.2s;">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-white/90 font-semibold hover:text-white transition-all duration-200 hover:scale-105">Dashboard</a>
                            <a href="{{ route('course.catalog') }}" class="px-6 py-2.5 bg-white/15 backdrop-blur-md border-2 border-white/30 text-white rounded-full text-sm font-bold hover:bg-white/25 hover:scale-105 transition-all duration-200 shadow-lg">
                                Katalog
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 text-white text-sm font-bold border-2 border-white/40 rounded-full hover:bg-white/10 hover:border-white hover:scale-105 transition-all duration-300 backdrop-blur-sm">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-white text-blue-700 rounded-full text-sm font-bold hover:bg-blue-50 hover:scale-105 transition-all duration-300 shadow-xl shadow-white/20">
                                Daftar Gratis
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <header class="relative hero-pattern pt-32 pb-48 overflow-hidden">
            <div class="particle particle-1"></div>
            <div class="particle particle-2"></div>
            <div class="particle particle-3"></div>

            <div class="absolute top-20 right-10 w-32 h-32 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-10 w-40 h-40 bg-indigo-300/10 rounded-full blur-3xl"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
                <div class="inline-block animate-fade-in-up">
                    <span class="inline-flex items-center gap-2 py-2 px-5 rounded-full bg-white/15 backdrop-blur-md border border-white/30 text-white text-sm font-bold tracking-wider mb-8 uppercase shadow-lg hover:scale-105 transition-transform duration-300">
                        <svg class="w-4 h-4 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        Platform Belajar Masa Depan
                    </span>
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6 leading-tight animate-fade-in-up" style="animation-delay: 0.2s;">
                    Bangun Karir Impianmu <br>
                    <span class="relative inline-block">
                        <span class="relative z-10 text-transparent bg-clip-text bg-gradient-to-r from-blue-100 via-white to-indigo-100">
                            Bersama LMS Cerdika
                        </span>
                        <div class="absolute -bottom-2 left-0 right-0 h-3 bg-white/20 blur-lg"></div>
                    </span>
                </h1>

                <div class="flex items-center justify-center gap-3 mt-6 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="hidden md:block w-12 h-0.5 bg-gradient-to-r from-transparent to-white/40"></div>
                    <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-medium">
                        Akses ribuan materi pembelajaran berkualitas tinggi dari mentor berpengalaman. Tingkatkan skill, raih sertifikat, dan siap kerja.
                    </p>
                    <div class="hidden md:block w-12 h-0.5 bg-gradient-to-l from-transparent to-white/40"></div>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-4 mt-10 animate-fade-in-up" style="animation-delay: 0.6s;">
                    <div class="flex items-center gap-2 px-5 py-2 bg-white/10 backdrop-blur-md rounded-full border border-white/20">
                        <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="text-white font-bold text-sm">Rating 4.9/5</span>
                    </div>
                    <div class="flex items-center gap-2 px-5 py-2 bg-white/10 backdrop-blur-md rounded-full border border-white/20">
                        <svg class="w-5 h-5 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="text-white font-bold text-sm">50,000+ Siswa</span>
                    </div>
                    <div class="flex items-center gap-2 px-5 py-2 bg-white/10 backdrop-blur-md rounded-full border border-white/20">
                        <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        <span class="text-white font-bold text-sm">Sertifikat Resmi</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="relative z-20 -mt-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 animate-fade-in-up" style="animation-delay: 0.8s;">
            <div class="bg-white rounded-3xl shadow-2xl shadow-blue-900/20 p-3 md:p-4 search-box">
                <form action="{{ route('course.catalog') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                    <div class="flex-grow relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" class="block w-full pl-14 pr-4 py-4 border-none text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-0 rounded-2xl bg-gray-50 focus:bg-white transition-all text-lg font-medium" placeholder="Cari kursus impianmu...">
                    </div>
                    
                    <div class="relative md:w-auto md:min-w-[240px] group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <select name="category" class="block w-full pl-14 pr-12 py-4 border-none text-gray-900 focus:outline-none focus:ring-0 rounded-2xl bg-gray-50 focus:bg-white cursor-pointer appearance-none transition-all text-lg font-medium">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <button type="submit" class="md:w-auto px-10 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all shadow-xl shadow-blue-600/30 flex items-center justify-center gap-2 text-lg hover:scale-105 transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari Kursus
                    </button>
                </form>
            </div>
        </div>

        <main class="flex-grow py-20">
            
            <section class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <div class="mb-12 text-center animate-fade-in-up">
                        <span class="inline-block px-4 py-2 bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 font-bold rounded-full text-sm uppercase tracking-wider mb-4 border border-blue-100">
                            ✨ Mulai Transformasi Hari Ini
                        </span>
                        <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                            Skill yang mengubah karier dan kehidupan Anda
                        </h2>
                        <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                            Mulai dari topik dengan skill yang sangat penting hingga teknis, LMS-Cerdika mendukung pengembangan profesional Anda.
                        </p>
                    </div>

                    <div class="relative border-b-2 border-gray-100 mb-10">
                        <div class="flex space-x-6 overflow-x-auto no-scrollbar pb-2" id="categoryTabs">
                            <button id="btn-all" onclick="filterCourses('all', this)" 
                                    class="category-btn whitespace-nowrap px-6 py-3 text-base font-bold transition-all border-b-4 text-blue-600 border-blue-600 bg-blue-50 rounded-t-lg">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                    Semua Kursus
                                </span>
                            </button>
                            @foreach($categories as $category)
                                <button id="btn-{{ $category->slug }}" onclick="filterCourses('{{ $category->slug }}', this)" 
                                        class="category-btn whitespace-nowrap px-6 py-3 text-base font-bold transition-all border-b-4 text-gray-600 border-transparent hover:text-blue-600 hover:border-blue-300 hover:bg-blue-50 rounded-t-lg">
                                    {{ $category->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-gray-50 to-blue-50 border-2 border-blue-100 rounded-3xl p-8 shadow-xl">
                        
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                                    <span class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl text-white">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                        </svg>
                                    </span>
                                    Kursus Pilihan untuk Memulai
                                </h3>
                                <p class="text-gray-600 mt-1">Dipilih khusus untuk perjalanan belajar Anda</p>
                            </div>
                           
                        </div>

                        <div id="courseContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 min-h-[300px] transition-opacity duration-300">
                            @include('partials.course-cards', ['courses' => $popularCourses->take(4)])
                        </div>

                        <div class="mt-10 text-center">
                            <a href="{{ route('course.catalog') }}" class="inline-flex items-center gap-3 px-8 py-4 border-2 border-blue-600 text-blue-600 font-bold rounded-2xl hover:bg-blue-600 hover:text-white transition-all shadow-lg hover:shadow-xl hover:scale-105 transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                Tampilkan semua kursus
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-24 bg-gray-50 relative overflow-hidden">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full overflow-hidden pointer-events-none">
                    <div class="absolute top-[20%] right-[-10%] w-96 h-96 bg-blue-200/20 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-[10%] left-[-10%] w-80 h-80 bg-indigo-200/20 rounded-full blur-3xl"></div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">Alumni Kami</span>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-3 mb-6">
                            Mereka yang Telah Berhasil <br>Mewujudkan Mimpi
                        </h2>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Lihat bagaimana ribuan siswa kami mentransformasi karier dan kehidupan mereka melalui pendidikan berkualitas di LMS-Cerdika.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div class="group bg-white rounded-3xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 relative flex flex-col h-full">
                            <div class="absolute top-8 right-8 text-gray-100 group-hover:text-blue-100 transition-colors">
                                <svg class="w-16 h-16 transform rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z"></path></svg>
                            </div>
                            <div class="relative z-10 flex-grow">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="w-14 h-14 rounded-full flex items-center justify-center font-bold text-xl shadow-md bg-blue-100 text-blue-600">
                                        AL
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-lg">Alvin Lim</h4>
                                        <p class="text-sm text-gray-500">Founder di <span class="text-blue-600 font-semibold">TechStart</span></p>
                                    </div>
                                </div>
                                <p class="text-gray-600 italic text-lg leading-relaxed mb-6">
                                    "LMS-Cerdika benar-benar menjadi game-changer bagi saya. Saya bisa membangun startup saya sendiri berkat ilmu ini."
                                </p>
                            </div>
                            <div class="pt-6 border-t border-gray-100 mt-auto">
                                <div class="inline-flex items-center px-3 py-1 rounded-full bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-600 group-hover:bg-blue-50 group-hover:border-blue-100 group-hover:text-blue-600 transition-colors">
                                    Alumni: Web Development
                                </div>
                            </div>
                        </div>

                        <div class="group bg-white rounded-3xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 relative flex flex-col h-full">
                            <div class="absolute top-8 right-8 text-gray-100 group-hover:text-blue-100 transition-colors">
                                <svg class="w-16 h-16 transform rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z"></path></svg>
                            </div>
                            <div class="relative z-10 flex-grow">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="w-14 h-14 rounded-full flex items-center justify-center font-bold text-xl shadow-md bg-green-100 text-green-600">
                                        WW
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-lg">William A. Wachlin</h4>
                                        <p class="text-sm text-gray-500">Partner Account Manager</p>
                                    </div>
                                </div>
                                <p class="text-gray-600 italic text-lg leading-relaxed mb-6">
                                    "Platform ini memberi kemampuan untuk konsisten. Saya belajar apa yang dibutuhkan di dunia kerja nyata."
                                </p>
                            </div>
                            <div class="pt-6 border-t border-gray-100 mt-auto">
                                <div class="inline-flex items-center px-3 py-1 rounded-full bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-600 group-hover:bg-blue-50 group-hover:border-blue-100 group-hover:text-blue-600 transition-colors">
                                    Alumni: Mobile Development
                                </div>
                            </div>
                        </div>

                        <div class="group bg-white rounded-3xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 relative flex flex-col h-full">
                            <div class="absolute top-8 right-8 text-gray-100 group-hover:text-blue-100 transition-colors">
                                <svg class="w-16 h-16 transform rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z"></path></svg>
                            </div>
                            <div class="relative z-10 flex-grow">
                                <div class="flex items-center gap-4 mb-6">
                                    <div class="w-14 h-14 rounded-full flex items-center justify-center font-bold text-xl shadow-md bg-purple-100 text-purple-600">
                                        IS
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-lg">Ian Stevens</h4>
                                        <p class="text-sm text-gray-500">Head of Capability Dev</p>
                                    </div>
                                </div>
                                <p class="text-gray-600 italic text-lg leading-relaxed mb-6">
                                    "Karyawan kami mampu menggabungkan teknologi dan soft skills. Ini sangat membantu mendorong karier mereka."
                                </p>
                            </div>
                            <div class="pt-6 border-t border-gray-100 mt-auto">
                                <div class="inline-flex items-center px-3 py-1 rounded-full bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-600 group-hover:bg-blue-50 group-hover:border-blue-100 group-hover:text-blue-600 transition-colors">
                                    Alumni: Data Science
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-16 text-center">
                         <a href="{{ route('stories') }}" class="inline-flex items-center text-blue-600 font-bold hover:text-blue-800 transition-colors group text-lg">
                            Baca Lebih Banyak Cerita
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>

            <section class="py-20 bg-white">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-[2.5rem] p-8 md:p-16 text-center text-white shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
                        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
                        
                        <div class="relative z-10">
                            <h2 class="text-3xl md:text-5xl font-extrabold mb-6 tracking-tight">Siap Memulai Perjalanan Anda?</h2>
                            <p class="text-blue-100 text-lg md:text-xl mb-10 max-w-2xl mx-auto leading-relaxed">
                                Jangan tunda lagi. Bergabunglah dengan komunitas pembelajar kami dan raih skill yang akan mengubah masa depan Anda.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="{{ route('register') }}" class="px-10 py-4 bg-white text-blue-700 font-bold rounded-full shadow-lg hover:bg-blue-50 hover:scale-105 transition-all duration-300 text-lg">
                                    Daftar Gratis Sekarang
                                </a>
                            </div>
                            <p class="mt-6 text-sm text-blue-200 opacity-80">Tidak perlu kartu kredit • Akses materi gratis tersedia</p>
                        </div>
                    </div>
                </div>
            </section>
            
        </main>

        <footer class="bg-gradient-to-br from-gray-900 via-blue-900 to-indigo-900 text-white pt-16 pb-8 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-500 rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-white/10 backdrop-blur-md p-2 rounded-xl border border-white/20">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-extrabold tracking-tight">LMS-Cerdika</span>
                        </div>
                        <p class="text-blue-100 max-w-md leading-relaxed mb-6">
                            Platform belajar daring yang didesain untuk membantu Anda meningkatkan skill dengan materi berkualitas dan instruktur ahli.
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-lg flex items-center justify-center hover:bg-white/20 transition-all hover:scale-110 border border-white/20">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-lg flex items-center justify-center hover:bg-white/20 transition-all hover:scale-110 border border-white/20">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-lg flex items-center justify-center hover:bg-white/20 transition-all hover:scale-110 border border-white/20">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-lg flex items-center justify-center hover:bg-white/20 transition-all hover:scale-110 border border-white/20">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-bold text-xl mb-6 flex items-center gap-2">
                            <div class="w-1 h-6 bg-gradient-to-b from-blue-400 to-indigo-400 rounded-full"></div>
                            Navigasi
                        </h3>
                        <ul class="space-y-3 text-blue-100">
                            <li><a href="{{ route('homepage') }}" class="hover:text-white hover:pl-2 transition-all flex items-center gap-2 group">
                                <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                Beranda
                            </a></li>
                            <li><a href="{{ route('login', ['notice' => 'catalog']) }}" class="hover:text-white hover:pl-2 transition-all flex items-center gap-2 group">
                                <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                Katalog Kursus
                            </a></li>
                            <li><a href="{{ route('stories') }}" class="hover:text-white hover:pl-2 transition-all flex items-center gap-2 group">
                                <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                Cerita Sukses
                            </a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-white hover:pl-2 transition-all flex items-center gap-2 group">
                                <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                Masuk / Daftar
                            </a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="font-bold text-xl mb-6 flex items-center gap-2">
                            <div class="w-1 h-6 bg-gradient-to-b from-blue-400 to-indigo-400 rounded-full"></div>
                            Hubungi Kami
                        </h3>
                        <ul class="space-y-4 text-blue-100">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>support@lmscerdika.com</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>Jl. Pendidikan No. 1, Makassar</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>+62 812 3456 7890</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-white/10 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-blue-200 text-sm">&copy; {{ date('Y') }} LMS-Cerdika. All rights reserved.</p>
                        <div class="flex gap-6 text-sm text-blue-200">
                            <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                            <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                            <a href="#" class="hover:text-white transition-colors">Bantuan</a>
                        </div>
                    </div>
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
                <p class="text-sm text-gray-600" id="toast-message">Menampilkan kursus pilihan. Silakan login untuk akses penuh.</p>
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
                btn.classList.remove('text-blue-600', 'border-blue-600', 'bg-blue-50');
                btn.classList.add('text-gray-600', 'border-transparent');
            });

            btnElement.classList.remove('text-gray-600', 'border-transparent');
            btnElement.classList.add('text-blue-600', 'border-blue-600', 'bg-blue-50');

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

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>