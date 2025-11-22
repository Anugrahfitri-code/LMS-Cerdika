<x-app-layout>
    {{-- Header dengan Background Gradient Blue Theme --}}
    <div class="relative bg-gradient-to-r from-blue-600 to-blue-500 pt-24 pb-32 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500 opacity-20 rounded-full blur-2xl -ml-10 -mb-10"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-4xl font-extrabold text-white tracking-tight mb-4">
                Katalog Kursus
            </h2>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">
                Temukan materi pembelajaran terbaik untuk meningkatkan keahlian Anda.
            </p>
        </div>
    </div>

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