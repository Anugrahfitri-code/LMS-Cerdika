<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali 👋</h2>
        <p class="text-sm text-gray-500 mt-2">Masuk untuk melanjutkan pembelajaran Anda.</p>
    </div>

    @if(request('notice') == 'certification')
        <div class="mb-6 bg-indigo-50 border border-indigo-100 p-4 rounded-xl flex items-start gap-3">
            <div class="bg-indigo-100 p-2 rounded-lg">
                <svg class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-indigo-900">Ingin Sertifikat?</h3>
                <p class="text-xs text-indigo-700 mt-1">Silakan login atau daftar untuk klaim sertifikat.</p>
            </div>
        </div>
    @endif

    @if(request('notice') == 'catalog')
        <div class="mb-6 bg-blue-50 border border-blue-100 p-4 rounded-xl flex items-start gap-3">
            <div class="bg-blue-100 p-2 rounded-lg">
                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-blue-900">Akses Terbatas</h3>
                <p class="text-xs text-blue-700 mt-1">Login untuk melihat katalog lengkap.</p>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-5">
            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-2">
            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
            <input id="password" type="password" name="password" required 
                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm font-bold text-blue-600 hover:text-blue-800 hover:underline" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full py-3.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-600/30 transition-all transform hover:-translate-y-0.5">
            Masuk Sekarang
        </button>

        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800 hover:underline">Daftar Gratis</a>
            </p>
        </div>
    </form>
</x-guest-layout>