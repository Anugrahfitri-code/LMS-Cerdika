<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Pusat aktivitas dan progres belajar Anda.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- ===========================
                 TAMPILAN UNTUK STUDENT
                 =========================== --}}
            @if(auth()->user()->role === 'student')
                
                @php
                    // Hitung statistik sederhana di View
                    $totalCourses = $enrolledCourses->count();
                    $completedCourses = $enrolledCourses->where('progress_percentage', 100)->count();
                    $inProgressCourses = $totalCourses - $completedCourses;
                @endphp

                <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 md:p-10 shadow-xl overflow-hidden text-white">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-indigo-400 opacity-20 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                        <div>
                            <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                            <p class="text-blue-100 text-lg max-w-xl leading-relaxed">
                                Siap melanjutkan perjalanan belajarmu hari ini? Ada <strong>{{ $inProgressCourses }} kursus</strong> yang menunggu untuk diselesaikan.
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <div class="p-4 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center gap-4">
                                <div class="text-right">
                                    <p class="text-xs text-blue-200 uppercase font-bold tracking-wider">Total Sertifikat</p>
                                    <p class="text-2xl font-bold">{{ $completedCourses }}</p>
                                </div>
                                <div class="h-10 w-10 bg-yellow-400 rounded-full flex items-center justify-center text-yellow-800 shadow-lg">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:hidden">
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                        <p class="text-xs text-gray-500 font-bold uppercase">Kursus</p>
                        <p class="text-xl font-bold text-blue-600">{{ $totalCourses }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                        <p class="text-xs text-gray-500 font-bold uppercase">Selesai</p>
                        <p class="text-xl font-bold text-green-600">{{ $completedCourses }}</p>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <div class="w-1 h-6 bg-blue-600 rounded-full"></div>
                            Kursus Saya
                        </h3>
                        <a href="{{ route('course.catalog') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 flex items-center transition-colors">
                            Cari Kursus Baru
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>

                    @if($enrolledCourses->isEmpty())
                        <div class="bg-white rounded-3xl p-10 text-center border border-dashed border-gray-300">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 text-blue-400 rounded-full mb-4">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Belum ada kursus</h3>
                            <p class="text-gray-500 mt-1 mb-6">Mulai perjalanan belajar Anda dengan memilih kursus pertama.</p>
                            <a href="{{ route('course.catalog') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                                Jelajahi Katalog
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($enrolledCourses as $course)
                                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full group overflow-hidden">
                                    
                                    <div class="relative h-40 bg-gray-200 overflow-hidden">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($course->title) }}&background=random&size=400&font-size=0.33&bold=true" 
                                             alt="{{ $course->title }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                        
                                        <div class="absolute bottom-3 left-4 right-4">
                                            <span class="inline-block px-2 py-1 rounded-md bg-white/20 backdrop-blur-sm border border-white/30 text-white text-[10px] font-bold uppercase tracking-wide mb-1">
                                                {{ $course->category->name ?? 'Umum' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="p-5 flex flex-col flex-grow">
                                        <h4 class="text-lg font-bold text-gray-900 leading-tight mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                            {{ $course->title }}
                                        </h4>
                                        
                                        <div class="flex items-center text-xs text-gray-500 mb-4">
                                            <div class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                {{ $course->teacher->name }}
                                            </div>
                                            <span class="mx-2">•</span>
                                            <div>{{ $course->contents_count }} Materi</div>
                                        </div>

                                        <div class="mt-auto">
                                            <div class="flex justify-between items-end mb-1">
                                                <span class="text-xs font-bold text-gray-700">Progres Belajar</span>
                                                <span class="text-xs font-bold {{ $course->progress_percentage == 100 ? 'text-green-600' : 'text-blue-600' }}">
                                                    {{ (int)$course->progress_percentage }}%
                                                </span>
                                            </div>
                                            <div class="w-full bg-gray-100 rounded-full h-2 mb-4 overflow-hidden">
                                                <div class="h-full rounded-full transition-all duration-1000 ease-out {{ $course->progress_percentage == 100 ? 'bg-green-500' : 'bg-blue-600' }}" 
                                                     style="width: {{ $course->progress_percentage }}%"></div>
                                            </div>

                                            <div class="flex items-center gap-2">
                                                @if($course->progress_percentage == 100)
                                                    <a href="{{ route('courses.certificate', $course) }}" class="flex-1 inline-flex justify-center items-center px-4 py-2.5 bg-green-50 text-green-700 border border-green-200 rounded-xl text-xs font-bold hover:bg-green-100 transition-colors">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        Sertifikat
                                                    </a>
                                                    <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $course->firstContent]) }}" class="px-3 py-2.5 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors" title="Review Materi">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    </a>
                                                @else
                                                    <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $course->firstContent]) }}" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20 transform group-hover:-translate-y-0.5">
                                                        Lanjutkan Belajar &rarr;
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>


            {{-- ===========================
                 TAMPILAN UNTUK TEACHER
                 =========================== --}}
            @elseif(auth()->user()->role === 'teacher')
                
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Kursus yang Saya Ajar</h3>
                        <a href="{{ route('courses.create') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-bold rounded-lg hover:bg-indigo-700 transition">
                            + Buat Kursus
                        </a>
                    </div>

                    @if($taughtCourses->isEmpty())
                         <div class="text-center py-10">
                            <p class="text-gray-500">Anda belum memiliki kelas aktif.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($taughtCourses as $course)
                                <div class="border border-gray-200 rounded-xl p-5 hover:border-indigo-300 transition">
                                    <h4 class="font-bold text-lg mb-2">{{ $course->title }}</h4>
                                    <div class="flex justify-between text-sm text-gray-500 mb-4">
                                        <span>{{ $course->students_count }} Siswa</span>
                                        <span class="{{ $course->is_active ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $course->is_active ? 'Aktif' : 'Draft' }}
                                        </span>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('courses.contents.index', $course) }}" class="flex-1 text-center px-3 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-bold hover:bg-indigo-100">Materi</a>
                                        <a href="{{ route('courses.student.progress', $course) }}" class="flex-1 text-center px-3 py-2 bg-blue-50 text-blue-700 rounded-lg text-xs font-bold hover:bg-blue-100">Siswa</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>


            {{-- ===========================
                 TAMPILAN UNTUK ADMIN
                 =========================== --}}
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Pengguna</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</h3>
                        </div>
                    </div>
                     <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Kursus</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total_courses'] }}</h3>
                        </div>
                    </div>
                     <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-xl mr-4">
                           <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Kategori</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total_categories'] }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mt-6">
                    <h3 class="font-bold text-lg mb-4">Pengguna Terbaru</h3>
                    <div class="space-y-4">
                        @foreach($recentUsers as $user)
                            <div class="flex items-center justify-between border-b border-gray-50 pb-2 last:border-0">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <span class="text-xs bg-gray-100 px-2 py-1 rounded capitalize">{{ $user->role }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>