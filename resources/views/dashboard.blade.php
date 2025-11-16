<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(auth()->user()->role === 'student')

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-2xl font-semibold mb-6">Kursus Saya</h3>

                        @if($enrolledCourses->isEmpty())
                            <p class="text-center text-gray-500">
                                Anda belum mendaftar di kursus manapun.
                                <br>
                                <a href="{{ route('course.catalog') }}" class="text-blue-600 hover:underline">Lihat Katalog Kursus</a>
                            </p>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($enrolledCourses as $course)
                                    <div class="border rounded-lg overflow-hidden shadow-lg flex flex-col">
                                        <div class="p-4 flex-grow">
                                            <h4 class="text-lg font-bold">{{ $course->title }}</h4>
                                            <p class="text-sm text-gray-600 mt-1">oleh {{ $course->teacher->name }}</p>
                                        </div>

                                        <div class="p-4 bg-gray-50">
                                            <a href="#" class="font-semibold text-blue-600 hover:text-blue-500">
                                                Mulai Belajar &rarr;
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            @else

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("Selamat datang di Dashboard!") }}
                    </div>
                </div>

            @endif
        </div>
    </div>
</x-app-layout>