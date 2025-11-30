<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent leading-tight tracking-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Pusat aktivitas dan ringkasan akun Anda.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="px-4 py-2 rounded-full bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 text-xs font-bold text-blue-700 shadow-sm">
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 via-white to-blue-50">
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

                <div class="relative bg-gradient-to-r from-blue-600 via-blue-500 to-blue-400 rounded-3xl p-8 md:p-10 shadow-2xl overflow-hidden text-white">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-300 opacity-20 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none animate-pulse"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-blue-400 opacity-30 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>
                    <div class="absolute top-1/2 left-1/3 w-32 h-32 bg-blue-200 opacity-20 rounded-full blur-2xl pointer-events-none"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                        <div>
                            <h1 class="text-3xl md:text-4xl font-extrabold mb-2 drop-shadow-lg">Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                            <p class="text-blue-50 text-lg max-w-xl leading-relaxed">
                                Siap melanjutkan perjalanan belajarmu hari ini? Kamu memiliki <strong class="text-white">{{ $inProgressCourses }} kursus</strong> yang sedang berjalan.
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <div class="p-4 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center gap-4 shadow-xl">
                                <div class="text-right">
                                    <p class="text-xs text-blue-100 uppercase font-bold tracking-wider">Sertifikat Diraih</p>
                                    <p class="text-2xl font-bold drop-shadow-md">{{ $completedCourses }}</p>
                                </div>
                                <div class="h-12 w-12 bg-gradient-to-br from-blue-200 to-blue-300 rounded-full flex items-center justify-center text-blue-700 shadow-lg shadow-blue-300/50">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:hidden">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-2xl shadow-lg border border-blue-200 text-center hover:shadow-xl transition-all">
                        <p class="text-xs text-blue-600 font-bold uppercase">Kursus</p>
                        <p class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">{{ $totalCourses }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-blue-100 to-blue-200 p-4 rounded-2xl shadow-lg border border-blue-300 text-center hover:shadow-xl transition-all">
                        <p class="text-xs text-blue-700 font-bold uppercase">Selesai</p>
                        <p class="text-2xl font-bold bg-gradient-to-r from-blue-700 to-blue-600 bg-clip-text text-transparent">{{ $completedCourses }}</p>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <div class="w-1.5 h-6 bg-gradient-to-b from-blue-600 to-blue-400 rounded-full shadow-lg shadow-blue-500/30"></div>
                            Kursus Saya
                        </h3>
                        <a href="{{ route('course.catalog') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 flex items-center transition-all bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 px-4 py-2 rounded-xl shadow-sm hover:shadow-md">
                            Cari Kursus Baru
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>

                    @if($enrolledCourses->isEmpty())
                        <div class="bg-gradient-to-br from-blue-50 via-white to-blue-100 rounded-3xl p-12 text-center border-2 border-dashed border-blue-300 shadow-lg">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 text-blue-600 rounded-full mb-4 shadow-lg shadow-blue-500/20">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Belum ada kursus</h3>
                            <p class="text-gray-500 mt-1 mb-6">Mulai perjalanan belajar Anda dengan memilih kursus pertama.</p>
                            <a href="{{ route('course.catalog') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-600 transition-all shadow-lg shadow-blue-500/40 hover:shadow-xl hover:shadow-blue-500/50 transform hover:-translate-y-1">
                                Jelajahi Katalog
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($enrolledCourses as $course)
                                <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 border border-blue-100 flex flex-col h-full group overflow-hidden hover:-translate-y-1">
                                    
                                    <div class="relative h-40 bg-gradient-to-br from-blue-100 to-blue-200 overflow-hidden">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($course->title) }}&background=random&size=400&font-size=0.33&bold=true" 
                                             alt="{{ $course->title }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/70 via-blue-800/20 to-transparent"></div>
                                        
                                        <div class="absolute bottom-3 left-4 right-4">
                                            <span class="inline-block px-2 py-1 rounded-md bg-gradient-to-r from-blue-500/80 to-blue-600/80 backdrop-blur-sm border border-blue-300/30 text-white text-[10px] font-bold uppercase tracking-wide mb-1 shadow-lg">
                                                {{ $course->category->name ?? 'Umum' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="p-5 flex flex-col flex-grow bg-gradient-to-br from-white to-blue-50/30">
                                        <h4 class="text-lg font-bold text-gray-900 leading-tight mb-2 line-clamp-2 group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-blue-500 group-hover:bg-clip-text group-hover:text-transparent transition-all">
                                            {{ $course->title }}
                                        </h4>
                                        
                                        <div class="flex items-center text-xs text-gray-500 mb-4">
                                            <div class="flex items-center">
                                                <svg class="w-3 h-3 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                {{ $course->teacher->name }}
                                            </div>
                                            <span class="mx-2">•</span>
                                            <div>{{ $course->contents_count }} Materi</div>
                                        </div>

                                        <div class="mt-auto">
                                            <div class="flex justify-between items-end mb-1">
                                                <span class="text-xs font-bold text-gray-700">Progres</span>
                                                <span class="text-xs font-bold bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">
                                                    {{ (int)$course->progress_percentage }}%
                                                </span>
                                            </div>
                                            <div class="w-full bg-gradient-to-r from-blue-100 to-blue-200 rounded-full h-2 mb-4 overflow-hidden shadow-inner">
                                                <div class="h-full rounded-full transition-all duration-1000 ease-out bg-gradient-to-r from-blue-600 via-blue-500 to-blue-400 shadow-lg" 
                                                     style="width: {{ $course->progress_percentage }}%"></div>
                                            </div>

                                            <div class="flex items-center gap-2">
                                                @if($course->progress_percentage == 100)
                                                    <a href="{{ route('courses.certificate', $course) }}" class="flex-1 inline-flex justify-center items-center px-4 py-2.5 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 border border-blue-200 rounded-xl text-xs font-bold hover:from-blue-100 hover:to-blue-200 transition-all shadow-sm hover:shadow-md">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        Sertifikat
                                                    </a>
                                                    <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $course->firstContent]) }}" class="px-3 py-2.5 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-600 rounded-xl hover:from-blue-200 hover:to-blue-300 transition-all shadow-sm" title="Review Materi">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    </a>
                                                @else
                                                    <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $course->firstContent]) }}" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl text-xs font-bold hover:from-blue-700 hover:to-blue-600 transition-all shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transform group-hover:-translate-y-0.5">
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

                

                <div class="relative bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500 rounded-3xl p-8 md:p-10 shadow-2xl overflow-hidden text-white mb-10">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-300 opacity-20 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none animate-pulse"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-blue-400 opacity-30 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>
                    <div class="absolute top-1/3 right-1/3 w-32 h-32 bg-blue-200 opacity-20 rounded-full blur-2xl pointer-events-none"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div>
                            <div class="inline-flex items-center gap-2 mb-3 bg-gradient-to-r from-white/20 to-white/10 backdrop-blur-md border border-white/20 px-3 py-1 rounded-lg shadow-lg">
                                <svg class="w-4 h-4 text-blue-100" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path></svg>
                                <span class="text-xs font-bold uppercase tracking-wider">Panel Pengajar</span>
                            </div>
                            <h1 class="text-3xl md:text-4xl font-extrabold mb-2 drop-shadow-lg">Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👨‍🏫</h1>
                            <p class="text-blue-50 text-lg max-w-lg">Kelola kurikulum, pantau siswa, dan tingkatkan kualitas pembelajaran Anda di sini.</p>
                        </div>
                        
                        <div class="flex gap-4">
                            <div class="text-center p-5 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-md border border-white/20 rounded-2xl min-w-[110px] shadow-xl hover:scale-105 transition-transform">
                                <p class="text-3xl font-black drop-shadow-md">{{ $totalStudents }}</p>
                                <p class="text-[10px] text-blue-100 uppercase font-bold tracking-widest mt-1">Total Siswa</p>
                            </div>
                            <div class="text-center p-5 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-md border border-white/20 rounded-2xl min-w-[110px] shadow-xl hover:scale-105 transition-transform">
                                <p class="text-3xl font-black drop-shadow-md">{{ $activeCourses }}</p>
                                <p class="text-[10px] text-blue-100 uppercase font-bold tracking-widest mt-1">Kelas Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-gradient-to-b from-blue-600 to-blue-400 rounded-full shadow-lg shadow-blue-500/30"></span>
                            Kursus yang Saya Ajar
                        </h3>
                        <a href="{{ route('courses.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white text-sm font-bold rounded-xl hover:from-blue-700 hover:to-blue-600 transition-all shadow-lg shadow-blue-500/40 hover:shadow-xl hover:shadow-blue-500/50 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Buat Kursus Baru
                        </a>
                    </div>

                    @if($taughtCourses->isEmpty())
                         <div class="bg-gradient-to-br from-blue-50 via-white to-blue-100 rounded-3xl p-12 text-center border-2 border-dashed border-blue-300 hover:border-blue-400 transition-all group shadow-lg">
                            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-blue-100 to-blue-200 text-blue-600 rounded-full mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-blue-500/20">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Belum ada kursus</h3>
                            <p class="text-gray-500 mt-2 mb-8 max-w-md mx-auto">Anda belum membuat kelas apapun. Mulai bagikan ilmu Anda sekarang.</p>
                            <a href="{{ route('courses.create') }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-600 transition-all shadow-lg shadow-blue-500/40 hover:shadow-xl hover:shadow-blue-500/50 transform hover:-translate-y-1">
                                + Buat Kursus Pertama
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($taughtCourses as $course)
                                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-blue-100 flex flex-col h-full group overflow-hidden relative">
                                    
                                    <div class="relative h-40 bg-gradient-to-br from-blue-100 to-blue-200 overflow-hidden">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($course->title) }}&background=random&size=400&font-size=0.33&bold=true&color=fff" 
                                             alt="{{ $course->title }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-90">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                                        
                                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/60 to-transparent"></div>

                                        <div class="absolute top-3 right-3">
                                            @if($course->is_active)
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-500/90 text-white text-[10px] font-bold uppercase tracking-wide backdrop-blur-sm shadow-sm border border-blue-400/50">
                                                    <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span> Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-800/80 text-white text-[10px] font-bold uppercase tracking-wide backdrop-blur-sm shadow-sm border border-blue-600/50">
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

                                    <div class="p-5 flex flex-col flex-grow bg-gradient-to-br from-white to-blue-50/30">
                                        <h4 class="text-lg font-bold text-gray-900 leading-snug mb-2 line-clamp-2 group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-blue-500 group-hover:bg-clip-text group-hover:text-transparent transition-colors min-h-[3.5rem]">
                                            {{ $course->title }}
                                        </h4>
                                        
                                        <div class="flex items-center justify-between text-xs text-gray-500 mb-6 pt-3 border-t border-blue-50">
                                            <div class="flex items-center gap-1.5" title="Jumlah Siswa">
                                                <div class="p-1.5 bg-gradient-to-br from-blue-50 to-blue-100 text-blue-600 rounded-md">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                                </div>
                                                <span class="font-semibold text-gray-700">{{ $course->students_count }} Siswa</span>
                                            </div>
                                            <div class="flex items-center gap-1.5" title="Jumlah Materi">
                                                <div class="p-1.5 bg-gradient-to-br from-blue-100 to-blue-200 text-blue-700 rounded-md">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                </div>
                                                <span class="font-semibold text-gray-700">{{ $course->contents_count ?? 0 }} Materi</span>
                                            </div>
                                        </div>

                                        <div class="mt-auto space-y-3">
                                            <div class="grid grid-cols-2 gap-3">
                                                <a href="{{ route('courses.contents.index', $course) }}" class="flex items-center justify-center px-3 py-2 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 rounded-lg text-xs font-bold hover:from-blue-100 hover:to-blue-200 transition border border-blue-200 group/btn">
                                                    <svg class="w-3.5 h-3.5 mr-1.5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    Materi
                                                </a>
                                                <a href="{{ route('courses.student.progress', $course) }}" class="flex items-center justify-center px-3 py-2 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 border border-blue-300 rounded-lg text-xs font-bold hover:from-blue-200 hover:to-blue-300 transition">
                                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                                    Siswa
                                                </a>
                                            </div>
                                            
                                            <a href="{{ route('courses.threads.index', $course) }}" class="flex items-center justify-center w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg text-xs font-bold hover:from-blue-700 hover:to-blue-600 transition shadow-lg shadow-blue-600/20">
                                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.723-.562M15 7a2 2 0 00-2-2H3a2 2 0 00-2 2v12l4-4h6a2 2 0 002-2V9a2 2 0 00-2-2z"></path></svg>
                                                Forum Diskusi
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
            
                {{-- 1. Hero Section: Welcome Banner dengan Nuansa Biru Gradasi --}}
                <div class="relative bg-gradient-to-r from-blue-700 to-cyan-600 rounded-3xl p-8 md:p-12 shadow-2xl overflow-hidden text-white mb-10">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-400 opacity-20 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>
                    <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-cyan-300 opacity-20 rounded-full blur-xl pointer-events-none animate-pulse"></div>

                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="space-y-2">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 border border-white/30 backdrop-blur-md w-fit">
                                <span class="w-2 h-2 rounded-full bg-cyan-300 animate-ping"></span>
                                <span class="text-xs font-bold uppercase tracking-wider">Administrator Panel</span>
                            </div>
                            <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Selamat Datang, Admin!</h1>
                            <p class="text-blue-100 text-lg max-w-lg leading-relaxed">
                                Kelola seluruh ekosistem pembelajaran, pantau statistik pengguna, dan atur konten kursus dari satu tempat.
                            </p>
                        </div>
                        
                        <div class="flex gap-4">
                            <div class="text-center p-4 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl min-w-[110px] shadow-lg">
                                <p class="text-4xl font-black">{{ $stats['total_users'] }}</p>
                                <p class="text-[10px] text-blue-100 uppercase font-bold tracking-widest mt-1">Total User</p>
                            </div>
                            <div class="text-center p-4 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl min-w-[110px] shadow-lg">
                                <p class="text-4xl font-black">{{ $stats['total_courses'] }}</p>
                                <p class="text-[10px] text-blue-100 uppercase font-bold tracking-widest mt-1">Kursus</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. AREA GRAFIK STATISTIK --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 lg:col-span-2">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="font-bold text-lg text-gray-800">Tren Pendaftaran Siswa</h3>
                                <p class="text-sm text-gray-500">Data pendaftaran siswa baru dalam 6 bulan terakhir.</p>
                            </div>
                            <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                            </div>
                        </div>
                        <div class="relative h-72 w-full">
                            <canvas id="studentChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 text-white shadow-lg flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl -mr-10 -mt-10"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-indigo-400 opacity-20 rounded-full blur-xl"></div>

                        <div class="relative z-10">
                            <h4 class="text-lg font-bold mb-1">Performa Platform</h4>
                            <p class="text-blue-100 text-sm mb-6">Ringkasan aktivitas bulan ini.</p>

                            <div class="space-y-6">
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-blue-100">Total Siswa</span>
                                        <span class="font-bold">{{ $stats['total_students'] }}</span>
                                    </div>
                                    <div class="w-full bg-blue-900/30 rounded-full h-2">
                                        <div class="bg-blue-300 h-2 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-blue-100">Total Materi</span>
                                        <span class="font-bold">{{ $stats['total_contents'] }}</span>
                                    </div>
                                    <div class="w-full bg-blue-900/30 rounded-full h-2">
                                        <div class="bg-green-400 h-2 rounded-full" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 relative z-10">
                            <a href="{{ route('users.index') }}" class="block w-full py-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl text-center text-sm font-bold hover:bg-white/20 transition">
                                Kelola Data User
                            </a>
                        </div>
                    </div>
                </div>

                {{-- SCRIPT GRAFIK (CHART.JS) --}}
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const ctx = document.getElementById('studentChart').getContext('2d');
                        
                        const labels = @json($chartLabels);
                        const data = @json($chartValues);

                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Siswa Baru',
                                    data: data,
                                    borderColor: '#2563eb', 
                                    backgroundColor: 'rgba(37, 99, 235, 0.1)', 
                                    borderWidth: 3,
                                    pointBackgroundColor: '#ffffff',
                                    pointBorderColor: '#2563eb',
                                    pointBorderWidth: 3,
                                    pointRadius: 6,
                                    pointHoverRadius: 8,
                                    fill: true, 
                                    tension: 0.4 
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false 
                                    },
                                    tooltip: {
                                        backgroundColor: '#1e293b',
                                        padding: 12,
                                        titleFont: { size: 14 },
                                        bodyFont: { size: 14 },
                                        cornerRadius: 8,
                                        displayColors: false
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            borderDash: [5, 5], 
                                            color: '#f1f5f9'
                                        },
                                        ticks: {
                                            stepSize: 1
                                        }
                                    },
                                    x: {
                                        grid: {
                                            display: false 
                                        }
                                    }
                                }
                            }
                        });
                    });
                </script>

                {{-- 3. Statistik Utama (Grid 4 Kolom) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    {{-- Card Siswa --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-4">
                                <div class="p-3 bg-gradient-to-br from-blue-100 to-blue-200 text-blue-600 rounded-xl group-hover:from-blue-600 group-hover:to-blue-500 group-hover:text-white transition-colors shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">Siswa</span>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">Total Siswa</p>
                            <h3 class="text-3xl font-bold text-gray-800">{{ $stats['total_students'] }}</h3>
                        </div>
                    </div>

                    {{-- Card Pengajar --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-cyan-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-4">
                                <div class="p-3 bg-gradient-to-br from-cyan-100 to-cyan-200 text-cyan-700 rounded-xl group-hover:from-cyan-600 group-hover:to-cyan-500 group-hover:text-white transition-colors shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-cyan-700 bg-cyan-50 px-2 py-1 rounded-lg">Pengajar</span>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">Guru / Partner</p>
                            <h3 class="text-3xl font-bold text-gray-800">{{ $stats['total_teachers'] }}</h3>
                        </div>
                    </div>

                    {{-- Card Kategori --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-indigo-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-4">
                                <div class="p-3 bg-gradient-to-br from-indigo-100 to-indigo-200 text-indigo-600 rounded-xl group-hover:from-indigo-600 group-hover:to-indigo-500 group-hover:text-white transition-colors shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-lg">Topik</span>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">Kategori Kursus</p>
                            <h3 class="text-3xl font-bold text-gray-800">{{ $stats['total_categories'] }}</h3>
                        </div>
                    </div>

                    {{-- Card Materi --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-sky-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-4">
                                <div class="p-3 bg-gradient-to-br from-sky-100 to-sky-200 text-sky-600 rounded-xl group-hover:from-sky-600 group-hover:to-sky-500 group-hover:text-white transition-colors shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-sky-600 bg-sky-50 px-2 py-1 rounded-lg">Konten</span>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">Total Materi (Bab)</p>
                            <h3 class="text-3xl font-bold text-gray-800">{{ $stats['total_contents'] }}</h3>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    {{-- 4. Kolom Kiri: Aksi Cepat (Quick Actions) --}}
                    <div class="lg:col-span-2 space-y-8">
                        
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 relative overflow-hidden">
                             <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-b from-blue-50 to-transparent rounded-full blur-2xl -mr-8 -mt-8 pointer-events-none"></div>
                             
                            <div class="flex items-center justify-between mb-6 relative z-10">
                                <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                    <div class="w-1.5 h-6 bg-gradient-to-b from-blue-600 to-cyan-500 rounded-full"></div>
                                    Menu Pintas
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 relative z-10">
                                {{-- Tambah User --}}
                                <a href="{{ route('users.create') }}" class="group p-5 rounded-2xl border border-gray-100 bg-gray-50 hover:bg-white hover:border-blue-300 hover:shadow-lg transition-all duration-300 text-center flex flex-col items-center justify-center gap-3">
                                    <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform group-hover:bg-blue-600 group-hover:text-white text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    <div>
                                        <span class="block text-sm font-bold text-gray-900 group-hover:text-blue-700">Tambah User</span>
                                        <span class="text-xs text-gray-500">Guru/Siswa Baru</span>
                                    </div>
                                </a>

                                {{-- Tambah Kursus --}}
                                <a href="{{ route('courses.create') }}" class="group p-5 rounded-2xl border border-gray-100 bg-gray-50 hover:bg-white hover:border-cyan-300 hover:shadow-lg transition-all duration-300 text-center flex flex-col items-center justify-center gap-3">
                                    <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform group-hover:bg-cyan-600 group-hover:text-white text-cyan-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    </div>
                                    <div>
                                        <span class="block text-sm font-bold text-gray-900 group-hover:text-cyan-700">Buat Kursus</span>
                                        <span class="text-xs text-gray-500">Materi Pembelajaran</span>
                                    </div>
                                </a>

                                {{-- Tambah Kategori --}}
                                <a href="{{ route('categories.create') }}" class="group p-5 rounded-2xl border border-gray-100 bg-gray-50 hover:bg-white hover:border-indigo-300 hover:shadow-lg transition-all duration-300 text-center flex flex-col items-center justify-center gap-3">
                                    <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform group-hover:bg-indigo-600 group-hover:text-white text-indigo-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                    </div>
                                    <div>
                                        <span class="block text-sm font-bold text-gray-900 group-hover:text-indigo-700">Kategori Baru</span>
                                        <span class="text-xs text-gray-500">Klasifikasi Topik</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        {{-- Akses Manajemen Cepat --}}
                         <div class="bg-gradient-to-r from-blue-50 to-white rounded-2xl p-6 border border-blue-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div>
                                <h4 class="font-bold text-blue-900">Manajemen Data</h4>
                                <p class="text-sm text-blue-700/70">Kelola seluruh data sistem dengan mudah.</p>
                            </div>
                            <div class="flex gap-3">
                                <a href="{{ route('users.index') }}" class="px-5 py-2.5 bg-white text-blue-700 font-bold text-sm rounded-xl shadow-sm border border-blue-100 hover:bg-blue-600 hover:text-white transition-all">
                                    Semua User &rarr;
                                </a>
                                <a href="{{ route('courses.index') }}" class="px-5 py-2.5 bg-blue-600 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all">
                                    Semua Kursus &rarr;
                                </a>
                            </div>
                        </div>

                    </div>

                    {{-- 5. Kolom Kanan: Pengguna Terbaru (List Vertikal) --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden h-full">
                            <div class="p-6 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                                <h3 class="font-bold text-gray-900">User Terbaru</h3>
                                <a href="{{ route('users.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline">Lihat Semua</a>
                            </div>
                            <div class="divide-y divide-gray-50">
                                @foreach($recentUsers as $user)
                                    <div class="p-4 hover:bg-blue-50/40 transition-colors flex items-center gap-3 group">
                                        <div class="h-10 w-10 rounded-full flex-shrink-0 flex items-center justify-center font-bold text-white text-xs shadow-sm
                                            {{ $user->role == 'admin' ? 'bg-gradient-to-br from-red-500 to-red-600' : ($user->role == 'teacher' ? 'bg-gradient-to-br from-cyan-500 to-cyan-600' : 'bg-gradient-to-br from-blue-500 to-blue-600') }}">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-gray-900 truncate group-hover:text-blue-700 transition-colors">{{ $user->name }}</p>
                                            <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                                        </div>
                                        <span class="text-[10px] px-2 py-1 rounded-md font-bold uppercase tracking-wide
                                            {{ $user->role == 'admin' ? 'bg-red-100 text-red-600' : ($user->role == 'teacher' ? 'bg-cyan-100 text-cyan-600' : 'bg-blue-100 text-blue-600') }}">
                                            {{ $user->role }}
                                        </span>
                                    </div>
                                @endforeach
                                @if($recentUsers->isEmpty())
                                    <div class="p-8 text-center text-gray-400 text-sm">
                                        Belum ada pengguna baru.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>