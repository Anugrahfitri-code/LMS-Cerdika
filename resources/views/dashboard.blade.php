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

                                            <div class="mt-4">
                                                <div class="flex justify-between mb-1">
                                                    <span class="text-sm font-medium text-gray-700">Progres</span>
                                                    <span class="text-sm font-medium text-gray-700">{{ (int)$course->progress_percentage }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $course->progress_percentage }}%"></div>
                                                </div>
                                            </div>
                                            </div>
                                        <div class="p-4 bg-gray-50">
                                            @if($course->firstContent)
                                                <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $course->firstContent]) }}" class="font-semibold text-blue-600 hover:text-blue-500">
                                                    Mulai Belajar &rarr;
                                                </a>
                                            @else
                                                <span class="text-sm text-gray-500">Materi belum tersedia</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            @elseif(auth()->user()->role === 'teacher')

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-2xl font-semibold mb-6">Kursus yang Saya Ajar</h3>

                        @if($taughtCourses->isEmpty())
                            <p class="text-center text-gray-500">
                                Anda belum membuat kursus apapun.
                                <br>
                                <a href="{{ route('courses.create') }}" class="text-blue-600 hover:underline">Buat Kursus Baru</a>
                            </p>
                        @else
                            <div class="space-y-4">
                                @foreach($taughtCourses as $course)
                                    <div class="border rounded-lg p-4 flex items-center justify-between">
                                        <div>
                                            <h4 class="text-lg font-bold">{{ $course->title }}</h4>
                                            <span class="text-sm text-gray-600">{{ $course->students_count }} Siswa Terdaftar</span>
                                        </div>
                                        <div>
                                            <a href="{{ route('courses.contents.index', $course) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 mr-4">
                                                Kelola Materi
                                            </a>

                                            <a href="{{ route('courses.threads.index', $course) }}" class="text-sm font-semibold text-green-600 hover:text-green-500 mr-4">
                                                Forum Diskusi
                                            </a>
                                            <a href="{{ route('courses.student.progress', $course) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-500">
                                                Lihat Progres Siswa
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
                        {{ __("Selamat datang di Dashboard Admin!") }}
                    </div>
                </div>

            @endif
        </div>
    </div>
</x-app-layout>