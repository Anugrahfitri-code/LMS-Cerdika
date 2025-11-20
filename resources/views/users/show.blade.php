<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Detail Pengguna') }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">Melihat informasi lengkap akun pengguna.</p>
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
                                <a href="{{ route('users.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Users</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-blue-700 to-indigo-800 rounded-3xl shadow-xl overflow-hidden mb-8 relative p-8 text-white">
                
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl -ml-10 -mb-10"></div>

                <div class="absolute top-6 right-6 z-20">
                     <a href="{{ route('users.index') }}" class="inline-flex items-center px-3 py-1.5 bg-white/10 hover:bg-white/20 border border-white/20 rounded-lg text-white text-xs font-medium transition backdrop-blur-sm">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                </div>

                <div class="relative z-10 flex flex-col md:flex-row items-center md:items-center gap-6">
                    
                    <div class="relative">
                        <div class="w-28 h-28 rounded-full p-1 bg-white/20 backdrop-blur-sm">
                            <div class="w-full h-full rounded-full flex items-center justify-center text-3xl font-bold bg-white text-blue-700 shadow-inner">
                                {{ substr($user->name, 0, 2) }}
                            </div>
                        </div>
                        <div class="absolute bottom-2 right-2 w-5 h-5 rounded-full border-2 border-indigo-800 {{ $user->is_active ? 'bg-green-400' : 'bg-gray-400' }}" title="{{ $user->is_active ? 'Aktif' : 'Non-Aktif' }}"></div>
                    </div>

                    <div class="flex-1 text-center md:text-left">
                        <div class="flex flex-col md:flex-row items-center md:items-baseline gap-2 mb-2">
                            <h1 class="text-3xl font-bold tracking-tight">{{ $user->name }}</h1>
                            @if($user->role == 'admin')
                                <span class="px-2.5 py-0.5 rounded-md bg-red-500/20 border border-red-400/30 text-red-100 text-[10px] font-bold uppercase tracking-wider">Administrator</span>
                            @elseif($user->role == 'teacher')
                                <span class="px-2.5 py-0.5 rounded-md bg-purple-500/20 border border-purple-400/30 text-purple-100 text-[10px] font-bold uppercase tracking-wider">Teacher</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-md bg-blue-400/20 border border-blue-300/30 text-blue-100 text-[10px] font-bold uppercase tracking-wider">Student</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-center md:justify-start text-blue-100 text-sm mb-6">
                            <svg class="w-4 h-4 mr-2 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            {{ $user->email }}
                        </div>

                        <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-6 py-2.5 bg-white text-blue-700 rounded-full font-bold text-sm hover:bg-blue-50 focus:outline-none focus:ring-4 focus:ring-blue-500/30 shadow-lg shadow-blue-900/20 transition-all transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-6 flex items-center text-lg">
                        <div class="p-2 bg-blue-50 rounded-lg mr-3 text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .883-.393 1.768-1 2.343l-1.172 1.171C10.336 9.014 10 9.48 10 10v1m2-5v1m0 4v1m0-1v1m0 1v1"></path></svg>
                        </div>
                        Data Akun
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-gray-500 text-sm">ID System</span>
                            <span class="font-mono text-gray-900 font-bold text-xs bg-gray-100 px-2 py-1 rounded">USER-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-gray-500 text-sm">Verifikasi Email</span>
                            @if($user->email_verified_at)
                                <span class="text-green-600 font-bold text-xs flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Sudah</span>
                            @else
                                <span class="text-red-500 font-bold text-xs flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Belum</span>
                            @endif
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-500 text-sm">Role Akses</span>
                            <span class="text-gray-900 font-medium text-sm capitalize">{{ $user->role }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-6 flex items-center text-lg">
                        <div class="p-2 bg-purple-50 rounded-lg mr-3 text-purple-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        Timeline
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-gray-500 text-sm">Didaftarkan</span>
                            <span class="text-gray-900 font-medium text-sm">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-gray-500 text-sm">Pukul</span>
                            <span class="text-gray-900 font-medium text-sm">{{ $user->created_at->format('H:i') }} WIB</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-500 text-sm">Terakhir Update</span>
                            <span class="text-gray-900 font-medium text-sm">{{ $user->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-200 pt-8">
                <div class="bg-red-50 rounded-xl p-6 border border-red-100 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <h4 class="text-red-800 font-bold text-sm">Hapus Akun Pengguna</h4>
                        <p class="text-red-600 text-xs mt-1">Data yang dihapus tidak dapat dikembalikan. Harap berhati-hati.</p>
                    </div>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini secara permanen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-5 py-2 bg-white text-red-600 font-bold text-sm rounded-lg border border-red-200 hover:bg-red-600 hover:text-white transition-all shadow-sm">
                            Hapus Permanen
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>