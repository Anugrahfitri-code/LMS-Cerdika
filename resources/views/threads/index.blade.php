<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Forum Diskusi: {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between mb-6">
                        <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $course->contents()->orderBy('order', 'asc')->first()]) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200">
                            &larr; Kembali ke Materi
                        </a>
                        <a href="{{ route('courses.threads.create', $course) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                            Mulai Diskusi Baru
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-4">
                        @forelse ($threads as $thread)
                            <a href="{{ route('courses.threads.show', ['course' => $course, 'thread' => $thread]) }}" class="block p-4 border rounded-lg hover:bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-semibold text-lg text-blue-700">{{ $thread->title }}</h3>
                                    <span class="text-sm text-gray-600">{{ $thread->posts_count }} balasan</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">
                                    Dimulai oleh <span class="font-medium">{{ $thread->user->name }}</span>
                                    - {{ $thread->created_at->diffForHumans() }}
                                </p>
                            </a>
                        @empty
                            <p class="text-center text-gray-500">Belum ada diskusi. Jadilah yang pertama!</p>
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