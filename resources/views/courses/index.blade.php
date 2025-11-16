<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kursus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @can('create', App\Models\Course::class)
                        <a href="{{ route('courses.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mb-4">
                            Tambah Kursus
                        </a>
                    @endcan

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kursus</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($courses as $course)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $course->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $course->category->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $course->teacher->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($course->is_active)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                            @can('update', $course)
                                                <a href="{{ route('courses.contents.index', $course) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Materi</a>
                                            @endcan
                                            @can('view', $course)
                                                <a href="{{ route('courses.show', $course) }}" class="text-green-600 hover:text-green-900 mr-2">View</a>
                                            @endcan
                                            @can('update', $course)
                                                <a href="{{ route('courses.edit', $course) }}" class="text-indigo-600 hover:text-indigo-900 ml-2 mr-2">Edit</a>
                                            @endcan
                                            
                                            @can('delete', $course)
                                                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="inline ml-4" onsubmit="return confirm('Anda yakin ingin menghapus kursus ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            Belum ada kursus.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $courses->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>