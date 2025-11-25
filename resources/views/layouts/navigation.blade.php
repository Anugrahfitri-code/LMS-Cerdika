<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 h-20 flex items-center z-30 sticky top-0">
    
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <div class="flex items-center flex-1">
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="hidden sm:flex flex-col ml-4">
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
                                Halo, Tamu!
                            </h2>
                        @endauth
                        <span class="animate-bounce cursor-default" title="Selamat Datang!"> 👋 </span>
                    </div>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                
                @auth
                    @if(Auth::user()->role === 'student')
                        @php
                            // Ambil data kursus dan progres user yang sedang login secara Real-Time
                            $navCourses = Auth::user()->enrolledCourses()->with('contents')->get();
                            $userProgressIds = Auth::user()->progress()->pluck('content_id')->toArray();
                        @endphp
                        <div class="relative" x-data="{ learningOpen: false }">
                            <button @click="learningOpen = !learningOpen" @click.away="learningOpen = false" class="flex items-center px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-full transition focus:outline-none group border border-blue-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <span class="text-sm font-bold">Belajar Saya</span>
                                
                                @if($navCourses->count() > 0)
                                    <span class="ml-2 bg-blue-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                                        {{ $navCourses->count() }}
                                    </span>
                                @endif
                            </button>

                            <div x-show="learningOpen" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-xl ring-1 ring-black ring-opacity-5 py-0 z-50 overflow-hidden"
                                 style="display: none;">
                                
                                <div class="bg-blue-600 px-4 py-3 border-b border-blue-500 flex justify-between items-center">
                                    <h3 class="text-sm font-bold text-white">Lanjutkan Belajar</h3>
                                </div>
                                <div class="max-h-80 overflow-y-auto">
                                    @forelse($navCourses as $course)
                                        @php
                                            $totalMateri = $course->contents->count();
                                            $selesai = $course->contents->whereIn('id', $userProgressIds)->count();
                                            $persen = $totalMateri > 0 ? round(($selesai / $totalMateri) * 100) : 0;
                                            $firstLesson = $course->contents->sortBy('order')->first();
                                        @endphp
                                        <div class="px-4 py-3 border-b border-gray-50 hover:bg-gray-50 transition">
                                            <div class="flex justify-between items-start mb-1">
                                                <h4 class="text-sm font-bold text-gray-800 line-clamp-1">{{ $course->title }}</h4>
                                                <span class="text-xs font-bold {{ $persen == 100 ? 'text-green-600' : 'text-blue-600' }}">
                                                    {{ $persen }}%
                                                </span>
                                            </div>
                                            
                                            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-2">
                                                <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ $persen }}%"></div>
                                            </div>

                                            @if($firstLesson)
                                                <a href="{{ route('courses.lesson.show', ['course' => $course, 'content' => $firstLesson]) }}" class="text-[11px] font-bold text-indigo-600 hover:text-indigo-800 uppercase tracking-wide">
                                                    Lanjut &rarr;
                                                </a>
                                            @else
                                                <span class="text-[11px] text-gray-400">Belum ada materi</span>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="px-4 py-6 text-center">
                                            <p class="text-sm text-gray-500 mb-2">Anda belum mengikuti kursus apapun.</p>
                                            <a href="{{ route('course.catalog') }}" class="text-xs font-bold text-blue-600 hover:underline">Cari Kursus</a>
                                        </div>
                                    @endforelse
                                </div>
                                @if($navCourses->count() > 0)
                                    <a href="{{ route('dashboard') }}" class="block bg-gray-50 px-4 py-3 text-center text-xs font-bold text-gray-600 hover:text-blue-600 hover:bg-gray-100 transition">
                                        Lihat Semua di Dashboard
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 focus:outline-none group">
                            <div class="text-right hidden md:block">
                                <div class="text-sm font-bold text-gray-700 group-hover:text-blue-700 transition">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</div>
                            </div>
                            
                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md ring-2 ring-white group-hover:ring-blue-100 transition overflow-hidden">
                                @if(Auth::user()->avatar)
                                    {{-- Tampilkan Foto User --}}
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                @else
                                    {{-- Tampilkan Inisial (Fallback) --}}
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                @endif
                            </div>
                            
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-1 border border-gray-100 z-50"
                             style="display: none;">
                            
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                {{ __('Profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Tampilan Navigasi Kanan untuk Tamu --}}
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-blue-600">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 shadow-sm transition">Daftar</a>
                @endauth
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden absolute top-20 left-0 w-full bg-white border-b border-gray-100 shadow-lg">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">Masuk</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Daftar</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>