<x-app-layout>
    <x-slot name="header"></x-slot> {{-- Kosongkan header default --}}

    <div class="flex h-[calc(100vh-65px)] bg-gray-50">
        
        {{-- ========================================== --}}
        {{-- SIDEBAR MATERI (SAMA PERSIS DENGAN LESSON) --}}
        {{-- ========================================== --}}
        <aside class="w-full md:w-80 bg-white border-r border-gray-200 flex flex-col h-full shrink-0 z-20 hidden md:flex">
            
            <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-xs font-bold text-gray-500 hover:text-blue-600 transition mb-3 group">
                    <svg class="w-3 h-3 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Dashboard
                </a>
                <h2 class="font-bold text-gray-800 leading-tight line-clamp-2" title="{{ $course->title }}">
                    {{ $course->title }}
                </h2>
                
                {{-- Progress Bar --}}
                @php
                    $total = $courseContents->count();
                    $done = count($completedContentIds);
                    $percent = $total > 0 ? ($done / $total) * 100 : 0;
                @endphp
                <div class="mt-3 flex items-center justify-between text-xs text-gray-500 mb-1">
                    <span>Progres Belajar</span>
                    <span class="font-bold text-blue-600">{{ round($percent) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-1">
                @foreach($courseContents as $item)
                    @php
                        $isCompleted = in_array($item->id, $completedContentIds);
                    @endphp

                    <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $item]) }}" 
                       class="flex items-start p-3 rounded-xl transition-all duration-200 group hover:bg-gray-50 border border-transparent">
                        
                        <div class="flex-shrink-0 mt-0.5 mr-3">
                            @if($isCompleted)
                                <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center border border-green-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            @else
                                <div class="w-6 h-6 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center text-xs font-bold border border-gray-200">
                                    {{ $loop->iteration }}
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-600 group-hover:text-blue-600 transition-colors">
                                {{ $item->title }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Footer Sidebar: Tombol Forum (Aktif) --}}
            <div class="p-4 border-t border-gray-100 bg-white">
                <div class="flex items-center justify-center w-full py-2.5 px-4 bg-blue-50 border border-blue-200 rounded-xl text-sm font-bold text-blue-700 cursor-default">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.723-.562M15 7a2 2 0 00-2-2H3a2 2 0 00-2 2v12l4-4h6a2 2 0 002-2V9a2 2 0 00-2-2z"></path></svg>
                    Forum Diskusi
                </div>
            </div>
        </aside>

        {{-- ========================== --}}
        {{-- AREA KONTEN FORUM (KANAN) --}}
        {{-- ========================== --}}
        <main class="flex-1 overflow-y-auto bg-gray-50 relative scroll-smooth">
            <div class="max-w-5xl mx-auto px-6 py-10">
                
                {{-- Mobile Back to Dashboard (Hanya muncul di mobile) --}}
                <div class="md:hidden mb-6">
                    <a href="{{ route('dashboard') }}" class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                </div>

                {{-- Header Forum --}}
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-2xl font-extrabold text-gray-900">Forum Diskusi</h1>
                        <p class="text-gray-500 text-sm mt-1">Tanyakan sesuatu atau bantu teman sekelasmu.</p>
                    </div>
                    <a href="{{ route('courses.threads.create', $course) }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Topik Baru
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm flex items-center animate-fade-in-down">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Daftar Thread (Card Style) --}}
                <div class="space-y-4">
                    @forelse ($threads as $thread)
                        <div class="bg-white p-6 rounded-2xl border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all duration-200 group relative flex justify-between gap-4">
                            
                            {{-- Link Pembungkus Utama --}}
                            <a href="{{ route('courses.threads.show', ['course' => $course, 'thread' => $thread]) }}" class="absolute inset-0 z-0"></a>

                            <div class="relative z-10 flex items-start gap-4 flex-grow">
                                {{-- Avatar Penulis --}}
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                        {{ substr($thread->user->name, 0, 2) }}
                                    </div>
                                </div>

                                <div class="flex-grow min-w-0">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-1 pr-8">
                                        {{ $thread->title }}
                                    </h3>
                                    <div class="flex items-center text-xs text-gray-500 mt-1">
                                        <span class="font-medium text-gray-700 mr-1">{{ $thread->user->name }}</span>
                                        <span>• {{ $thread->created_at->diffForHumans() }}</span>
                                        @if($thread->user->role == 'teacher' || $thread->user->role == 'admin')
                                            <span class="ml-2 px-1.5 py-0.5 bg-indigo-100 text-indigo-700 rounded text-[10px] font-bold uppercase tracking-wide">Instruktur</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                        {{ Str::limit(strip_tags($thread->body), 150) }}
                                    </p>
                                </div>
                            </div>

                            {{-- Kolom Kanan: Komentar & Hapus --}}
                            <div class="relative z-20 flex flex-col items-end justify-between gap-2 min-w-[60px]">
                                
                                {{-- Badge Komentar --}}
                                <div class="flex items-center gap-1.5 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100 group-hover:bg-blue-50 group-hover:border-blue-100 transition-colors" title="{{ $thread->posts_count }} Balasan">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                    <span class="text-xs font-bold text-gray-600 group-hover:text-blue-700">{{ $thread->posts_count }}</span>
                                </div>

                                {{-- Tombol Hapus (Di Bawah Komentar) --}}
                                @if(auth()->id() === $thread->user_id || auth()->user()->role === 'admin')
                                    <form action="{{ route('courses.threads.destroy', ['course' => $course, 'thread' => $thread]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus diskusi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus Diskusi">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    @empty
                        {{-- Empty State tetap sama --}}
                        <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 mb-4">
                                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.723-.562M15 7a2 2 0 00-2-2H3a2 2 0 00-2 2v12l4-4h6a2 2 0 002-2V9a2 2 0 00-2-2z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Belum ada diskusi</h3>
                            <p class="text-gray-500 mt-1 mb-6">Jadilah yang pertama memulai percakapan di kelas ini.</p>
                            <a href="{{ route('courses.threads.create', $course) }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition">
                                Mulai Diskusi
                            </a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $threads->links() }}
                </div>

            </div>
        </main>
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