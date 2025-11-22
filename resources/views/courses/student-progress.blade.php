<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Progres Siswa') }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Pantau perkembangan belajar siswa di kelas ini.</p>
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
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Progres</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-3xl shadow-xl p-8 mb-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-indigo-500 opacity-20 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="text-blue-100 text-xs font-bold uppercase tracking-wider mb-2">Laporan Kelas</div>
                        <h1 class="text-3xl font-extrabold leading-tight">{{ $course->title }}</h1>
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="text-center bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-3 min-w-[100px]">
                            <span class="block text-2xl font-bold">{{ $students->count() }}</span>
                            <span class="text-xs text-blue-100 uppercase font-bold">Total Siswa</span>
                        </div>
                        <div class="text-center bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-3 min-w-[100px]">
                            <span class="block text-2xl font-bold">{{ $totalContents }}</span>
                            <span class="text-xs text-blue-100 uppercase font-bold">Total Materi</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <span class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></span>
                        Daftar Siswa
                    </h3>
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-blue-600 transition">
                        &larr; Kembali
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                                <th class="px-6 py-4 font-semibold">Nama Siswa</th>
                                <th class="px-6 py-4 font-semibold">Status Belajar</th>
                                <th class="px-6 py-4 font-semibold text-center">Persentase</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($students as $student)
                                <tr class="hover:bg-blue-50/30 transition duration-200 group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm shadow-sm mr-3">
                                                {{ substr($student->name, 0, 2) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900">{{ $student->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $student->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ $student->completed_count }} / {{ $totalContents }}
                                            </span>
                                            <span class="text-xs text-gray-400">Materi Selesai</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-grow bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                                <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500 group-hover:bg-blue-500" style="width: {{ $student->progress_percentage }}%"></div>
                                            </div>
                                            <span class="text-sm font-bold {{ $student->progress_percentage == 100 ? 'text-green-600' : 'text-blue-600' }} w-12 text-right">
                                                {{ (int)$student->progress_percentage }}%
                                            </span>
                                        </div>
                                        @if($student->progress_percentage == 100)
                                            <div class="mt-1 text-right">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-700 border border-green-200">
                                                    LULUS
                                                </span>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4 text-gray-400">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">Belum ada siswa yang mendaftar.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>