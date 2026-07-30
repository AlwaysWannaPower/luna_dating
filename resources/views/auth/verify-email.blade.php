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
        <h2 class="text-2xl font-bold text-text-primary dark:text-dark-text">{{ __('Подтвердите адрес электронной почты') }}</h2>
        <p class="text-sm text-text-secondary dark:text-dark-text-muted mt-1">{{ __('Спасибо за регистрацию! Перед тем как начать, пожалуйста, подтвердите адрес электронной почты, используя ссылку, которую мы вам отправили.') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (session('message') == 'verification-link-sent')
    <div class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-center">
        <p class="text-sm text-green-700 dark:text-green-300">{{ __('Новая ссылка подтверждения была отправлена на ваш адрес электронной почты.') }}</p>
    </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
        @csrf

        <x-primary-button class="w-full py-3 text-base">
            {{ __('Отправить повторное письмо') }}
        </x-primary-button>
    </form>

    <!-- Logout Form -->
    <form method="POST" action="{{ route('logout') }}" class="mt-6">
        @csrf
        <button type="submit"
                class="block w-full text-center text-sm text-text-secondary dark:text-dark-text-muted hover:text-luna-primary dark:hover:text-luna-accent underline underline-offset-2 transition-colors duration-200">
            {{ __('Выйти') }}
        </button>
    </form>
</x-guest-layout>
