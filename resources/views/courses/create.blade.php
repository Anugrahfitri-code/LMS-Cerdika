<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Tambah Kursus') }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Buat kelas baru dan mulai bagikan pengetahuan Anda.</p>
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
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Buat Baru</span>
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
                
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-8 py-6 flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div class="text-white">
                        <h3 class="text-xl font-bold">Informasi Kursus</h3>
                        <p class="text-blue-100 text-sm opacity-90">Lengkapi detail kursus untuk menarik minat siswa.</p>
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

                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            
                            <div class="lg:col-span-2 space-y-6">
                                
                                <div>
                                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Nama Kursus</label>
                                    <div class="relative">
                                        <input id="title" name="title" type="text" class="block w-full pl-4 pr-4 py-3 border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition-colors sm:text-sm shadow-sm" placeholder="Contoh: Mastering Laravel 11" value="{{ old('title') }}" required autofocus>
                                    </div>
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Lengkap</label>
                                    <textarea id="description" name="description" rows="6" class="block w-full px-4 py-3 border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition-colors sm:text-sm shadow-sm" placeholder="Jelaskan apa yang akan dipelajari siswa...">{{ old('description') }}</textarea>
                                    <p class="text-xs text-gray-500 mt-2 text-right">Maksimal 500 karakter disarankan.</p>
                                </div>

                            </div>

                            <div class="lg:col-span-1 space-y-6">
                                
                                <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                    <h4 class="font-bold text-gray-800 mb-4 text-sm uppercase tracking-wider flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                        Kategorisasi
                                    </h4>
                                    
                                    <div class="mb-4">
                                        <label for="category_id" class="block text-xs font-semibold text-gray-600 mb-2">Kategori</label>
                                        <div class="relative">
                                            <select id="category_id" name="category_id" class="block w-full pl-3 pr-10 py-2.5 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm cursor-pointer">
                                                <option value="">Pilih Kategori</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @if(auth()->user()->role === 'admin')
                                        <div>
                                            <label for="user_id" class="block text-xs font-semibold text-gray-600 mb-2">Instruktur / Pengajar</label>
                                            <div class="relative">
                                                <select id="user_id" name="user_id" class="block w-full pl-3 pr-10 py-2.5 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm cursor-pointer">
                                                    <option value="">Pilih Pengajar</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}" @selected(old('user_id') == $teacher->id)>{{ $teacher->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                    <h4 class="font-bold text-gray-800 mb-4 text-sm uppercase tracking-wider flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Jadwal
                                    </h4>

                                    <div class="mb-4">
                                        <label for="start_date" class="block text-xs font-semibold text-gray-600 mb-2">Tanggal Mulai</label>
                                        <input id="start_date" name="start_date" type="date" class="block w-full px-3 py-2 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('start_date') }}" required>
                                    </div>

                                    <div>
                                        <label for="end_date" class="block text-xs font-semibold text-gray-600 mb-2">Tanggal Selesai</label>
                                        <input id="end_date" name="end_date" type="date" class="block w-full px-3 py-2 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('end_date') }}" required>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100 mt-6">
                            <a href="{{ route('courses.index') }}" 
                               class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-all">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center justify-center px-8 py-2.5 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg shadow-blue-500/30 transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Simpan Kursus
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>