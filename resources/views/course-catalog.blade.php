<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Kursus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-8 p-6 bg-white rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold mb-4">Cari Kursus</h2>
                <form action="{{ route('course.catalog') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Cari kursus</label>
                            <input type="text" name="search" id="search" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ request('search') }}">
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select id="category" name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" @selected(request('category') == $category->slug)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if($courses->isEmpty())
                        <p class="text-center text-gray-500">Hasil tidak ditemukan.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($courses as $course)
                                    <div class="border rounded-lg overflow-hidden shadow-lg flex flex-col hover:shadow-xl transition-shadow duration-300">
                                        <div class="p-4 flex-grow">
                                            <span class="text-xs font-semibold bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $course->category->name }}</span>
                                            
                                            <a href="{{ route('public.course.show', $course) }}" class="block">
                                                <h3 class="text-lg font-bold mt-2 text-gray-900 hover:text-blue-600 transition-colors">
                                                    {{ $course->title }}
                                                </h3>
                                            </a>

                                            <p class="text-sm text-gray-600 mt-1">oleh {{ $course->teacher->name }}</p>
                                            <p class="text-sm text-gray-700 mt-2 line-clamp-3">
                                                {{ Str::limit(strip_tags($course->description), 100) }}
                                            </p>

                                            <div class="mt-3">
                                                <a href="{{ route('public.course.show', $course) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 hover:underline">
                                                    Lihat Detail Selengkapnya &rarr;
                                                </a>
                                            </div>
                                        </div>

                                        <div class="p-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                                            <a href="mailto:{{ $course->teacher->email }}" class="text-sm font-semibold text-gray-500 hover:text-gray-700 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                Hubungi
                                            </a>
                                            
                                            @auth
                                                @if(auth()->user()->role === 'student')
                                                    @if(in_array($course->id, $enrolledCourseIds))
                                                        <span class="text-sm font-bold text-green-600 flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                            Terdaftar
                                                        </span>
                                                    @else
                                                        <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="text-sm font-bold text-blue-600 hover:text-blue-800 border border-blue-600 hover:bg-blue-50 px-3 py-1 rounded transition-colors">
                                                                Ikuti Kursus
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $courses->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>