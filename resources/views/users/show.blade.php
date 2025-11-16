<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengguna: ') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex items-center justify-between mb-6">
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200">
                            &larr; Kembali ke Daftar Pengguna
                        </a>
                        <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                            Edit Pengguna
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div class="space-y-4">
                            <div>
                                <h3 class="font-medium text-lg text-gray-800 mb-1">Informasi Dasar</h3>
                                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <p class="text-sm text-gray-600"><strong>Nama:</strong> <span class="text-gray-900">{{ $user->name }}</span></p>
                                    <p class="text-sm text-gray-600 mt-1"><strong>Email:</strong> <span class="text-gray-900">{{ $user->email }}</span></p>
                                    <p class="text-sm text-gray-600 mt-1"><strong>Role:</strong> <span class="text-gray-900 capitalize">{{ $user->role }}</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h3 class="font-medium text-lg text-gray-800 mb-1">Status & Waktu</h3>
                                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <p class="text-sm text-gray-600"><strong>Status Akun:</strong> 
                                        @if($user->is_active)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Non-Aktif</span>
                                        @endif
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1"><strong>Bergabung pada:</strong> <span class="text-gray-900">{{ $user->created_at->format('d M Y, H:i') }}</span></p>
                                    <p class="text-sm text-gray-600 mt-1"><strong>Terakhir diupdate:</strong> <span class="text-gray-900">{{ $user->updated_at->format('d M Y, H:i') }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Anda bisa menambahkan bagian lain di sini, misalnya daftar kursus yang diikuti/diajar --}}
                    {{-- <div class="mt-8">
                        <h3 class="font-medium text-lg text-gray-800 mb-2">Kursus yang Diikuti/Diajar</h3>
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <p class="text-gray-700">Akan menampilkan daftar kursus di sini (jika relevan dengan role).</p>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>