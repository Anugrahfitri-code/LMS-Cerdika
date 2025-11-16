<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kursus Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf

                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">Nama Kursus</label>
                            <input id="title" name="title" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('title') }}" required>
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">{{ old('description') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="category_id" class="block font-medium text-sm text-gray-700">Kategori</label>
                            <select id="category_id" name="category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if(auth()->user()->role === 'admin')
                            <div class="mt-4">
                                <label for="user_id" class="block font-medium text-sm text-gray-700">Teacher</label>
                                <select id="user_id" name="user_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                    <option value="">Pilih Teacher</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" @selected(old('user_id') == $teacher->id)>{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="mt-4">
                            <label for="start_date" class="block font-medium text-sm text-gray-700">Tanggal Mulai</label>
                            <input id="start_date" name="start_date" type="date" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('start_date') }}" required>
                        </div>

                        <div class="mt-4">
                            <label for="end_date" class="block font-medium text-sm text-gray-700">Tanggal Selesai</label>
                            <input id="end_date" name="end_date" type="date" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('end_date') }}" required>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('courses.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>