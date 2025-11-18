<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kisah Sukses Alumni - {{ config('app.name', 'LMS-Cerdika') }}</title>
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-pattern {
            background-color: #1e40af;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.12'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        
        <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <a href="{{ route('homepage') }}" class="flex items-center gap-2">
                            <span class="text-2xl font-bold text-blue-600 tracking-tight">LMS-Cerdika</span>
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Masuk</a>
                            <a href="{{ route('register') }}" class="px-5 py-2 bg-blue-600 text-white rounded-full text-sm font-bold hover:bg-blue-700 transition">Daftar Gratis</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <div class="relative hero-pattern py-20 text-center text-white">
            <div class="absolute top-6 left-4 md:left-8 z-20">
                <a href="{{ route('homepage') }}" class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-sm font-semibold text-white hover:bg-white/20 transition group">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <span class="inline-block py-1 px-3 rounded-full bg-white/10 border border-white/20 text-blue-100 text-xs font-bold tracking-wider mb-6 uppercase">
                    Kumpulan Kisah Sukses Alumni
                </span>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-6">
                    Mereka yang Telah Berhasil <br>Mewujudkan Mimpi
                </h1>
                <p class="text-lg text-blue-100 max-w-2xl mx-auto">
                    Lihat bagaimana ribuan siswa kami mentransformasi karier dan kehidupan mereka melalui pendidikan berkualitas di LMS-Cerdika.
                </p>
            </div>
        </div>

        <main class="flex-grow py-16 -mt-10 relative z-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($stories as $story)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 flex flex-col h-full transform hover:-translate-y-1 transition duration-300">
                            <div class="mb-6">
                                <svg class="w-10 h-10 text-blue-100" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z"></path></svg>
                            </div>

                            <p class="text-gray-600 text-lg italic mb-6 flex-grow leading-relaxed">
                                "{{ $story['quote'] }}"
                            </p>

                            <div class="border-t border-gray-100 my-6"></div>

                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg {{ $story['avatar_color'] }}">
                                        {{ substr($story['name'], 0, 2) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-base font-bold text-gray-900">{{ $story['name'] }}</h4>
                                    <p class="text-xs text-gray-500">{{ $story['role'] }} di <span class="text-blue-600 font-semibold">{{ $story['company'] }}</span></p>
                                </div>
                            </div>

                            <div class="mt-4 pt-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Alumni: {{ $story['course'] }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-20 text-center">
                    <div class="bg-white rounded-3xl p-10 shadow-xl border border-gray-100 max-w-4xl mx-auto relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Giliran Anda Menjadi Bagian dari Cerita Ini</h2>
                        <p class="text-gray-600 mb-8 max-w-lg mx-auto">
                            Bergabunglah dengan ribuan siswa lainnya. Mulai belajar hari ini dan bangun masa depan impian Anda.
                        </p>
                        <a href="{{ route('register') }}" class="inline-block px-8 py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">
                            Mulai Belajar Gratis Sekarang
                        </a>
                    </div>
                </div>

            </div>
        </main>

        <footer class="bg-white border-t border-gray-200 py-8 mt-auto">
            <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} LMS-Cerdika. All rights reserved.
            </div>
        </footer>

    </div>
</body>
</html>