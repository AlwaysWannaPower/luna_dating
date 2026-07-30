<x-guest-layout>
    <div class="flex min-h-[calc(100vh-12rem)] flex-col justify-center py-12 px-4 sm:px-6 lg:px-8" x-data="{ showPassword: false }">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="/" class="flex items-center justify-center gap-2 group">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-luna-primary to-luna-accent flex items-center justify-center shadow-lg shadow-luna-primary/30 group-hover:shadow-luna-primary/50 transition-all duration-300 group-hover:scale-105">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <span class="text-3xl font-bold bg-gradient-to-r from-luna-primary to-luna-accent bg-clip-text text-transparent hidden sm:block">{{ config('app.name', 'Luna') }}</span>
            </a>

            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-text-primary dark:text-dark-text">{{ __('Вход в аккаунт') }}</h2>
                <p class="text-sm text-text-secondary dark:text-dark-text-muted mt-1">{{ __('Добро пожаловать! Рады видеть вас снова') }}</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-sm font-medium" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg-card text-text-primary dark:text-dark-text focus:ring-luna-primary focus:border-luna-primary py-2.5 px-4 rounded-xl transition-colors" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Пароль')" class="text-sm font-medium" />
                    <div class="mt-1 relative">
                        <input id="password" name="password" type="password" x-bind:type="showPassword ? 'text' : 'password'" class="block w-full border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg-card text-text-primary dark:text-dark-text focus:ring-luna-primary focus:border-luna-primary py-2.5 pl-4 pr-10 rounded-xl transition-colors" required autocomplete="current-password" placeholder="••••••••" />
                        <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary hover:text-text-primary transition-colors">
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-border dark:border-dark-border text-luna-primary focus:ring-luna-primary" name="remember">
                        <span class="ms-2 text-sm text-text-secondary dark:text-dark-text-muted">{{ __('Запомнить меня') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-luna-primary hover:text-luna-accent transition-colors" href="{{ route('password.request') }}">
                            {{ __('Забыли пароль?') }}
                        </a>
                    @endif
                </div>

                <x-primary-button class="w-full py-3 text-base">
                    {{ __('Войти') }}
                </x-primary-button>
            </form>

            <p class="mt-6 text-center text-sm text-text-secondary dark:text-dark-text-muted">
                {{ __('Нет аккаунта?') }}
                <a href="{{ route('register') }}" class="font-semibold text-luna-primary hover:text-luna-accent transition-colors">
                    {{ __('Зарегистрироваться') }}
                </a>
            </p>
        </div>
    </div>

    <script>
        let showPassword = false;
        function togglePassword() {
            showPassword = !showPassword;
            const input = document.getElementById('password');
            input.type = showPassword ? 'text' : 'password';
        }
    </script>
</x-guest-layout>
