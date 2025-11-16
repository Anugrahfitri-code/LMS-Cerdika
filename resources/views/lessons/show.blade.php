<x-app-layout>
    {{-- Kita sembunyikan header default agar bisa membuat layout 2 kolom --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="flex h-screen" style="height: calc(100vh - 65px);"> {{-- Kurangi tinggi navbar --}}

        <div class="w-1/4 bg-white border-r overflow-y-auto">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Materi Kursus</h3>
                <nav class="space-y-2">
                    @foreach($courseContents as $item)
                        <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $item]) }}" 
                           class="flex items-center px-4 py-2 rounded-md {{ $item->id === $content->id ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-700 hover:bg-gray-100' }}">

                            @if(in_array($item->id, $completedContentIds))
                                <svg class="w-5 h-5 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            @else
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @endif

                            <span class="truncate">{{ $item->order }}. {{ $item->title }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        </div>

        <div class="w-3/4 overflow-y-auto">
            <div class="p-8">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <h1 class="text-3xl font-bold text-gray-900">{{ $content->title }}</h1>

                <hr class="my-6">

                <div class="prose max-w-none text-gray-700">
                    {{-- Kita gunakan nl2br() agar baris baru (enter) di textarea tampil sebagai <br> --}}
                    {!! nl2br(e($content->body)) !!}
                </div>

                <hr class="my-6">

                <div class="flex items-center justify-between">
                    @php
                        $isCompleted = in_array($content->id, $completedContentIds);
                    @endphp

                    @if($isCompleted)
                        <span class="font-semibold text-green-600">&#10003; Selesai</span>
                    @else
                        <form action="{{ route('lesson.complete', $content) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                                Tandai Selesai
                            </button>
                        </form>
                    @endif

                    {{-- Logika untuk Tombol Lanjutkan --}}
                    {{-- (Ini akan kita tambahkan nanti setelah "Mark as Done" berfungsi) --}}
                </div>

            </div>
        </div>

    </div>
</x-app-layout>