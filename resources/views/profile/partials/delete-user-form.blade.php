<section class="bg-red-50/50 rounded-2xl shadow-sm border border-red-100 p-8 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-red-100 opacity-20 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>

    <header class="relative z-10 flex flex-col md:flex-row md:items-start justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-red-700 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                {{ __('Hapus Akun') }}
            </h2>
            <p class="mt-2 text-sm text-red-600/80 max-w-2xl">
                {{ __('Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Harap unduh data atau informasi apa pun yang ingin Anda simpan sebelum menghapus akun Anda.') }}
            </p>
        </div>
        
        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-red-500/30 flex-shrink-0"
        >
            {{ __('Hapus Akun') }}
        </button>
    </header>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-gray-900">
                {{ __('Apakah Anda yakin ingin menghapus akun ini?') }}
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                {{ __('Setelah akun dihapus, semua data akan hilang permanen. Silakan masukkan password Anda untuk konfirmasi.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 rounded-xl border-gray-300 focus:border-red-500 focus:ring-red-500"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="rounded-xl">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="rounded-xl bg-red-600 hover:bg-red-700">
                    {{ __('Ya, Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>