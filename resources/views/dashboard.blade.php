<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Pusat aktivitas dan ringkasan akun Anda.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="px-4 py-2 rounded-full bg-white border border-gray-200 text-xs font-bold text-gray-600 shadow-sm">
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- ==================================================================================
                                             TAMPILAN STUDENT
                 ================================================================================== --}}
            @if(auth()->user()->role === 'student')
                
                @php
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
                                Siap melanjutkan perjalanan belajarmu hari ini? Kamu memiliki <strong>{{ $inProgressCourses }} kursus</strong> yang sedang berjalan.
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <div class="p-4 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center gap-4">
                                <div class="text-right">
                                    <p class="text-xs text-blue-200 uppercase font-bold tracking-wider">Sertifikat Diraih</p>
                                    <p class="text-2xl font-bold">{{ $completedCourses }}</p>
                                </div>
                                <div class="h-12 w-12 bg-yellow-400 rounded-full flex items-center justify-center text-yellow-800 shadow-lg">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:hidden">
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 text-center">
                        <p class="text-xs text-gray-500 font-bold uppercase">Kursus</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $totalCourses }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 text-center">
                        <p class="text-xs text-gray-500 font-bold uppercase">Selesai</p>
                        <p class="text-2xl font-bold text-green-600">{{ $completedCourses }}</p>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                            Kursus Saya
                        </h3>
                        <a href="{{ route('course.catalog') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 flex items-center transition-colors bg-blue-50 px-3 py-1.5 rounded-lg">
                            Cari Kursus Baru
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>

                    @if($enrolledCourses->isEmpty())
                        <div class="bg-white rounded-3xl p-12 text-center border-2 border-dashed border-gray-200">
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
                                                <span class="text-xs font-bold text-gray-700">Progres</span>
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


            {{-- ==================================================================================
                                             TAMPILAN TEACHER
                 ================================================================================== --}}
            @elseif(auth()->user()->role === 'teacher')
                
                @php
                    $totalStudents = $taughtCourses->sum('students_count');
                    $activeCourses = $taughtCourses->where('is_active', 1)->count();
                @endphp

                <div class="relative bg-gradient-to-r from-indigo-700 to-purple-800 rounded-3xl p-8 md:p-10 shadow-xl overflow-hidden text-white mb-10">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-blue-500 opacity-20 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div>
                            <div class="inline-flex items-center gap-2 mb-3 bg-white/20 backdrop-blur-md border border-white/20 px-3 py-1 rounded-lg">
                                <svg class="w-4 h-4 text-indigo-200" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path></svg>
                                <span class="text-xs font-bold uppercase tracking-wider">Panel Pengajar</span>
                            </div>
                            <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👨‍🏫</h1>
                            <p class="text-indigo-100 text-lg max-w-lg">Kelola kurikulum, pantau siswa, dan tingkatkan kualitas pembelajaran Anda di sini.</p>
                        </div>
                        
                        <div class="flex gap-4">
                            <div class="text-center p-5 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl min-w-[110px] shadow-lg">
                                <p class="text-3xl font-black">{{ $totalStudents }}</p>
                                <p class="text-[10px] text-indigo-200 uppercase font-bold tracking-widest mt-1">Total Siswa</p>
                            </div>
                            <div class="text-center p-5 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl min-w-[110px] shadow-lg">
                                <p class="text-3xl font-black">{{ $activeCourses }}</p>
                                <p class="text-[10px] text-indigo-200 uppercase font-bold tracking-widest mt-1">Kelas Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                            Kursus yang Saya Ajar
                        </h3>
                        <a href="{{ route('courses.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-600/30 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Buat Kursus Baru
                        </a>
                    </div>

                    @if($taughtCourses->isEmpty())
                         <div class="bg-white rounded-3xl p-12 text-center border-2 border-dashed border-gray-200 hover:border-indigo-300 transition-colors group">
                            <div class="inline-flex items-center justify-center w-24 h-24 bg-indigo-50 text-indigo-400 rounded-full mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Belum ada kursus</h3>
                            <p class="text-gray-500 mt-2 mb-8 max-w-md mx-auto">Anda belum membuat kelas apapun. Mulai bagikan ilmu Anda sekarang.</p>
                            <a href="{{ route('courses.create') }}" class="inline-flex items-center px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                + Buat Kursus Pertama
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($taughtCourses as $course)
                                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full group overflow-hidden relative">
                                    
                                    <div class="relative h-40 bg-gray-100 overflow-hidden">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($course->title) }}&background=random&size=400&font-size=0.33&bold=true&color=fff" 
                                             alt="{{ $course->title }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

                                        <div class="absolute top-3 right-3">
                                            @if($course->is_active)
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-green-500/90 text-white text-[10px] font-bold uppercase tracking-wide backdrop-blur-sm shadow-sm border border-green-400/50">
                                                    <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span> Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-gray-800/80 text-white text-[10px] font-bold uppercase tracking-wide backdrop-blur-sm shadow-sm border border-gray-600/50">
                                                    Draft
                                                </span>
                                            @endif
                                        </div>

                                        <div class="absolute bottom-3 left-4">
                                             <span class="text-[10px] font-bold text-white bg-white/20 backdrop-blur-md px-2 py-0.5 rounded border border-white/30 uppercase tracking-wider">
                                                {{ $course->category->name ?? 'Umum' }}
                                             </span>
                                        </div>
                                    </div>

                                    <div class="p-6 flex flex-col flex-grow">
                                        <h4 class="text-lg font-bold text-gray-900 leading-snug mb-3 line-clamp-2 group-hover:text-indigo-600 transition-colors">
                                            {{ $course->title }}
                                        </h4>
                                        
                                        <div class="flex items-center justify-between text-xs text-gray-500 mb-6 pt-2">
                                            <div class="flex items-center gap-1" title="Jumlah Siswa">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                                <span class="font-semibold text-gray-700">{{ $course->students_count }} Siswa</span>
                                            </div>
                                            <div class="flex items-center gap-1" title="Jumlah Materi">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                <span class="font-semibold text-gray-700">{{ $course->contents_count ?? 0 }} Materi</span>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 gap-3 mt-auto">
                                            <a href="{{ route('courses.contents.index', $course) }}" class="flex items-center justify-center px-4 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-xs font-bold hover:bg-indigo-100 transition border border-indigo-100 group/btn">
                                                <svg class="w-4 h-4 mr-1.5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Edit Materi
                                            </a>
                                            <a href="{{ route('courses.student.progress', $course) }}" class="flex items-center justify-center px-4 py-2.5 bg-white text-gray-600 border border-gray-200 rounded-xl text-xs font-bold hover:bg-gray-50 hover:text-gray-900 transition hover:border-gray-300">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                                Progress
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>


            {{-- ==================================================================================
                                             TAMPILAN ADMIN
                 ================================================================================== --}}
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
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-lg text-gray-900">Pengguna Terbaru</h3>
                        <a href="{{ route('users.index') }}" class="text-sm text-blue-600 font-semibold hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-4">
                        @foreach($recentUsers as $user)
                            <div class="flex items-center justify-between border-b border-gray-50 pb-3 last:border-0">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full flex items-center justify-center font-bold text-white text-sm shadow-sm
                                        {{ $user->role == 'admin' ? 'bg-red-500' : ($user->role == 'teacher' ? 'bg-purple-500' : 'bg-blue-500') }}">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-gray-900">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <span class="text-xs px-2.5 py-1 rounded-full font-bold border
                                    {{ $user->role == 'admin' ? 'bg-red-50 text-red-700 border-red-100' : ($user->role == 'teacher' ? 'bg-purple-50 text-purple-700 border-purple-100' : 'bg-blue-50 text-blue-700 border-blue-100') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

            @endif

        </div>
    </div>
</x-app-layout>