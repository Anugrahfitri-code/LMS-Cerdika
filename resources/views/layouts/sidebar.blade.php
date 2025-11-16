<div class="flex h-full flex-col bg-white shadow-lg">
    <div class="flex items-center justify-center h-16 shadow-md">
        <a href="{{ route('dashboard') }}">
            <span class="text-2xl font-bold text-blue-600">LMS-Cerdika</span>
            </a>
    </div>

    <nav class="flex-1 overflow-y-auto py-6">
        <div class="space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                    {{ __('Kategori') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    {{ __('User Management') }}
                </x-responsive-nav-link>

                @endif

            @if(auth()->user()->role === 'teacher')
                @endif

            @if(auth()->user()->role === 'student')
                @endif
        </div>
    </nav>
</div>