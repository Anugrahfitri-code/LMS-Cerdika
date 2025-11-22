<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Detail Kursus') }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Informasi lengkap mengenai kurikulum dan jadwal.</p>
            </div>
            
            <div class="mt-4 md:mt-0">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                                <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <a href="{{ route('courses.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Kursus</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 mb-8">
                <div class="relative h-64 bg-gradient-to-r from-blue-600 to-blue-500 overflow-hidden">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500 opacity-20 rounded-full blur-2xl -ml-10 -mb-10"></div>
                    
                    <div class="absolute top-6 left-6 z-20">
                         <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 bg-black/20 backdrop-blur-md border border-white/10 rounded-xl text-white text-sm font-bold hover:bg-black/30 transition shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali ke Daftar
                        </a>
                    </div>

                    <div class="absolute bottom-0 left-0 w-full p-8 bg-gradient-to-t from-black/60 to-transparent">
                        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="px-3 py-1 rounded-lg bg-white/20 backdrop-blur-md border border-white/30 text-white text-xs font-bold uppercase tracking-wider">
                                        {{ $course->category->name }}
                                    </span>
                                    @if($course->is_active)
                                        <span class="flex items-center px-2.5 py-0.5 rounded-full bg-green-500/80 text-white text-xs font-bold backdrop-blur-sm">
                                            <span class="w-2 h-2 bg-green-300 rounded-full mr-1.5 animate-pulse"></span> Aktif
                                        </span>
                                    @else
                                        <span class="flex items-center px-2.5 py-0.5 rounded-full bg-red-500/80 text-white text-xs font-bold backdrop-blur-sm">
                                            Non-Aktif
                                        </span>
                                    @endif
                                </div>
                                <h1 class="text-3xl md:text-4xl font-extrabold text-white leading-tight shadow-sm">{{ $course->title }}</h1>
                            </div>
                            
                            @can('update', $course)
                                <div class="flex gap-3">
                                    <a href="{{ route('courses.contents.index', $course) }}" class="inline-flex items-center px-5 py-2.5 bg-white text-blue-700 rounded-xl font-bold text-sm hover:bg-blue-50 shadow-lg transition-all">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        Kelola Materi
                                    </a>
                                    <a href="{{ route('courses.edit', $course) }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 border border-blue-400/50 text-white rounded-xl font-bold text-sm hover:bg-blue-700 shadow-lg transition-all backdrop-blur-md">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit Info
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                            </span>
                            Deskripsi Kursus
                        </h3>
                        <div class="prose prose-blue max-w-none text-gray-600 leading-relaxed">
                            {!! nl2br(e($course->description)) !!}
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Instruktur</h4>
                        <div class="flex items-center">
                            <div class="h-14 w-14 rounded-full bg-gradient-to-tr from-blue-500 to-blue-600 flex items-center justify-center text-white text-xl font-bold shadow-md">
                                {{ substr($course->teacher->name, 0, 2) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-lg font-bold text-gray-900">{{ $course->teacher->name }}</div>
                                <div class="text-sm text-gray-500">{{ $course->teacher->email }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Jadwal & Waktu</h4>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-green-50 text-green-600 flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Mulai Kelas</p>
                                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($course->start_date)->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Selesai Kelas</p>
                                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($course->end_date)->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 text-center">
                        <p class="text-xs text-gray-500">
                            Dibuat: {{ $course->created_at->format('d M Y') }} <br>
                            Update Terakhir: {{ $course->updated_at->diffForHumans() }}
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>