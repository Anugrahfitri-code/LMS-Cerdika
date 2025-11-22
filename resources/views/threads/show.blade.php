<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="flex h-[calc(100vh-65px)] bg-gray-50">
        
        {{-- ========================================== --}}
        {{-- SIDEBAR MATERI (KIRI) --}}
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
                    @php $isCompleted = in_array($item->id, $completedContentIds); @endphp
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
                            <p class="text-sm font-medium text-gray-600 group-hover:text-blue-600 transition-colors">{{ $item->title }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </aside>

        {{-- ========================================== --}}
        {{-- AREA DISKUSI UTAMA (KANAN) --}}
        {{-- ========================================== --}}
        <main class="flex-1 overflow-y-auto bg-white relative scroll-smooth flex flex-col">
            
            {{-- 1. Header Sticky --}}
            <div class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-gray-100 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('courses.threads.index', $course) }}" class="p-2 rounded-full hover:bg-gray-100 text-gray-500 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900 line-clamp-1">{{ $thread->title }}</h1>
                        <div class="flex items-center text-xs text-gray-500 gap-2">
                            <span>Oleh <span class="font-semibold text-blue-600">{{ $thread->user->name }}</span></span>
                            <span>&bull;</span>
                            <span>{{ $thread->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                @if(auth()->id() === $thread->user_id || auth()->user()->role === 'admin')
                    <form action="{{ route('courses.threads.destroy', ['course' => $course, 'thread' => $thread]) }}" method="POST" onsubmit="return confirm('Hapus diskusi ini selamanya?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                            Hapus Topik
                        </button>
                    </form>
                @endif
            </div>

            {{-- 2. Konten Diskusi --}}
            <div class="flex-1 p-6 space-y-8 overflow-y-auto">
                
                {{-- Pertanyaan Utama (Bubble) --}}
                <div class="flex gap-4 max-w-4xl mx-auto">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-md ring-4 ring-white">
                            {{ substr($thread->user->name, 0, 2) }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="bg-blue-50/50 border border-blue-100 rounded-2xl rounded-tl-none p-6 shadow-sm relative group">
                            <div class="prose prose-blue max-w-none text-gray-800">
                                {!! nl2br(e($thread->body)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Divider Balasan --}}
                <div class="relative max-w-4xl mx-auto py-4">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-white text-sm font-medium text-gray-500 uppercase tracking-wider">
                            {{ $posts->total() }} Balasan
                        </span>
                    </div>
                </div>

                {{-- List Balasan --}}
                <div class="space-y-6 max-w-4xl mx-auto pb-24">
                    @forelse($posts as $post)
                        <div class="flex gap-4 {{ $post->user_id === auth()->id() ? 'flex-row-reverse' : '' }}">
                            
                            {{-- Avatar --}}
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm
                                    {{ $post->user->role == 'teacher' || $post->user->role == 'admin' ? 'bg-gradient-to-br from-indigo-500 to-purple-600' : 'bg-gray-400' }}">
                                    {{ substr($post->user->name, 0, 2) }}
                                </div>
                            </div>

                            {{-- Bubble Isi --}}
                            <div class="flex-1 max-w-[85%]">
                                <div class="p-4 rounded-2xl shadow-sm border relative group
                                    {{ $post->user_id === auth()->id() ? 'bg-blue-600 text-white rounded-tr-none border-transparent' : 'bg-white text-gray-800 rounded-tl-none border-gray-200' }}">
                                    
                                    <div class="flex justify-between items-start mb-1">
                                        <span class="text-xs font-bold {{ $post->user_id === auth()->id() ? 'text-blue-100' : 'text-gray-900' }}">
                                            {{ $post->user->name }}
                                            @if($post->user->role == 'teacher' || $post->user->role == 'admin')
                                                <span class="ml-1 px-1.5 py-0.5 rounded bg-white/20 text-[10px] uppercase tracking-wide border border-white/20">Instruktur</span>
                                            @endif
                                        </span>
                                        <span class="text-[10px] {{ $post->user_id === auth()->id() ? 'text-blue-200' : 'text-gray-400' }}">
                                            {{ $post->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    
                                    <div class="text-sm leading-relaxed whitespace-pre-wrap break-words">{{ $post->body }}</div>

                                    {{-- Delete Button for Post --}}
                                    @can('delete', $post)
                                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Hapus balasan ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-1 rounded hover:bg-white/20 text-current transition" title="Hapus">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-400 text-sm italic">
                            Belum ada balasan. Jadilah yang pertama membantu!
                        </div>
                    @endforelse

                    {{-- Pagination --}}
                    <div class="pt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>

            {{-- 3. Form Balasan (Sticky Bottom) --}}
            <div class="sticky bottom-0 bg-white border-t border-gray-200 p-4 md:p-6 z-20">
                <div class="max-w-4xl mx-auto">
                    <form action="{{ route('threads.posts.store', $thread) }}" method="POST" class="relative">
                        @csrf
                        <div class="relative">
                            <textarea name="body" rows="1" class="block w-full py-4 pl-5 pr-16 text-gray-900 bg-gray-50 rounded-2xl border-0 focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all resize-none shadow-sm" placeholder="Tulis balasanmu di sini..." required oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                            
                            <button type="submit" class="absolute right-2 bottom-2.5 p-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors shadow-md">
                                <svg class="w-5 h-5 rotate-90" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>