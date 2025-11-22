<x-app-layout>
    {{-- Kita kosongkan header default agar area belajar lebih luas --}}
    <x-slot name="header"></x-slot>

    <div class="flex h-[calc(100vh-65px)] bg-gray-50"> 
        
        {{-- SIDEBAR MATERI (Kiri) --}}
        <aside class="w-full md:w-80 bg-white border-r border-gray-200 flex flex-col h-full shrink-0 z-20">
            
            {{-- 1. Header Sidebar (Judul Kursus & Back) --}}
            <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-xs font-bold text-gray-500 hover:text-blue-600 transition mb-3 group">
                    <svg class="w-3 h-3 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Dashboard
                </a>
                <h2 class="font-bold text-gray-800 leading-tight line-clamp-2" title="{{ $course->title }}">
                    {{ $course->title }}
                </h2>
                
                {{-- Progress Bar Kecil --}}
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

            {{-- 2. Daftar Materi (Scrollable) --}}
            <div class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-1">
                @foreach($courseContents as $item)
                    @php
                        $isActive = $item->id === $content->id;
                        $isCompleted = in_array($item->id, $completedContentIds);
                    @endphp

                    <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $item]) }}" 
                       class="flex items-start p-3 rounded-xl transition-all duration-200 group relative
                       {{ $isActive ? 'bg-blue-50 border border-blue-100 shadow-sm' : 'hover:bg-gray-50 border border-transparent' }}">
                        
                        {{-- Status Icon --}}
                        <div class="flex-shrink-0 mt-0.5 mr-3">
                            @if($isActive)
                                {{-- Icon Play (Sedang Aktif) --}}
                                <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center text-white shadow-md">
                                    <svg class="w-3 h-3 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            @elseif($isCompleted)
                                {{-- Icon Ceklis (Selesai) --}}
                                <div class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center border border-green-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            @else
                                {{-- Icon Nomor (Belum) --}}
                                <div class="w-6 h-6 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center text-xs font-bold border border-gray-200">
                                    {{ $loop->iteration }}
                                </div>
                            @endif
                        </div>

                        {{-- Title --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium {{ $isActive ? 'text-blue-700' : ($isCompleted ? 'text-gray-600' : 'text-gray-500') }}">
                                {{ $item->title }}
                            </p>
                            @if($isActive)
                                <span class="text-[10px] text-blue-500 font-bold uppercase tracking-wider mt-1 inline-block">Sedang Dipelajari</span>
                            @endif
                        </div>

                        {{-- Active Indicator Bar --}}
                        @if($isActive)
                            <div class="absolute left-0 top-2 bottom-2 w-1 bg-blue-600 rounded-r-full"></div>
                        @endif
                    </a>
                @endforeach
            </div>

            {{-- BAGIAN FOOTER SIDEBAR (FORUM) SUDAH DIHAPUS --}}

        </aside>

        {{-- AREA KONTEN UTAMA (Kanan) --}}
        <main class="flex-1 overflow-y-auto bg-gray-50 relative scroll-smooth">
            
            <div class="max-w-4xl mx-auto px-6 py-10">
                
                {{-- Navigasi Atas (Next/Prev Preview) --}}
                <div class="flex items-center justify-between mb-6 text-sm text-gray-500">
                    <span>Materi ke-{{ $content->order }} dari {{ $courseContents->count() }}</span>
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-xs font-bold">Lesson Mode</span>
                </div>

                {{-- Tab Navigasi Materi & Diskusi --}}
                <div class="mb-6 border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <a href="#" class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Materi Belajar
                        </a>
                        <a href="{{ route('courses.threads.index', $course) }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.723-.562M15 7a2 2 0 00-2-2H3a2 2 0 00-2 2v12l4-4h6a2 2 0 002-2V9a2 2 0 00-2-2z"></path></svg>
                            Forum Diskusi
                        </a>
                    </nav>
                </div>

                {{-- Kartu Konten --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden min-h-[500px]">
                    
                    {{-- Header Konten --}}
                    <div class="px-8 py-8 border-b border-gray-100 bg-white">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                            {{ $content->title }}
                        </h1>
                    </div>

                    {{-- Body Konten --}}
                    <div class="px-8 py-8 prose prose-lg max-w-none text-gray-600 prose-headings:text-gray-800 prose-a:text-blue-600">
                        {!! $content->body !!}
                    </div>

                    {{-- Call to Action Forum di Akhir Materi --}}
                    <div class="px-8 pb-8">
                        <div class="bg-blue-50 rounded-xl p-4 flex items-center justify-between border border-blue-100">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-100 p-2 rounded-full text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-blue-900">Ada pertanyaan tentang materi ini?</p>
                                    <p class="text-xs text-blue-700">Diskusikan dengan instruktur dan siswa lain.</p>
                                </div>
                            </div>
                            <a href="{{ route('courses.threads.index', $course) }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 hover:underline">
                                Buka Forum &rarr;
                            </a>
                        </div>
                    </div>

                </div>

                {{-- Action Bar (Bawah) --}}
                <div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-4 pb-20">
                    
                    {{-- Tombol Previous --}}
                    @php
                        $prevContent = $courseContents->where('order', '<', $content->order)->sortByDesc('order')->first();
                    @endphp
                    <div>
                        @if($prevContent)
                            <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $prevContent]) }}" class="inline-flex items-center text-gray-500 hover:text-gray-800 font-medium transition px-4 py-2 rounded-lg hover:bg-gray-100">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                Sebelumnya
                            </a>
                        @endif
                    </div>

                    {{-- Tombol Mark Complete / Next / Sertifikat --}}
                    @php
                        $isCompleted = in_array($content->id, $completedContentIds);
                    @endphp

                    <div class="flex items-center gap-4">
                        @if($isCompleted)
                            <div class="flex items-center text-green-600 font-bold bg-green-50 px-4 py-2 rounded-full border border-green-100">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Selesai
                            </div>
                            
                            @if($nextContent)
                                <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $nextContent]) }}" 
                                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition transform hover:-translate-y-0.5">
                                    Materi Selanjutnya
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                </a>
                            @else
                                {{-- Tombol Klaim Sertifikat (Jika selesai semua) --}}
                                <a href="{{ route('courses.certificate', $course) }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl hover:from-green-600 hover:to-emerald-700 shadow-lg shadow-green-500/30 transition transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    Klaim Sertifikat
                                </a>
                            @endif
                        @else
                            <form action="{{ route('lesson.complete', $content) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-lg shadow-blue-600/30 transition transform hover:scale-105">
                                    Tandai Selesai & Lanjut
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            </form>
                        @endif
                    </div>

                </div>

            </div>
        </main>
    </div>
</x-app-layout>