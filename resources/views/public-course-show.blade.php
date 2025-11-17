<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $course->title }} - LMS Cerdika</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body class="antialiased bg-gray-50 font-sans">
    <div class="min-h-screen flex flex-col">
        
        <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('homepage') }}" class="text-2xl font-bold text-blue-600 tracking-tight">LMS-Cerdika</a>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition">Log in</a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold hover:bg-blue-700 transition shadow-md">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <nav class="flex mb-6" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li><a href="{{ route('homepage') }}" class="text-gray-500 hover:text-blue-600">Beranda</a></li>
                        <li><span class="text-gray-400">/</span></li>
                        <li><span class="text-gray-900 font-medium truncate max-w-[200px]">{{ $course->title }}</span></li>
                    </ol>
                </nav>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-8">
                        
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 overflow-hidden relative">
                            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-50 rounded-full blur-2xl opacity-50"></div>
                            
                            <div class="relative z-10">
                                <span class="px-3 py-1 text-xs font-bold tracking-wider text-blue-700 uppercase bg-blue-100 rounded-full">
                                    {{ $course->category->name }}
                                </span>
                                <h1 class="mt-4 text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                                    {{ $course->title }}
                                </h1>
                                <div class="flex items-center mt-4 text-gray-600">
                                    <div class="flex items-center mr-6">
                                        <div class="p-1 bg-gray-100 rounded-full mr-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium">{{ $course->teacher->name }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="p-1 bg-gray-100 rounded-full mr-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        </div>
                                        <span class="text-sm font-medium">{{ $course->students_count }} Peserta</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Tentang Kursus
                            </h3>
                            <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed">
                                {!! nl2br(e($course->description)) !!}
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    Materi Pembelajaran
                                </h3>
                                <span class="text-sm text-gray-500">{{ $course->contents->count() }} Pelajaran</span>
                            </div>

                            {{-- Cek apakah user sudah login & terdaftar --}}
                            @php
                                $isEnrolled = Auth::check() && Auth::user()->role === 'student' && Auth::user()->enrolledCourses->contains($course->id);
                            @endphp

                            <div class="space-y-3">
                                @forelse($course->contents as $index => $content)
                                    
                                    @if($isEnrolled)
                                        <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $content]) }}" 
                                           class="group flex items-center p-4 bg-white border border-gray-200 rounded-xl hover:border-blue-400 hover:shadow-md transition-all duration-200 cursor-pointer">
                                            <div class="flex-shrink-0 mr-4">
                                                <span class="w-10 h-10 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full group-hover:bg-blue-600 group-hover:text-white transition-colors duration-200">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                                </span>
                                            </div>
                                            <div class="flex-grow">
                                                <h4 class="text-base font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                                                    {{ $content->title }}
                                                </h4>
                                                <p class="text-xs text-gray-500 mt-1">Klik untuk mulai belajar</p>
                                            </div>
                                            <div class="flex-shrink-0 ml-4 text-gray-400 group-hover:text-blue-500 group-hover:translate-x-1 transition-transform">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </div>
                                        </a>

                                    @else
                                        <div class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-xl opacity-75">
                                            <div class="flex-shrink-0 mr-4">
                                                <span class="w-10 h-10 flex items-center justify-center bg-gray-200 text-gray-500 rounded-full font-semibold text-sm">
                                                    {{ $index + 1 }}
                                                </span>
                                            </div>
                                            <div class="flex-grow">
                                                <h4 class="text-base font-medium text-gray-600">
                                                    {{ $content->title }}
                                                </h4>
                                            </div>
                                            <div class="flex-shrink-0 ml-4 text-gray-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            </div>
                                        </div>
                                    @endif

                                @empty
                                    <div class="text-center py-8 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                        <p class="text-gray-500 italic">Belum ada materi yang diupload.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-white border border-gray-200 rounded-2xl shadow-lg p-6 sticky top-24">
                            <div class="text-center mb-6">
                                <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Gratis untuk Mahasiswa</span>
                                <h3 class="text-2xl font-bold text-gray-900 mt-2">Tertarik Belajar?</h3>
                                <p class="text-gray-600 text-sm mt-2 px-2">
                                    Daftar sekarang untuk mengakses semua materi, forum diskusi, dan sertifikat kelulusan.
                                </p>
                            </div>
                            
                            @auth
                                @if(auth()->user()->role === 'student')
                                    {{-- Cek apakah sudah daftar --}}
                                    @if($isEnrolled)
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4 text-center">
                                            <p class="text-green-800 font-semibold text-sm flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                Anda Sudah Terdaftar
                                            </p>
                                        </div>
                                        
                                        <a href="{{ route('dashboard') }}" class="block w-full text-center px-6 py-3.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 shadow-lg shadow-green-600/30 transition-all transform hover:-translate-y-0.5">
                                            Lanjutkan Belajar &rarr;
                                        </a>
                                    @else
                                        <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full px-6 py-3.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition-all transform hover:-translate-y-0.5">
                                                Ikuti Kursus Sekarang
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <div class="text-center p-4 bg-yellow-50 border border-yellow-100 rounded-xl text-yellow-800 text-sm font-medium">
                                        Hanya Student yang bisa mendaftar kursus.
                                    </div>
                                @endif
                            @else
                                <div class="space-y-3">
                                    <a href="{{ route('login') }}" class="block w-full text-center px-6 py-3.5 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition">
                                        Login untuk Mendaftar
                                    </a>
                                    <a href="{{ route('register') }}" class="block w-full text-center px-6 py-3.5 bg-white border-2 border-gray-200 text-gray-700 font-bold rounded-xl hover:border-gray-300 hover:bg-gray-50 transition">
                                        Buat Akun Baru
                                    </a>
                                </div>
                            @endauth

                            <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                                <p class="text-xs text-gray-400">
                                    Akses selamanya • Sertifikat Digital • Forum Diskusi
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>

        <footer class="bg-white border-t border-gray-100 py-8">
            <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} LMS-Cerdika. All rights reserved.
            </div>
        </footer>

    </div>
</body>
</html>