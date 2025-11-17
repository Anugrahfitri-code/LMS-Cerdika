<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $course->title }} - LMS Cerdika</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body class="antialiased bg-gray-100">
    <div class="min-h-screen">

        <nav class="bg-white border-b border-gray-100 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('homepage') }}" class="text-2xl font-bold text-blue-600">LMS-Cerdika</a>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            {{-- Katalog link bisa ditambah disini jika mau --}}
                        </div>
                    </div>
                    <div class="flex items-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-900 hover:text-blue-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-900 hover:text-blue-600 mr-4">Log in</a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-semibold hover:bg-blue-500">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="mb-6">
                    <a href="{{ route('homepage') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Beranda</a>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-8 border-b border-gray-200 bg-blue-50">
                        <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">{{ $course->category->name }}</span>
                        <h1 class="mt-4 text-4xl font-bold text-gray-900">{{ $course->title }}</h1>
                        <p class="mt-2 text-lg text-gray-600">Oleh: {{ $course->teacher->name }}</p>

                        <div class="mt-6 flex items-center space-x-6">
                            <div class="flex items-center text-gray-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                <span>{{ $course->students_count }} Peserta</span>
                            </div>
                            <div class="flex items-center text-gray-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <span>{{ $course->contents->count() }} Materi</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-2 space-y-6">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Tentang Kursus</h3>
                                <div class="prose text-gray-600">
                                    {{ $course->description }}
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Materi yang Akan Dipelajari</h3>
                                <ul class="space-y-2">
                                    @forelse($course->contents as $index => $content)
                                        <li class="flex items-center p-3 bg-gray-50 rounded-md">
                                            <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full font-bold text-sm mr-3">
                                                {{ $index + 1 }}
                                            </span>
                                            <span class="text-gray-700">{{ $content->title }}</span>
                                            <span class="ml-auto text-xs text-gray-400">Locked 🔒</span>
                                        </li>
                                    @empty
                                        <p class="text-gray-500 italic">Belum ada materi yang diupload.</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div>
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 sticky top-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Tertarik Belajar?</h3>
                                <p class="text-gray-600 text-sm mb-6">Daftar sekarang untuk mengakses semua materi dan mendapatkan sertifikat.</p>

                                @auth
                                    @if(auth()->user()->role === 'student')
                                        {{-- Cek apakah sudah daftar --}}
                                        @if(auth()->user()->enrolledCourses->contains($course->id))
                                             <a href="{{ route('dashboard') }}" class="block w-full text-center px-4 py-3 bg-green-600 text-white font-bold rounded-md hover:bg-green-700">
                                                Lanjutkan Belajar
                                            </a>
                                        @else
                                            <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700">
                                                    Ikuti Kursus Ini
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <div class="text-center p-3 bg-yellow-100 text-yellow-800 rounded-md text-sm">
                                            Login sebagai Student untuk mendaftar.
                                        </div>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700 mb-3">
                                        Login untuk Mendaftar
                                    </a>
                                    <a href="{{ route('register') }}" class="block w-full text-center px-4 py-3 bg-gray-100 text-gray-700 font-bold rounded-md hover:bg-gray-200">
                                        Daftar Akun Baru
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>