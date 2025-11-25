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

    @if(request('notice') == 'browse_all')
        <div class="mb-6 bg-purple-50 border-l-4 border-purple-500 p-4 rounded-r-md shadow-sm animate-pulse">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-purple-800">Eksplorasi Tanpa Batas! 🚀</h3>
                    <div class="mt-1 text-sm text-purple-700">
                        Wah, antusiasme Anda luar biasa! Untuk mengakses <strong>perpustakaan lengkap</strong> kami dan mulai belajar, silakan masuk atau buat akun gratis.
                    </div>
                </div>
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

        <div class="mb-2" x-data="{ show: false }">
            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
            <div class="relative">
                <input id="password" 
                       :type="show ? 'text' : 'password'" 
                       name="password" 
                       required 
                       class="w-full pl-4 pr-12 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                       placeholder="••••••••">
                
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-blue-600 transition-colors focus:outline-none">
                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                </button>
            </div>
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