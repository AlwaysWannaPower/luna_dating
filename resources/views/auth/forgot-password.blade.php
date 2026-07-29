<x-guest-layout>
    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <a href="/" class="flex items-center gap-2 group">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-luna-primary to-luna-accent flex items-center justify-center shadow-lg shadow-luna-primary/30">
                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
            <span class="text-3xl font-bold bg-gradient-to-r from-luna-primary to-luna-accent bg-clip-text text-transparent hidden sm:block">{{ config('app.name', 'Luna') }}</span>
        </a>
    </div>

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-text-primary dark:text-dark-text">{{ __('Забыли пароль?') }}</h2>
        <p class="text-sm text-text-secondary dark:text-dark-text-muted mt-1">{{ __('Не переживайте, просто сообщите нам свой адрес электронной почты, и мы отправим вам ссылку для сброса пароля.') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-medium" />
            <div class="mt-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <x-text-input id="email"
                              class="block w-full pl-10 pr-4 py-3 rounded-xl border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg-card focus:ring-luna-primary focus:border-luna-primary transition-colors duration-200"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required
                              autofocus
                              autocomplete="username"
                              placeholder="you@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full py-3 text-base">
            {{ __('Отправить ссылку для сброса пароля') }}
        </x-primary-button>
    </form>

    <!-- Back to Login -->
    <p class="mt-6 text-center text-sm text-text-secondary dark:text-dark-text-muted">
        <a href="{{ route('login') }}" class="font-semibold text-luna-primary hover:text-luna-primary-hover hover:underline transition-colors duration-200">
            ← {{ __('Вернуться ко входу') }}
        </a>
    </p>
</x-guest-layout>
