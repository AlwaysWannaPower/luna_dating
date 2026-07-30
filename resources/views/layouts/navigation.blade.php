<nav x-data="{ 
            open: false,
            darkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        }" 
        class="bg-bg-primary dark:bg-dark-bg-card border-b border-border dark:border-dark-border sticky top-0 z-50 transition-colors duration-300"
        @click.outside="open = false"
    >
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ Auth::check() ? route('dashboard') : route('welcome') }}" class="flex items-center gap-2 group">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-luna-primary to-luna-accent flex items-center justify-center shadow-lg shadow-luna-primary/20 group-hover:shadow-luna-primary/40 transition-all duration-300 group-hover:scale-105">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.45.45 0 00-.442-.263h-2.425a.45.45 0 00-.354.172l-.9.9a.45.45 0 01-.685.032l-1.519-1.49a.45.45 0 01-.013-.626l.879-.9a2.927 2.927 0 00.662-1.816v-.538a.45.45 0 00-.354-.435l-1.373-.274a2.959 2.959 0 00-1.816.662l-.473.473a2.25 2.25 0 01-3.182 0l-.473-.473a2.959 2.959 0 00-1.816-.662l-1.373.274a.45.45 0 00-.354.435v.538c0 .673.24 1.321.662 1.816l.879.9a.45.45 0 01-.013.626l-1.52 1.49a.45.45 0 01-.684-.032l-.9-.9a.45.45 0 00-.354-.172H3.614a.45.45 0 00-.442.263l-1.08 2.16a2.252 2.252 0 01-.421.585L.574 13.393a2.248 2.248 0 000 3.214l1.135 1.135a2.252 2.252 0 01.421.585l1.08 2.16a.45.45 0 00.442.263h2.425a.45.45 0 00.354-.172l.9-.9a.45.45 0 01.685.032l1.519 1.49a.45.45 0 01.013.626l.879.9a2.927 2.927 0 00-.662 1.816v-.538c0 .21.141.395.354.435l1.373.274a2.959 2.959 0 001.816.662l.473.473a2.25 2.25 0 013.182 0l.473.473a2.959 2.959 0 001.816.662l1.373-.274a.45.45 0 00.354-.435v-.538c0-.673-.24-1.321-.662-1.816l.879-.9a.45.45 0 01-.013-.626l1.52-1.49a.45.45 0 01-.684.032l.9.9a.45.45 0 00.354.172h2.425a.45.45 0 00.442-.263l1.08-2.16a2.252 2.252 0 01.421-.585l1.135-1.135a2.248 2.248 0 000-3.214z" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold bg-gradient-to-r from-luna-primary to-luna-accent bg-clip-text text-transparent">Luna</span>
                        </a>
                    </div>
    
                    <!-- Desktop Navigation Links (for authenticated users) -->
                    @if(Auth::check())
                    <div class="hidden md:flex space-x-1 ml-10">
                        <x-nav-link-custom :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Matches') }}
                        </x-nav-link-custom>
                        <x-nav-link-custom :href="route('discover')" :active="request()->routeIs('discover')">
                            {{ __('Discover') }}
                        </x-nav-link-custom>
                        <x-nav-link-custom :href="route('likes.index')" :active="request()->routeIs('likes.index')">
                            {{ __('My Likes') }}
                        </x-nav-link-custom>
                    </div>
                    @endif
                </div>
    
                <!-- Right Side - Logged in user dropdown or Guest links -->
                <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-3">
                    <!-- Language Switcher -->
                    <a href="{{ route('locale.switch', app()->getLocale() === 'ru' ? 'en' : 'ru') }}"
                       class="inline-flex items-center justify-center p-2.5 rounded-xl text-text-secondary hover:text-text-primary hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover focus:outline-none transition-all duration-200"
                       title="Switch language">
                        <span class="text-sm font-semibold uppercase">{{ strtoupper(app()->getLocale()) }}</span>
                    </a>

                    <!-- Dark Mode Toggle (always visible) -->
                    <button 
                        @click="darkMode = !darkMode; if(darkMode){document.documentElement.classList.add('dark')}else{document.documentElement.classList.remove('dark')}; localStorage.setItem('theme', darkMode ? 'dark' : 'light')"
                        class="inline-flex items-center justify-center p-2.5 rounded-xl text-text-secondary hover:text-text-primary hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover focus:outline-none transition-all duration-200"
                        title="Toggle theme"
                    >
                        <!-- Sun Icon -->
                        <svg x-show="!darkMode" class="block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <!-- Moon Icon -->
                        <svg x-show="darkMode" class="block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
    
                    @if(Auth::check())
                        <!-- User Dropdown (logged in) -->
                        <div class="relative ms-3">
                            <div x-data="{ open: false }" @click.outside="open = false">
                                <button @click="open = !open" class="inline-flex items-center rounded-xl hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover focus:outline-none transition-colors duration-200">
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-br from-luna-primary to-luna-accent flex items-center justify-center text-white font-medium text-sm shadow-md">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <svg class="ms-2 h-4 w-4 text-text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
        
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-56 rounded-2xl bg-bg-primary dark:bg-dark-bg-card border border-border dark:border-dark-border shadow-xl py-1 z-50 dropdown-menu"
                                >
                                    <!-- User Info -->
                                    <div class="px-4 py-3 border-b border-border dark:border-dark-border">
                                        <p class="text-sm font-semibold text-text-primary dark:text-dark-text">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-text-secondary dark:text-dark-text-muted truncate">{{ Auth::user()->email }}</p>
                                    </div>
        
                                    <!-- Profile Link -->
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
        
                                    <!-- Logout -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Logout') }}
                                        </x-dropdown-link>
                                    </form>

                                    <!-- Language Switcher -->
                                    <x-dropdown-link :href="route('locale.switch', app()->getLocale() === 'ru' ? 'en' : 'ru')">
                                        {{ app()->getLocale() === 'ru' ? 'English' : 'Русский' }}
                                    </x-dropdown-link>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Guest Links (not logged in) -->
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" 
                               class="px-4 py-2 rounded-xl text-sm font-medium text-text-secondary hover:text-text-primary hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover transition-colors">
                                Log in
                            </a>
                            <a href="{{ route('register') }}" 
                               class="px-4 py-2 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-luna-primary to-luna-accent hover:shadow-lg hover:shadow-luna-primary/20 transition-all">
                                Sign up
                            </a>
                        </div>
                    @endif
                </div>
    
                <!-- Mobile menu button -->
                <div class="-me-2 flex items-center sm:hidden space-x-2">
                    <!-- Mobile Dark Mode Toggle -->
                    <button 
                        @click="darkMode = !darkMode; if(darkMode){document.documentElement.classList.add('dark')}else{document.documentElement.classList.remove('dark')}; localStorage.setItem('theme', darkMode ? 'dark' : 'light')"
                        class="inline-flex items-center justify-center p-2.5 rounded-xl text-text-secondary hover:text-text-primary hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover focus:outline-none transition-all duration-200"
                    >
                        <svg x-show="!darkMode" class="block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg x-show="darkMode" class="block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
    
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-text-secondary hover:text-text-primary hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover focus:outline-none transition-colors duration-200">
                        <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    
        <!-- Responsive Navigation Menu (mobile) -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-bg-primary dark:bg-dark-bg-card border-t border-border dark:border-dark-border">
            
            @if(Auth::check())
                <!-- Logged in mobile nav -->
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Matches') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('discover')" :active="request()->routeIs('discover')">
                        {{ __('Discover') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('likes.index')" :active="request()->routeIs('likes.index')">
                        {{ __('My Likes') }}
                    </x-responsive-nav-link>
                </div>
    
                <!-- Responsive Settings Options (mobile) -->
                <div class="pt-4 pb-4 border-t border-border dark:border-dark-border">
                    <div class="px-4">
                        <div class="font-medium text-base text-text-primary dark:text-dark-text">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-text-secondary dark:text-dark-text-muted">{{ Auth::user()->email }}</div>
                    </div>
    
                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('locale.switch', app()->getLocale() === 'ru' ? 'en' : 'ru')">
                            {{ app()->getLocale() === 'ru' ? 'English' : 'Русский' }}
                        </x-responsive-nav-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @else
                <!-- Guest mobile nav -->
                <div class="pt-4 pb-4 space-y-2 px-4">
                    <a href="{{ route('login') }}" 
                       class="block w-full text-center px-4 py-3 rounded-xl text-sm font-medium text-text-secondary border border-border dark:border-dark-border hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover transition-colors">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" 
                       class="block w-full text-center px-4 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-luna-primary to-luna-accent hover:shadow-lg transition-all">
                        Sign up
                    </a>
                </div>
            @endif
        </div>
    </nav>
