<section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-bl-full -mr-8 -mt-8 pointer-events-none"></div>

    <header class="relative z-10 mb-8">
        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
            <div class="w-1 h-6 bg-blue-600 rounded-full"></div>
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-2 text-sm text-gray-500 max-w-xl">
            {{ __("Perbarui informasi profil akun Anda dan alamat email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8 relative z-10" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div x-data="{ photoName: null, photoPreview: null }">
            <input type="file" id="avatar" name="avatar" class="hidden" x-ref="photo"
                x-on:change="
                        photoName = $refs.photo.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.photo.files[0]);
                " />

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                <div class="relative group cursor-pointer" x-on:click.prevent="$refs.photo.click()">
                    <div class="h-24 w-24 rounded-2xl overflow-hidden border-4 border-white shadow-lg ring-1 ring-gray-100 transition-all duration-300 group-hover:ring-blue-200 group-hover:shadow-xl" 
                         x-show="!photoPreview">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 text-blue-600 text-2xl font-bold">
                                {{ substr($user->name, 0, 2) }}
                            </div>
                        @endif
                    </div>

                    <div class="h-24 w-24 rounded-2xl overflow-hidden border-4 border-white shadow-lg ring-2 ring-blue-400 bg-cover bg-center"
                         x-show="photoPreview"
                         style="display: none;"
                         x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </div>

                    <div class="absolute inset-0 bg-black/30 rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <svg class="w-8 h-8 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                </div>

                <div class="flex-1">
                    <h3 class="text-sm font-bold text-gray-900 mb-1">Foto Profil</h3>
                    <p class="text-xs text-gray-500 mb-4">Format: JPG, PNG, JPEG (Maks. 1MB)</p>
                    
                    <div class="flex flex-wrap items-center gap-3">
                        <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                x-on:click.prevent="$refs.photo.click()">
                            {{ __('Ganti Foto') }}
                        </button>

                        @if($user->avatar)
                            <button type="button" 
                                    x-show="!photoPreview"
                                    x-on:click.prevent="if(confirm('Hapus foto profil Anda?')) { document.getElementById('delete-avatar-form').submit() }"
                                    class="inline-flex items-center px-4 py-2 bg-red-50 border border-red-100 rounded-xl font-semibold text-xs text-red-600 uppercase tracking-widest hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                {{ __('Hapus') }}
                            </button>
                        @endif
                    </div>
                    <p class="text-xs text-green-600 mt-2 font-medium animate-pulse" x-show="photoName" style="display: none;">
                        <span class="mr-1">✓</span> Siap diunggah: <span x-text="photoName"></span>
                    </p>
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 my-6"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" class="mb-2 text-xs uppercase tracking-wide text-gray-500 font-bold" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <x-text-input id="name" name="name" type="text" class="pl-10 w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all" :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="Nama Anda" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Alamat Email')" class="mb-2 text-xs uppercase tracking-wide text-gray-500 font-bold" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                    </div>
                    <x-text-input id="email" name="email" type="email" class="pl-10 w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all" :value="old('email', $user->email)" required autocomplete="username" placeholder="email@contoh.com" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2 p-3 bg-yellow-50 rounded-lg border border-yellow-100">
                        <p class="text-sm text-yellow-800 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            {{ __('Email Anda belum diverifikasi.') }}
                        </p>

                        <button form="send-verification" class="mt-2 text-xs font-bold text-yellow-600 hover:text-yellow-800 underline">
                            {{ __('Klik di sini untuk kirim ulang email verifikasi.') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Link verifikasi baru telah dikirim.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:from-blue-700 hover:to-indigo-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-blue-500/30 transform hover:-translate-y-0.5">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium flex items-center gap-1"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Berhasil disimpan.') }}
                </p>
            @endif
        </div>
    </form>

    <form id="delete-avatar-form" method="POST" action="{{ route('profile.avatar.destroy') }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</section>