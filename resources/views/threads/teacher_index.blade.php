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
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6 rounded-2xl shadow-lg text-white flex items-center">
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
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-lg text-gray-800">Daftar Pertanyaan Siswa</h3>
                    
                    <a href="{{ route('courses.threads.create', $course) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition shadow-lg shadow-blue-500/30">
                        + Buat Pengumuman
                    </a>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-4">
                        @forelse ($threads as $thread)
                            <div class="group flex flex-col sm:flex-row sm:items-start justify-between p-5 rounded-xl border border-gray-200 hover:border-blue-400 hover:shadow-md transition-all duration-200 bg-white">
                                
                                <div class="flex items-start gap-4 flex-1">
                                    <div class="flex-shrink-0">
                                         <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-600 font-bold text-lg border border-gray-300 group-hover:border-blue-200 transition-colors">
                                            {{ substr($thread->user->name, 0, 2) }}
                                        </div>
                                    </div>
                                    <div>
                                        <a href="{{ route('courses.threads.show', ['course' => $course, 'thread' => $thread]) }}" class="text-lg font-bold text-gray-900 hover:text-blue-600 transition-colors line-clamp-1">
                                            {{ $thread->title }}
                                        </a>
                                        <p class="text-sm text-gray-600 mt-1 line-clamp-2 max-w-2xl">
                                            {{ Str::limit(strip_tags($thread->body), 200) }}
                                        </p>
                                        <div class="flex items-center gap-3 mt-3 text-xs text-gray-500">
                                            <span class="flex items-center gap-1 font-medium text-gray-700">
                                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                {{ $thread->user->name }}
                                            </span>
                                            <span>•</span>
                                            <span>{{ $thread->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 sm:mt-0 flex flex-row sm:flex-col items-center sm:items-end gap-3 sm:gap-2 w-full sm:w-auto pl-0 sm:pl-4 border-t sm:border-t-0 border-gray-100 pt-3 sm:pt-0">
                                    
                                    <div class="flex items-center gap-1.5 {{ $thread->posts_count > 0 ? 'bg-green-50 text-green-700 border-green-200' : 'bg-gray-50 text-gray-600 border-gray-200' }} px-3 py-1 rounded-full border transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                        <span class="font-bold text-sm">{{ $thread->posts_count }}</span>
                                        <span class="text-xs">Balasan</span>
                                    </div>

                                    <div class="flex gap-2 ml-auto sm:ml-0 mt-1">
                                        <a href="{{ route('courses.threads.show', ['course' => $course, 'thread' => $thread]) }}" class="inline-flex items-center text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">
                                            Lihat & Balas &rarr;
                                        </a>
                                        
                                        <form action="{{ route('courses.threads.destroy', ['course' => $course, 'thread' => $thread]) }}" method="POST" onsubmit="return confirm('Hapus diskusi ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500">
                                <div class="mb-4 inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                </div>
                                <p class="text-lg font-medium">Belum ada diskusi dari siswa.</p>
                                <p class="text-sm">Mulai percakapan dengan membuat pengumuman atau topik baru.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $threads->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>