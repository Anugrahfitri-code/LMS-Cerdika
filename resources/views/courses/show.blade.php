<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kursus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex items-center justify-between mb-6">
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200">
                            &larr; Kembali ke Daftar Kursus
                        </a>
                        @can('update', $course)
                            <a href="{{ route('courses.edit', $course) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                                Edit Kursus
                            </a>
                        @endcan
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-medium text-lg text-gray-800 mb-1">Informasi Kursus</h3>
                            <div class="bg-gray-50 p-4 rounded-lg shadow-sm space-y-2">
                                <p class="text-sm text-gray-600"><strong>Nama Kursus:</strong> <span class="text-gray-900 font-medium">{{ $course->title }}</span></p>
                                <p class="text-sm text-gray-600"><strong>Kategori:</strong> <span class="text-gray-900">{{ $course->category->name }}</span></p>
                                <p class="text-sm text-gray-600"><strong>Teacher:</strong> <span class="text-gray-900">{{ $course->teacher->name }}</span></p>
                                <p class="text-sm text-gray-600"><strong>Status:</strong> 
                                    @if($course->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Non-Aktif</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-medium text-lg text-gray-800 mb-1">Detail Jadwal</h3>
                            <div class="bg-gray-50 p-4 rounded-lg shadow-sm space-y-2">
                                <p class="text-sm text-gray-600"><strong>Tanggal Mulai:</strong> <span class="text-gray-900">{{ \Carbon\Carbon::parse($course->start_date)->format('d M Y') }}</span></p>
                                <p class="text-sm text-gray-600"><strong>Tanggal Selesai:</strong> <span class="text-gray-900">{{ \Carbon\Carbon::parse($course->end_date)->format('d M Y') }}</span></p>
                                <p class="text-sm text-gray-600"><strong>Dibuat pada:</strong> <span class="text-gray-900">{{ $course->created_at->format('d M Y, H:i') }}</span></p>
                                <p class="text-sm text-gray-600"><strong>Terakhir diupdate:</strong> <span class="text-gray-900">{{ $course->updated_at->format('d M Y, H:i') }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="font-medium text-lg text-gray-800 mb-2">Deskripsi Kursus</h3>
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm prose max-w-none text-gray-700">
                            {{-- Gunakan {!! !!} jika deskripsi bisa mengandung HTML (dari editor), tapi berhati-hatilah dengan XSS --}}
                            {{-- Untuk text polos, {{ }} lebih aman. Saya asumsikan ini text polos. --}}
                            <p>{{ $course->description }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>