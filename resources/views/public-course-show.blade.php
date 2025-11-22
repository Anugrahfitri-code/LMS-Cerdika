<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $course->title }} - LMS Cerdika</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        }
        .gradient-blue {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        }
        .gradient-card {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(59, 130, 246, 0.05) 100%);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .shine {
            position: relative;
            overflow: hidden;
        }
        .shine::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        .shine:hover::before {
            left: 100%;
        }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-blue-50 via-white to-blue-50 font-sans">
    <div class="min-h-screen flex flex-col">
        
        <nav class="glass-effect border-b border-blue-100/50 shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('homepage') }}" class="text-2xl font-extrabold text-blue-600 tracking-tight hover:scale-105 transition-transform">
                            LMS-Cerdika
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition-all hover:scale-105">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition-all hover:scale-105">Log in</a>
                            <a href="{{ route('register') }}" class="px-5 py-2 gradient-blue text-white rounded-full text-sm font-bold hover:shadow-lg hover:shadow-blue-500/50 transition-all hover:scale-105 shine">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-6">
                    @auth
                        <a href="{{ route('course.catalog') }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 transition-all hover:gap-3 gap-2 group">
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Katalog
                        </a>
                    @else
                        <a href="{{ route('homepage') }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 transition-all hover:gap-3 gap-2 group">
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    @endauth
                </div>

                <nav class="flex mb-8" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2">
                        <li><a href="{{ route('homepage') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm transition">Beranda</a></li>
                        <li><span class="text-blue-300">→</span></li>
                        <li><span class="text-gray-900 font-semibold text-sm truncate max-w-[200px]">{{ $course->title }}</span></li>
                    </ol>
                </nav>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-8">
                        
                        <div class="bg-white rounded-3xl shadow-2xl border border-blue-100 p-8 overflow-hidden relative hover-lift">
                            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/20 to-blue-500/20 rounded-full blur-3xl animate-float"></div>
                            <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-blue-500/20 to-blue-400/20 rounded-full blur-3xl" style="animation: float 8s ease-in-out infinite;"></div>
                            
                            <div class="relative z-10">
                                <span class="px-4 py-2 text-xs font-bold tracking-wider text-white uppercase gradient-blue rounded-full shadow-lg shadow-blue-500/30 inline-block">
                                    {{ $course->category->name }}
                                </span>
                                
                                <h1 class="mt-6 text-4xl md:text-5xl font-black text-blue-600 leading-normal pb-2">
                                    {{ $course->title }}
                                </h1>
                                
                                <div class="flex flex-wrap items-center gap-6 mt-6">
                                    <div class="flex items-center group">
                                        <div class="p-2 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl mr-3 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Pengajar</p>
                                            <p class="text-sm font-bold text-gray-800">{{ $course->teacher->name }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center group">
                                        <div class="p-2 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl mr-3 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Total Peserta</p>
                                            <p class="text-sm font-bold text-gray-800">{{ $course->students_count }} Mahasiswa</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl shadow-xl border border-blue-50 p-8 hover-lift">
                            <div class="flex items-center mb-6">
                                <div class="p-3 gradient-blue rounded-2xl shadow-lg shadow-blue-500/30 mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900">Tentang Kursus</h3>
                            </div>
                            <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed text-base">
                                {!! nl2br(e($course->description)) !!}
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl shadow-xl border border-blue-50 p-8 hover-lift">
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center">
                                    <div class="p-3 gradient-blue rounded-2xl shadow-lg shadow-blue-500/30 mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    </div>
                                    <h3 class="text-2xl font-black text-gray-900">Materi Pembelajaran</h3>
                                </div>
                                <span class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-bold rounded-full shadow-lg shadow-blue-500/30">
                                    {{ $course->contents->count() }} Pelajaran
                                </span>
                            </div>

                            @php
                                $isEnrolled = Auth::check() && Auth::user()->role === 'student' && Auth::user()->enrolledCourses->contains($course->id);
                            @endphp

                            <div class="space-y-4">
                                @forelse($course->contents as $index => $content)
                                    
                                    @if($isEnrolled)
                                        <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $content]) }}" 
                                           class="group flex items-center p-5 bg-gradient-to-r from-blue-50 to-blue-100 border-2 border-blue-100 rounded-2xl hover:border-blue-400 hover:shadow-xl hover:shadow-blue-500/20 transition-all duration-300 cursor-pointer hover-lift">
                                            <div class="flex-shrink-0 mr-5">
                                                <span class="w-14 h-14 flex items-center justify-center gradient-blue text-white rounded-2xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-blue-500/30">
                                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                                </span>
                                            </div>
                                            <div class="flex-grow">
                                                <h4 class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                                                    {{ $content->title }}
                                                </h4>
                                                <p class="text-sm text-blue-600 font-medium mt-1 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                                    Klik untuk mulai belajar
                                                </p>
                                            </div>
                                            <div class="flex-shrink-0 ml-4 text-blue-400 group-hover:text-blue-600 group-hover:translate-x-2 transition-all">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                            </div>
                                        </a>

                                    @else
                                        <div class="flex items-center p-5 bg-gradient-to-r from-gray-50 to-gray-100 border-2 border-gray-200 rounded-2xl opacity-60">
                                            <div class="flex-shrink-0 mr-5">
                                                <span class="w-14 h-14 flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-400 text-white rounded-2xl font-bold text-lg shadow-lg">
                                                    {{ $index + 1 }}
                                                </span>
                                            </div>
                                            <div class="flex-grow">
                                                <h4 class="text-lg font-semibold text-gray-600">
                                                    {{ $content->title }}
                                                </h4>
                                                <p class="text-sm text-gray-500 mt-1">🔒 Daftar untuk membuka materi</p>
                                            </div>
                                            <div class="flex-shrink-0 ml-4">
                                                <div class="p-3 bg-gray-300 rounded-xl">
                                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @empty
                                    <div class="text-center py-12 gradient-card rounded-2xl border-2 border-dashed border-blue-200">
                                        <div class="w-20 h-20 mx-auto mb-4 gradient-blue rounded-full flex items-center justify-center opacity-50">
                                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                        </div>
                                        <p class="text-gray-500 font-semibold">Belum ada materi yang diupload.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-white border-2 border-blue-100 rounded-3xl shadow-2xl p-8 sticky top-24 overflow-hidden relative">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/20 to-blue-500/20 rounded-full blur-2xl"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-blue-500/20 to-blue-400/20 rounded-full blur-2xl"></div>
                            
                            <div class="relative z-10">
                                <div class="text-center mb-8">
                                    <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold uppercase tracking-wider rounded-full mb-4 shadow-lg shadow-blue-500/30">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        100% Gratis
                                    </div>
                                    <h3 class="text-3xl font-black text-blue-600 mb-3 leading-normal pb-1">
                                        Mulai Belajar
                                    </h3>
                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        Akses penuh ke semua materi, forum diskusi, dan dapatkan sertifikat digital setelah menyelesaikan kursus.
                                    </p>
                                </div>
                                
                                @auth
                                    @if(auth()->user()->role === 'student')
                                        @if($isEnrolled)
                                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-2xl p-5 mb-6 text-center">
                                                <div class="w-12 h-12 mx-auto mb-3 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center shadow-lg shadow-green-500/30">
                                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                </div>
                                                <p class="text-green-800 font-bold text-base">
                                                    ✨ Anda Sudah Terdaftar
                                                </p>
                                                <p class="text-green-600 text-xs mt-1">Lanjutkan perjalanan belajarmu</p>
                                            </div>
                                            
                                            @php
                                                $firstLesson = $course->contents->sortBy('order')->first();
                                            @endphp

                                            @if($firstLesson)
                                                <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $firstLesson]) }}" class="block w-full text-center px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-black text-lg rounded-2xl hover:from-green-600 hover:to-emerald-700 shadow-2xl shadow-green-500/40 transition-all transform hover:scale-105 hover:-translate-y-1 shine">
                                                    🚀 Lanjutkan Belajar
                                                </a>
                                            @else
                                                <a href="{{ route('dashboard') }}" class="block w-full text-center px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-black text-lg rounded-2xl hover:from-green-600 hover:to-emerald-700 shadow-2xl shadow-green-500/40 transition-all transform hover:scale-105 hover:-translate-y-1 shine">
                                                    📚 Ke Dashboard
                                                </a>
                                            @endif
                                        @else
                                            <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full px-6 py-4 gradient-blue text-white font-black text-lg rounded-2xl hover:shadow-2xl hover:shadow-blue-500/50 transition-all transform hover:scale-105 hover:-translate-y-1 shine">
                                                    ⚡ Ikuti Kursus Sekarang
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <div class="text-center p-5 bg-gradient-to-r from-yellow-50 to-orange-50 border-2 border-yellow-200 rounded-2xl">
                                            <div class="w-12 h-12 mx-auto mb-3 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            </div>
                                            <p class="text-yellow-800 font-bold text-sm">
                                                Khusus untuk Student
                                            </p>
                                        </div>
                                    @endif
                                @else
                                    <div class="space-y-4">
                                        <a href="{{ route('login') }}" class="block w-full text-center px-6 py-4 gradient-blue text-white font-black text-lg rounded-2xl hover:shadow-2xl hover:shadow-blue-500/50 transition-all transform hover:scale-105 hover:-translate-y-1 shine">
                                            🔐 Login untuk Mendaftar
                                        </a>
                                        <a href="{{ route('register') }}" class="block w-full text-center px-6 py-4 bg-white border-2 border-blue-200 text-blue-600 font-bold text-lg rounded-2xl hover:border-blue-400 hover:bg-blue-50 hover:shadow-xl transition-all transform hover:scale-105">
                                            ✨ Buat Akun Baru
                                        </a>
                                    </div>
                                @endauth

                                <div class="mt-8 pt-6 border-t border-blue-100">
                                    <div class="space-y-3">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span class="font-medium">Akses Selamanya</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span class="font-medium">Sertifikat Digital</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span class="font-medium">Forum Diskusi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>

        <footer class="bg-gradient-to-r from-blue-600 via-blue-600 to-blue-700 py-10 mt-12">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-white font-semibold text-base mb-2">
                    © {{ date('Y') }} LMS-Cerdika
                </p>
                <p class="text-blue-100 text-sm">
                    Belajar Tanpa Batas • Raih Masa Depanmu
                </p>
            </div>
        </footer>

    </div>
</body>
</html>