<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Forum Diskusi - {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('courses.threads.index', $course) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 mb-4">
                &larr; Kembali ke Daftar Diskusi
            </a>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 border-b-2 border-blue-600">
                    <h1 class="text-2xl font-bold mb-2">{{ $thread->title }}</h1>
                    <p class="text-sm text-gray-600 mb-4">
                        Ditulis oleh <span class="font-medium">{{ $thread->user->name }}</span> ({{ $thread->created_at->diffForHumans() }})
                    </p>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($thread->body)) !!}
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-semibold mb-4">Balasan</h3>
            <div class="space-y-4">
                @forelse ($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <p class="text-sm text-gray-600 mb-3">
                                <span class="font-medium">{{ $post->user->name }}</span> membalas {{ $post->created_at->diffForHumans() }}
                            </p>
                            <div class="prose max-w-none text-gray-700">
                                {!! nl2br(e($post->body)) !!}
                            </div>

                            @can('delete', $post)
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mt-4 text-right" onsubmit="return confirm('Anda yakin ingin menghapus balasan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada balasan.</p>
                @endforelse

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </div>

            <div class="mt-8">
                <form action="{{ route('threads.posts.store', $thread) }}" method="POST">
                    @csrf
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <label for="body" class="block font-medium text-lg text-gray-700 mb-2">Tulis Balasan Anda</label>
                            <textarea id="body" name="body" rows="5" class="block w-full rounded-md shadow-sm border-gray-300" required>{{ old('body') }}</textarea>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 mt-4">
                                Kirim Balasan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>