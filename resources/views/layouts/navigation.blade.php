<nav class="bg-white border-b border-gray-100 h-20 flex items-center z-30 sticky top-0 shadow-sm">
    
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <div class="flex items-center">
                
                <button @click="sidebarOpen = !sidebarOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-blue-600 hover:bg-blue-50 focus:outline-none transition duration-150 ease-in-out md:hidden mr-3">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': sidebarOpen, 'inline-flex': ! sidebarOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! sidebarOpen, 'inline-flex': sidebarOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="hidden sm:flex flex-col">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        {{ now()->format('l, d F Y') }}
                    </span>
                    <div class="flex items-center gap-2">
                        @auth
                            <h2 class="font-extrabold text-gray-800 text-lg leading-tight">
                                Halo, {{ explode(' ', Auth::user()->name)[0] }}!
                            </h2>
                        @else
                            <h2 class="font-extrabold text-gray-800 text-lg leading-tight">
                                Selamat Datang!
                            </h2>
                        @endauth
                        <span class="animate-bounce cursor-default hidden md:inline-block">👋</span>
                    </div>
                </div>
                
                <div class="sm:hidden flex flex-col">
                    <span class="font-extrabold text-gray-800 text-lg">LMS Cerdika</span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 focus:outline-none group">
                            
                            <div class="text-right hidden md:block">
                                <div class="text-sm font-bold text-gray-700 group-hover:text-blue-700 transition">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</div>
                            </div>
                            
                            <div class="h-10 w-10 rounded-full flex-shrink-0 overflow-hidden border border-gray-200 shadow-sm group-hover:ring-2 group-hover:ring-blue-100 transition">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center font-bold text-white text-sm bg-gradient-to-br from-blue-500 to-indigo-600">
                                        {{ substr(Auth::user()->name, 0, 2) }}
                                    </div>
                                @endif
                            </div>
                            
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 transition hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl py-1 border border-gray-100 z-50"
                             style="display: none;">
                            
                            <div class="px-4 py-3 border-b border-gray-100 md:hidden">
                                <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ __('Profile Saya') }}
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition flex items-center gap-2 rounded-b-xl">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    {{ __('Keluar') }}
                                </a>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Tombol Login untuk Tamu --}}
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-blue-600 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 shadow-sm transition hidden sm:inline-block">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>