<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Edit Kursus') }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Perbarui detail informasi, jadwal, dan status kursus.</p>
            </div>
            
            <div class="mt-4 md:mt-0">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                                <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <a href="{{ route('courses.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Kursus</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6 flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <div class="text-white">
                        <h3 class="text-xl font-bold">Edit Informasi Kursus</h3>
                        <p class="text-blue-100 text-sm opacity-90">Pastikan informasi yang Anda masukkan akurat.</p>
                    </div>
                </div>

                <div class="p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <h3 class="text-sm font-bold text-red-800">Gagal Menyimpan</h3>
                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('courses.update', $course) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-8">
                            <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b border-gray-200 pb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Informasi Dasar
                            </h4>
                            
                            <div class="space-y-6">
                                <div>
                                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Nama Kursus</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        </div>
                                        <input id="title" name="title" type="text" class="block w-full pl-11 pr-4 py-3 border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition-colors sm:text-sm" value="{{ old('title', $course->title) }}" required>
                                    </div>
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Singkat</label>
                                    <textarea id="description" name="description" rows="4" class="block w-full px-4 py-3 border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition-colors sm:text-sm" placeholder="Jelaskan apa yang akan dipelajari...">{{ old('description', $course->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b border-gray-200 pb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                Klasifikasi & Pengajar
                            </h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                                    <div class="relative">
                                        <select id="category_id" name="category_id" class="block w-full pl-4 pr-10 py-3 border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition-colors sm:text-sm appearance-none cursor-pointer">
                                            <option value="">Pilih Kategori</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id', $course->category_id) == $category->id)>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>

                                @if(auth()->user()->role === 'admin')
                                    <div>
                                        <label for="user_id" class="block text-sm font-bold text-gray-700 mb-2">Pengajar (Teacher)</label>
                                        <div class="relative">
                                            <select id="user_id" name="user_id" class="block w-full pl-4 pr-10 py-3 border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition-colors sm:text-sm appearance-none cursor-pointer">
                                                <option value="">Pilih Teacher</option>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}" @selected(old('user_id', $course->user_id) == $teacher->id)>{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-8">
                            <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4 border-b border-gray-200 pb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Jadwal & Status
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="start_date" class="block text-sm font-bold text-gray-700 mb-2">Tanggal Mulai</label>
                                    <input id="start_date" name="start_date" type="date" class="block w-full px-4 py-3 border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition-colors sm:text-sm" value="{{ old('start_date', $course->start_date) }}" required>
                                </div>

                                <div>
                                    <label for="end_date" class="block text-sm font-bold text-gray-700 mb-2">Tanggal Selesai</label>
                                    <input id="end_date" name="end_date" type="date" class="block w-full px-4 py-3 border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition-colors sm:text-sm" value="{{ old('end_date', $course->end_date) }}" required>
                                </div>

                                <div>
                                    <label for="is_active" class="block text-sm font-bold text-gray-700 mb-2">Status Publikasi</label>
                                    <div class="relative">
                                        <select id="is_active" name="is_active" class="block w-full pl-4 pr-10 py-3 border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition-colors sm:text-sm appearance-none cursor-pointer">
                                            <option value="1" @selected(old('is_active', $course->is_active) == 1)>Aktif (Dapat Diakses)</option>
                                            <option value="0" @selected(old('is_active', $course->is_active) == 0)>Non-Aktif (Disembunyikan)</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('courses.index') }}" 
                               class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-all">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-8 py-2.5 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg shadow-blue-500/30 transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Update Kursus
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>