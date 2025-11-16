<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
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

                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
                            <input id="name" name="name" type="text" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input id="email" name="email" type="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mt-4">
                            <label for="role" class="block font-medium text-sm text-gray-700">Role</label>
                            <select id="role" name="role" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                <option value="student" @selected(old('role', $user->role) == 'student')>Student</option>
                                <option value="teacher" @selected(old('role', $user->role) == 'teacher')>Teacher</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="is_active" class="block font-medium text-sm text-gray-700">Status</label>
                            <select id="is_active" name="is_active" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                <option value="1" @selected(old('is_active', $user->is_active) == 1)>Aktif</option>
                                <option value="0" @selected(old('is_active', $user->is_active) == 0)>Non-Aktif</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="password" class="block font-medium text-sm text-gray-700">Password Baru (Biarkan kosong jika tidak diubah)</label>
                            <input id="password" name="password" type="password" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                        </div>

                        <div class="mt-4">
                            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password Baru</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('users.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>