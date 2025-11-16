<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Katalog Kursus - {{ config('app.name', 'LMS-Cerdika') }}</title>

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

            <main class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg shadow-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-8 p-6 bg-white rounded-lg shadow-sm">
                        <h2 class="text-2xl font-semibold mb-4">Cari Kursus</h2>
                        <form action="{{ route('course.catalog') }}" method="GET">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700">Cari kursus</label>
                                    <input type="text" name="search" id="search" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ request('search') }}">
                                </div>
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                                    <select id="category" name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="">Semua Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->slug }}" @selected(request('category') == $category->slug)>
                                                {{ $category->name }}
                                            </option>
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

                            @if($courses->isEmpty())
                                <p class="text-center text-gray-500">Hasil tidak ditemukan.</p>
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    @foreach($courses as $course)
                                        <div class="border rounded-lg overflow-hidden shadow-lg flex flex-col">
                                            <div class="p-4 flex-grow">
                                                <span class="text-xs font-semibold bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $course->category->name }}</span>
                                                <h3 class="text-lg font-bold mt-2">{{ $course->title }}</h3>
                                                <p class="text-sm text-gray-600 mt-1">oleh {{ $course->teacher->name }}</p>
                                                <p class="text-sm text-gray-700 mt-2">{{ Str::limit($course->description, 100) }}</p>
                                            </div>
                                            <div class="p-4 bg-gray-50 flex items-center justify-between">
                                                <a href="mailto:{{ $course->teacher->email }}" class="text-sm font-semibold text-gray-600 hover:text-gray-500">
                                                    Hubungi Teacher
                                                </a>

                                                @auth
                                                    @if(auth()->user()->role === 'student')
                                                        
                                                        {{-- Cek apakah ID kursus ini ada di array $enrolledCourseIds --}}
                                                        @if(in_array($course->id, $enrolledCourseIds))
                                                            <span class="text-sm font-semibold text-green-600">
                                                                &#10003; Sudah Terdaftar
                                                            </span>
                                                        @else
                                                            <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="text-sm font-semibold text-blue-600 hover:text-blue-500">
                                                                    Ikuti Kursus
                                                                </button>
                                                            </form>
                                                        @endif

                                                    @endif
                                                @endauth
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-8">
                                    {{ $courses->links() }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </body>
</html>