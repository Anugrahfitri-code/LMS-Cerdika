<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(auth()->user()->role === 'student')

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-2xl font-semibold mb-6">Kursus Saya</h3>

                        @if($enrolledCourses->isEmpty())
                            <p class="text-center text-gray-500">
                                Anda belum mendaftar di kursus manapun.
                                <br>
                                <a href="{{ route('course.catalog') }}" class="text-blue-600 hover:underline">Lihat Katalog Kursus</a>
                            </p>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($enrolledCourses as $course)
                                    <div class="border rounded-lg overflow-hidden shadow-lg flex flex-col">
                                        <div class="p-4 flex-grow">
                                            <h4 class="text-lg font-bold">{{ $course->title }}</h4>
                                            <p class="text-sm text-gray-600 mt-1">oleh {{ $course->teacher->name }}</p>

                                            <div class="mt-4">
                                                <div class="flex justify-between mb-1">
                                                    <span class="text-sm font-medium text-gray-700">Progres</span>
                                                    <span class="text-sm font-medium text-gray-700">{{ (int)$course->progress_percentage }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $course->progress_percentage }}%"></div>
                                                </div>
                                            </div>
                                            </div>
                                        <div class="p-4 bg-gray-50">
                                            @if($course->firstContent)
                                                <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $course->firstContent]) }}" class="font-semibold text-blue-600 hover:text-blue-500">
                                                    Mulai Belajar &rarr;
                                                </a>
                                            @else
                                                <span class="text-sm text-gray-500">Materi belum tersedia</span>
                                            @endif

                                            @if($course->progress_percentage == 100)
                                                <a href="{{ route('courses.certificate', $course) }}" class="inline-block mt-4 px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">
                                                    Unduh Sertifikat
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            @elseif(auth()->user()->role === 'teacher')

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-2xl font-semibold mb-6">Kursus yang Saya Ajar</h3>

                        @if($taughtCourses->isEmpty())
                            <p class="text-center text-gray-500">
                                Anda belum membuat kursus apapun.
                                <br>
                                <a href="{{ route('courses.create') }}" class="text-blue-600 hover:underline">Buat Kursus Baru</a>
                            </p>
                        @else
                            <div class="space-y-4">
                                @foreach($taughtCourses as $course)
                                    <div class="border rounded-lg p-4 flex items-center justify-between">
                                        <div>
                                            <h4 class="text-lg font-bold">{{ $course->title }}</h4>
                                            <span class="text-sm text-gray-600">{{ $course->students_count }} Siswa Terdaftar</span>
                                        </div>
                                        <div>
                                            <a href="{{ route('courses.contents.index', $course) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 mr-4">
                                                Kelola Materi
                                            </a>

                                            <a href="{{ route('courses.threads.index', $course) }}" class="text-sm font-semibold text-green-600 hover:text-green-500 mr-4">
                                                Forum Diskusi
                                            </a>
                                            <a href="{{ route('courses.student.progress', $course) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-500">
                                                Lihat Progres Siswa
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            @else

                <div class="space-y-8">
                    
                    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 to-indigo-700 p-8 shadow-lg text-white">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                        
                        <div class="relative z-10 flex items-center justify-between">
                            <div>
                                <h3 class="text-3xl font-extrabold tracking-tight">Dashboard Administrator</h3>
                                <p class="mt-2 text-blue-100 text-lg">Selamat datang kembali, {{ Auth::user()->name }}! Berikut adalah ringkasan aktivitas platform hari ini.</p>
                            </div>
                            <div class="hidden md:block bg-white/20 p-3 rounded-2xl backdrop-blur-sm">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 flex items-center">
                            <div class="p-3 rounded-xl bg-blue-50 text-blue-600 mr-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                                <h4 class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</h4>
                                <p class="text-xs text-gray-400 mt-1">
                                    <span class="text-blue-600 font-semibold">{{ $stats['total_students'] }}</span> Siswa • 
                                    <span class="text-indigo-600 font-semibold">{{ $stats['total_teachers'] }}</span> Guru
                                </p>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 flex items-center">
                            <div class="p-3 rounded-xl bg-indigo-50 text-indigo-600 mr-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Kursus</p>
                                <h4 class="text-2xl font-bold text-gray-900">{{ $stats['total_courses'] }}</h4>
                                <p class="text-xs text-gray-400 mt-1">{{ $stats['total_contents'] }} Materi Pembelajaran</p>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 flex items-center">
                            <div class="p-3 rounded-xl bg-pink-50 text-pink-600 mr-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Kategori Aktif</p>
                                <h4 class="text-2xl font-bold text-gray-900">{{ $stats['total_categories'] }}</h4>
                                <p class="text-xs text-gray-400 mt-1">Topik pembelajaran</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:col-span-2">
                            <h4 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                
                                <a href="{{ route('users.create') }}" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-blue-50 hover:border-blue-200 transition group">
                                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-2 group-hover:bg-blue-600 group-hover:text-white transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Tambah User</span>
                                </a>

                                <a href="{{ route('courses.create') }}" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-indigo-50 hover:border-indigo-200 transition group">
                                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-2 group-hover:bg-indigo-600 group-hover:text-white transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-indigo-700">Tambah Kursus</span>
                                </a>

                                <a href="{{ route('categories.create') }}" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-pink-50 hover:border-pink-200 transition group">
                                    <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center mb-2 group-hover:bg-pink-600 group-hover:text-white transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-pink-700">Tambah Kategori</span>
                                </a>

                                <a href="{{ route('users.index') }}" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-gray-100 transition group">
                                    <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mb-2 group-hover:bg-gray-600 group-hover:text-white transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">Lihat Semua User</span>
                                </a>

                                <a href="{{ route('courses.index') }}" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-gray-100 transition group">
                                    <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mb-2 group-hover:bg-gray-600 group-hover:text-white transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">Kelola Kursus</span>
                                </a>

                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-4">Pengguna Terbaru</h4>
                            <div class="space-y-4">
                                @foreach($recentUsers as $user)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm mr-3">
                                                {{ substr($user->name, 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ Str::limit($user->name, 15) }}</p>
                                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : ($user->role == 'teacher' ? 'bg-indigo-100 text-indigo-700' : 'bg-green-100 text-green-700') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </div>
                                @endforeach
                                <a href="{{ route('users.index') }}" class="block text-center text-sm text-blue-600 font-semibold hover:text-blue-800 mt-4">
                                    Lihat Semua &rarr;
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            @endif
        </div>
    </div>
</x-app-layout>