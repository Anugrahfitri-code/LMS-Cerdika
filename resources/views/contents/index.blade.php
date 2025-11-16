<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materi untuk Kursus: ') }} {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between mb-4">
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200">
                            &larr; Kembali ke Kursus
                        </a>
                        <a href="{{ route('courses.contents.create', $course) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                            Tambah Materi Baru
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-6">
                        @forelse ($contents as $content)
                            <div class="mb-4 p-4 border rounded-lg flex items-center justify-between">
                                <div>
                                    <h3 class="font-semibold text-lg">{{ $content->order }}. {{ $content->title }}</h3>
                                    <p class="text-sm text-gray-600">{{ Str::limit(strip_tags($content->body), 100) }}</p>
                                </div>
                                <div class="flex-shrink-0 ml-4">
                                    <a href="{{ route('contents.edit', $content) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <form action="{{ route('contents.destroy', $content) }}" method="POST" class="inline" onsubmit="return confirm('Anda yakin ingin menghapus materi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">Belum ada materi untuk kursus ini.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>