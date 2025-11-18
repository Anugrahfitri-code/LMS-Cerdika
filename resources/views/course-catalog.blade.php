<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Kursus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(request('ref') == 'certification')
                    <div class="bg-[#1e1e2c] rounded-xl p-8 mb-8 shadow-xl relative overflow-hidden border border-gray-700 animate-fade-in-down">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-blue-500/20 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none"></div>
                        <div class="absolute bottom-0 left-0 w-40 h-40 bg-purple-500/20 rounded-full blur-3xl -ml-10 -mb-10 pointer-events-none"></div>
                        
                        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center gap-6">
                            <div class="p-4 bg-white/10 rounded-2xl border border-white/10 shadow-inner">
                                <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">Siap untuk Disertifikasi?</h3>
                                <p class="text-gray-300 text-base leading-relaxed max-w-2xl">
                                    Kabar baik! <strong>Semua kursus</strong> di bawah ini menyertakan <span class="text-blue-300 font-semibold">Sertifikat Kelulusan Digital</span> resmi. Selesaikan materi, kerjakan kuis, dan unduh sertifikat Anda langsung dari dashboard untuk meningkatkan profil karier Anda.
                                </p>
                            </div>
                            <div class="md:ml-auto">
                                <a href="{{ route('course.catalog') }}" class="text-sm text-gray-400 hover:text-white flex items-center transition">
                                    <span class="mr-1">&times;</span> Tutup info ini
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
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
                                    <div class="group bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col h-full">
                                        
                                        <a href="{{ route('public.course.show', $course) }}" class="block flex-grow flex flex-col">
                                            
                                            <div class="relative h-48 bg-gray-200 rounded-t-lg overflow-hidden">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($course->title) }}&background=random&size=400" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                                <div class="absolute top-0 right-0 bg-black/50 text-white text-xs font-bold px-2 py-1 m-2 rounded">
                                                    {{ $course->category->name }}
                                                </div>
                                            </div>

                                            <div class="p-4 flex flex-col flex-grow">
                                                <h3 class="text-lg font-bold text-gray-900 line-clamp-2 leading-snug group-hover:text-blue-700 transition-colors">
                                                    {{ $course->title }}
                                                </h3>
                                                
                                                <p class="text-xs text-gray-500 mt-1 truncate">{{ $course->teacher->name }}</p>
                                                
                                                <div class="flex items-center mt-2 mb-1">
                                                    <span class="text-sm font-bold text-orange-800 mr-1">4.8</span>
                                                    <div class="flex text-orange-400 text-xs">
                                                        ★★★★★
                                                    </div>
                                                    <span class="text-xs text-gray-400 ml-1">({{ $course->students_count * 12 }})</span>
                                                </div>

                                                <p class="text-sm text-gray-600 mt-2 line-clamp-2 mb-4">
                                                    {{ Str::limit(strip_tags($course->description), 80) }}
                                                </p>

                                                <div class="mt-auto flex items-end justify-between">
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

                                        <div class="p-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                                            <a href="mailto:{{ $course->teacher->email }}" class="text-sm font-semibold text-gray-500 hover:text-gray-700 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                Hubungi
                                            </a>
                                            
                                            @auth
                                                @if(auth()->user()->role === 'student')
                                                    @if(in_array($course->id, $enrolledCourseIds))
                                                        <span class="text-sm font-bold text-green-600 flex items-center bg-green-50 px-2 py-1 rounded-md border border-green-200">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                            Terdaftar
                                                        </span>
                                                    @else
                                                        <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md transition-colors shadow-sm">
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
    </div>
</x-app-layout>