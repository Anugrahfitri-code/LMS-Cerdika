<x-app-layout>
    {{-- Header dengan Background Gradient Blue Theme --}}
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-500 to-indigo-600 pt-24 pb-32 overflow-hidden">
    {{-- Background Pattern & Decorative Elements --}}
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        {{-- Floating Orbs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-400 opacity-20 rounded-full blur-2xl -ml-10 -mb-10 animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/4 w-48 h-48 bg-purple-400 opacity-10 rounded-full blur-2xl animate-pulse" style="animation-delay: 2s;"></div>
        
        {{-- Geometric Shapes --}}
        <div class="absolute top-10 left-10 w-20 h-20 border-4 border-white/20 rounded-lg rotate-12 animate-float"></div>
        <div class="absolute bottom-20 right-20 w-16 h-16 border-4 border-white/20 rounded-full animate-float" style="animation-delay: 1.5s;"></div>
        <div class="absolute top-1/3 right-1/4 w-12 h-12 bg-white/10 rotate-45 animate-float" style="animation-delay: 0.5s;"></div>
        
        {{-- Dotted Pattern --}}
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-1/4 w-2 h-2 bg-white rounded-full"></div>
            <div class="absolute top-32 left-1/3 w-2 h-2 bg-white rounded-full"></div>
            <div class="absolute top-40 left-1/2 w-2 h-2 bg-white rounded-full"></div>
            <div class="absolute bottom-32 right-1/4 w-2 h-2 bg-white rounded-full"></div>
            <div class="absolute bottom-40 right-1/3 w-2 h-2 bg-white rounded-full"></div>
        </div>
        
        {{-- Book Icon Decorations --}}
        <div class="absolute top-16 right-1/3 opacity-10 animate-float" style="animation-delay: 1s;">
            <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 2.18l8 4V13c0 4.52-3.13 8.78-8 9.92-4.87-1.14-8-5.4-8-9.92V8.18l8-4zM11 7v2h2V7h-2zm0 4v6h2v-6h-2z"/>
            </svg>
        </div>
        
        <div class="absolute bottom-24 left-1/4 opacity-10 animate-float" style="animation-delay: 2s;">
            <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1zm0 13.5c-1.1-.35-2.3-.5-3.5-.5-1.7 0-4.15.65-5.5 1.5V8c1.35-.85 3.8-1.5 5.5-1.5 1.2 0 2.4.15 3.5.5v11.5z"/>
            </svg>
        </div>
        
        {{-- Graduation Cap Icon --}}
        <div class="absolute top-1/2 right-12 opacity-10 animate-float" style="animation-delay: 0.75s;">
            <svg class="w-28 h-28 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
            </svg>
        </div>
        
        {{-- Light Rays Effect --}}
        <div class="absolute inset-0 bg-gradient-to-t from-transparent via-white/5 to-transparent transform -skew-y-12"></div>
    </div>

    {{-- Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        {{-- Icon Badge --}}
        <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl mb-6 border-2 border-white/30 shadow-xl animate-bounce-slow">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        
        <h2 class="text-5xl font-extrabold text-white tracking-tight mb-4 drop-shadow-lg animate-fade-in-down">
            Katalog Kursus
        </h2>
        <p class="text-blue-100 text-lg max-w-2xl mx-auto drop-shadow-md animate-fade-in-up">
            Temukan materi pembelajaran terbaik untuk meningkatkan keahlian Anda.
        </p>
        
        {{-- Stats Badges --}}
        <div class="flex flex-wrap justify-center gap-4 mt-8 animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-5 py-2 flex items-center gap-2 shadow-lg">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
                <span class="text-white font-semibold text-sm">1000+ Siswa</span>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-5 py-2 flex items-center gap-2 shadow-lg">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                </svg>
                <span class="text-white font-semibold text-sm">50+ Kursus</span>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-5 py-2 flex items-center gap-2 shadow-lg">
                <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="text-white font-semibold text-sm">Rating 4.9</span>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }
    
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fade-in-up {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
    
    .animate-fade-in-down {
        animation: fade-in-down 0.8s ease-out;
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out;
    }
</style>

    {{-- Search Box Container (Floating Effect) --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 -mt-8">
        <div class="bg-white rounded-2xl shadow-xl p-4 border border-gray-100">
            <form action="{{ route('course.catalog') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
                
                {{-- Input Search --}}
                <div class="flex-grow w-full relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="block w-full pl-12 pr-4 py-3.5 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 focus:bg-white transition-all" 
                           placeholder="Cari kursus (cth: Laravel, Python)...">
                </div>

                {{-- Dropdown Kategori --}}
                <div class="w-full md:w-auto md:min-w-[250px] relative group flex-shrink-0">
                     <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <select name="category" class="block w-full pl-12 pr-10 py-3.5 border-gray-200 rounded-xl text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 focus:bg-white transition-all cursor-pointer appearance-none">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" @selected(request('category') == $cat->slug)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>

                {{-- Tombol Cari --}}
                <button type="submit" class="w-full md:w-auto px-8 py-3.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-lg shadow-blue-500/30 flex items-center justify-center flex-shrink-0">
                    Cari Kursus
                </button>
            </form>
        </div>

        {{-- Menampilkan Filter yang Sedang Aktif --}}
        @if(request('search') || request('category'))
            <div class="mt-6 flex flex-wrap items-center gap-3 text-sm animate-fade-in-up">
                <span class="text-gray-500 font-medium">Filter aktif:</span>
                
                @if(request('search'))
                    <span class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold border border-blue-100 shadow-sm">
                        <svg class="w-3 h-3 mr-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        "{{ request('search') }}"
                    </span>
                @endif

                @if(request('category'))
                    <span class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-bold border border-indigo-100 shadow-sm">
                        <svg class="w-3 h-3 mr-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        {{ request('category') }}
                    </span>
                @endif

                <div class="h-4 w-px bg-gray-300 mx-1"></div>

                {{-- Tombol Reset --}}
                <a href="{{ route('course.catalog') }}" class="inline-flex items-center px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold hover:bg-red-100 hover:text-red-700 transition-colors border border-red-100 group">
                    <span>Reset Filter</span>
                    <div class="bg-red-200 rounded-full p-0.5 ml-2 group-hover:bg-red-300 transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </a>
            </div>
        @endif
    </div>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Flash Message --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm flex items-center animate-fade-in-down">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Grid Kursus --}}
            @if($courses->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div class="bg-white p-6 rounded-full shadow-sm mb-4">
                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Tidak ada kursus ditemukan</h3>
                    <p class="text-gray-500 mt-1">Coba kata kunci lain atau reset filter pencarian Anda.</p>
                    <a href="{{ route('course.catalog') }}" class="mt-4 px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                        Lihat Semua Kursus
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full overflow-hidden group">
                            
                            <a href="{{ route('public.course.show', $course) }}" class="block relative h-48 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($course->title) }}&background=random&size=400&font-size=0.33" 
                                     alt="{{ $course->title }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <div class="absolute top-3 right-3">
                                    <span class="bg-white/90 backdrop-blur-sm text-blue-600 text-xs font-bold px-3 py-1 rounded-full shadow-sm border border-blue-100">
                                        {{ $course->category->name }}
                                    </span>
                                </div>
                            </a>

                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                        <span class="text-xs text-gray-500 font-medium">Online Course</span>
                                    </div>
                                    <div class="flex items-center text-orange-400 text-xs font-bold">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        4.8 ({{ $course->students_count }})
                                    </div>
                                </div>

                                <a href="{{ route('public.course.show', $course) }}" class="group-hover:text-blue-600 transition-colors">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 leading-tight">
                                        {{ $course->title }}
                                    </h3>
                                </a>

                                <p class="text-gray-500 text-sm line-clamp-2 mb-4 flex-grow">
                                    {{ Str::limit(strip_tags($course->description), 100) }}
                                </p>

                                <div class="flex items-center mt-auto pt-4 border-t border-gray-50">
                                    <div class="flex items-center flex-1">
                                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 text-xs font-bold mr-2">
                                            {{ substr($course->teacher->name, 0, 2) }}
                                        </div>
                                        <span class="text-sm text-gray-600 truncate max-w-[100px]" title="{{ $course->teacher->name }}">
                                            {{ $course->teacher->name }}
                                        </span>
                                    </div>
                                    
                                    @auth
                                        @if(auth()->user()->role === 'student')
                                            @if(in_array($course->id, $enrolledCourseIds))
                                                <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $course->contents->first()]) }}" 
                                                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-xs font-bold rounded-lg hover:bg-green-700 transition shadow-md">
                                                    Lanjut Belajar
                                                </a>
                                            @else
                                                <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-lg hover:bg-blue-700 transition shadow-md">
                                                        Ambil Kursus
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <span class="text-xs font-medium text-gray-400 bg-gray-100 px-3 py-1 rounded-full">Mode Guru</span>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" onclick="return confirm('Silakan Login atau Daftar terlebih dahulu untuk mengambil kursus ini.')" 
                                           class="inline-flex items-center px-4 py-2 bg-white border border-blue-600 text-blue-600 text-xs font-bold rounded-lg hover:bg-blue-50 transition">
                                            Ambil Kursus
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.3s ease-out;
        }
    </style>
</x-app-layout>