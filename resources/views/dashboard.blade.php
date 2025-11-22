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
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl shadow-lg border border-blue-200 flex items-center hover:shadow-xl transition-all hover:-translate-y-1 group">
                        <div class="p-3 bg-gradient-to-br from-blue-200 to-blue-300 text-blue-700 rounded-xl mr-4 group-hover:scale-110 transition-transform shadow-md">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-blue-600 text-sm font-medium">Total Pengguna</p>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-700 to-blue-600 bg-clip-text text-transparent">{{ $stats['total_users'] }}</h3>
                        </div>
                    </div>
                     <div class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 rounded-2xl shadow-lg border border-blue-300 flex items-center hover:shadow-xl transition-all hover:-translate-y-1 group">
                        <div class="p-3 bg-gradient-to-br from-blue-300 to-blue-400 text-blue-800 rounded-xl mr-4 group-hover:scale-110 transition-transform shadow-md">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <div>
                            <p class="text-blue-700 text-sm font-medium">Total Kursus</p>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-800 to-blue-700 bg-clip-text text-transparent">{{ $stats['total_courses'] }}</h3>
                        </div>
                    </div>
                     <div class="bg-gradient-to-br from-blue-200 to-blue-300 p-6 rounded-2xl shadow-lg border border-blue-400 flex items-center hover:shadow-xl transition-all hover:-translate-y-1 group">
                        <div class="p-3 bg-gradient-to-br from-blue-400 to-blue-500 text-blue-900 rounded-xl mr-4 group-hover:scale-110 transition-transform shadow-md">
                           <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <div>
                            <p class="text-blue-800 text-sm font-medium">Kategori</p>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-900 to-blue-800 bg-clip-text text-transparent">{{ $stats['total_categories'] }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-50 via-white to-blue-100 rounded-2xl shadow-lg border border-blue-200 p-8 mt-6 hover:shadow-xl transition-all">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-lg text-gray-900 flex items-center gap-2">
                            <div class="w-1 h-6 bg-gradient-to-b from-blue-600 to-blue-400 rounded-full"></div>
                            Pengguna Terbaru
                        </h3>
                        <a href="{{ route('users.index') }}" class="text-sm text-blue-600 font-semibold hover:text-blue-800 transition-colors bg-gradient-to-r from-blue-50 to-blue-100 px-3 py-1.5 rounded-lg hover:from-blue-100 hover:to-blue-200">Lihat Semua →</a>
                    </div>
                    <div class="space-y-4">
                        @foreach($recentUsers as $user)
                            <div class="flex items-center justify-between border-b border-blue-100/50 pb-3 last:border-0 hover:bg-blue-50/50 p-2 rounded-lg transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full flex items-center justify-center font-bold text-white text-sm shadow-lg
                                        {{ $user->role == 'admin' ? 'bg-gradient-to-br from-blue-700 to-blue-800' : ($user->role == 'teacher' ? 'bg-gradient-to-br from-blue-600 to-blue-500' : 'bg-gradient-to-br from-blue-500 to-blue-400') }}">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-gray-900">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <span class="text-xs px-2.5 py-1 rounded-full font-bold border shadow-sm
                                    {{ $user->role == 'admin' ? 'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border-blue-300' : ($user->role == 'teacher' ? 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 border-blue-200' : 'bg-gradient-to-r from-blue-50 to-blue-100 text-blue-600 border-blue-200') }}">
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