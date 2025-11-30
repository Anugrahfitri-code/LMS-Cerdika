<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Manajemen Diskusi') }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Pantau dan jawab pertanyaan siswa di kursus: <strong>{{ $course->title }}</strong></p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                    &larr; Kembali ke Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-blue-600 transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center mr-3 shadow-sm group-hover:border-blue-200 group-hover:shadow-md transition-all">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </div>
                    Kembali ke Dashboard
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6 rounded-2xl shadow-lg text-white flex items-center relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-white opacity-10 rounded-full -mr-6 -mt-6"></div>
                    <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.723-.562M15 7a2 2 0 00-2-2H3a2 2 0 00-2 2v12l4-4h6a2 2 0 002-2V9a2 2 0 00-2-2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Topik Diskusi</p>
                        <h3 class="text-3xl font-bold">{{ $threads->total() }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center bg-gray-50/50 gap-4">
                    <h3 class="font-bold text-lg text-gray-800 flex items-center gap-2">
                        <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                        Daftar Pertanyaan Siswa
                    </h3>
                    
                    <a href="{{ route('courses.threads.create', $course) }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg shadow-blue-600/30 transition transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Topik Baru
                    </a>
                </div>

                <div class="p-6 bg-gray-50/30">
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl flex items-center shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-4">
                        @forelse ($threads as $thread)
                            <div class="group flex flex-col sm:flex-row sm:items-start justify-between p-6 rounded-2xl border border-gray-200 hover:border-blue-400 hover:shadow-md transition-all duration-300 bg-white relative overflow-hidden">
                                
                                {{-- Garis Indikator di Kiri (Biru jika ada balasan, Abu jika belum) --}}
                                <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $thread->posts_count > 0 ? 'bg-blue-500' : 'bg-gray-300' }}"></div>

                                <div class="flex items-start gap-5 flex-1 pl-4">
                                    <div class="flex-shrink-0">
                                         <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-600 font-bold text-lg border-2 border-white shadow-sm group-hover:scale-105 transition-transform">
                                            {{ substr($thread->user->name, 0, 2) }}
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-bold text-sm text-gray-900">{{ $thread->user->name }}</span>
                                            <span class="text-xs text-gray-400">•</span>
                                            <span class="text-xs text-gray-500">{{ $thread->created_at->diffForHumans() }}</span>
                                            @if($thread->user->role == 'teacher' || $thread->user->role == 'admin')
                                                <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-md text-[10px] font-bold uppercase tracking-wider border border-blue-200">Instruktur</span>
                                            @endif
                                        </div>

                                        <a href="{{ route('courses.threads.show', ['course' => $course, 'thread' => $thread]) }}" class="text-lg font-bold text-gray-900 hover:text-blue-600 transition-colors block mb-2 line-clamp-1">
                                            {{ $thread->title }}
                                        </a>
                                        <p class="text-sm text-gray-600 line-clamp-2 leading-relaxed">
                                            {{ Str::limit(strip_tags($thread->body), 180) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 sm:mt-0 flex flex-row sm:flex-col items-center sm:items-end gap-4 sm:gap-2 w-full sm:w-auto pl-4 sm:pl-0 border-t sm:border-t-0 border-gray-100 pt-4 sm:pt-0">
                                    
                                    {{-- Badge Jumlah Balasan --}}
                                    <div class="flex items-center gap-2 {{ $thread->posts_count > 0 ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-gray-50 text-gray-500 border-gray-200' }} px-3 py-1.5 rounded-lg border transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                        <span class="font-bold text-sm">{{ $thread->posts_count }}</span>
                                        <span class="text-xs font-medium">Balasan</span>
                                    </div>

                                    <div class="flex items-center gap-2 ml-auto sm:ml-0">
                                        <a href="{{ route('courses.threads.show', ['course' => $course, 'thread' => $thread]) }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 hover:underline transition-all">
                                            Lihat Detail
                                        </a>
                                        
                                        @if(auth()->id() === $thread->user_id || auth()->user()->role === 'admin' || auth()->user()->role === 'teacher')
                                            <form action="{{ route('courses.threads.destroy', ['course' => $course, 'thread' => $thread]) }}" method="POST" onsubmit="return confirm('Hapus diskusi ini?');" class="inline-flex">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        @empty
                            <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                                <div class="mb-4 inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-50 text-blue-400">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Belum ada diskusi</h3>
                                <p class="text-gray-500 mt-1 mb-6">Belum ada siswa yang bertanya. Anda bisa memulai dengan membuat topik pengumuman.</p>
                                <a href="{{ route('courses.threads.create', $course) }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition">
                                    Mulai Diskusi Baru
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $threads->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>