<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LMS-Cerdika') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen">

            <nav class="bg-white border-b border-gray-100 shadow-md">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <a href="{{ route('homepage') }}" class="text-2xl font-bold text-blue-600">
                                LMS-Cerdika
                            </a>
                        </div>

                        <div class="flex items-center">
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline mr-4">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
                    <h1 class="text-4xl font-bold text-gray-900">
                        Selamat Datang di LMS-Cerdika
                    </h1>
                    <p class="mt-4 text-lg text-gray-600">
                        Temukan kursus terbaik untuk meningkatkan skill Anda.
                    </p>
                </div>
            </header>

            <main class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    <div class="mb-8 p-6 bg-white rounded-lg shadow-sm">
                        <form action="{{ route('course.catalog') }}" method="GET"> {{-- Nanti kita arahkan ke halaman Catalog --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700">Cari kursus</label>
                                    <input type="text" name="search" id="search" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: Belajar Laravel">
                                </div>
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                                    <select id="category" name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="">Semua Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                                        Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h2 class="text-2xl font-semibold mb-6">Kursus Terpopuler</h2>

                            @if($popularCourses->isEmpty())
                                <p class="text-center text-gray-500">Belum ada kursus populer saat ini.</p>
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                                    @foreach($popularCourses as $course)
                                        <div class="border rounded-lg overflow-hidden shadow-lg">
                                            {{-- Kita akan tambahkan gambar di sini nanti --}}
                                            <div class="p-4">
                                                <span class="text-xs font-semibold bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $course->category->name ?? 'Kategori' }}</span>
                                                <h3 class="text-lg font-bold mt-2">{{ $course->title }}</h3>
                                                <p class="text-sm text-gray-600 mt-1">oleh {{ $course->teacher->name ?? 'Teacher' }}</p>
                                                <div class="mt-4 flex items-center justify-between">
                                                    <span class="text-sm font-medium text-gray-700">{{ $course->students_count }} Peserta</span>
                                                    {{-- Nanti ganti # dengan link ke detail course --}}
                                                    <a href="{{ route('public.course.show', $course) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-500">Lihat Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </body>
</html>