<x-guest-layout>
    <div class="flex min-h-[calc(100vh-12rem)] flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
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
                <h2 class="text-2xl font-bold text-text-primary dark:text-dark-text">{{ __('Создайте аккаунт') }}</h2>
                <p class="text-sm text-text-secondary dark:text-dark-text-muted mt-1">{{ __('Начните свою историю сегодня') }}</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Имя')" class="text-sm font-medium" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg-card text-text-primary dark:text-dark-text focus:ring-luna-primary focus:border-luna-primary py-2.5 px-4 rounded-xl transition-colors" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Ваше имя') }}" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-sm font-medium" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg-card text-text-primary dark:text-dark-text focus:ring-luna-primary focus:border-luna-primary py-2.5 px-4 rounded-xl transition-colors" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Пароль')" class="text-sm font-medium" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg-card text-text-primary dark:text-dark-text focus:ring-luna-primary focus:border-luna-primary py-2.5 px-4 rounded-xl transition-colors" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Подтвердите пароль')" class="text-sm font-medium" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg-card text-text-primary dark:text-dark-text focus:ring-luna-primary focus:border-luna-primary py-2.5 px-4 rounded-xl transition-colors" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <x-primary-button class="w-full py-3 text-base">
                    {{ __('Зарегистрироваться') }}
                </x-primary-button>
            </form>

            <p class="mt-6 text-center text-sm text-text-secondary dark:text-dark-text-muted">
                {{ __('Уже есть аккаунт?') }}
                <a href="{{ route('login') }}" class="font-semibold text-luna-primary hover:text-luna-accent transition-colors">
                    {{ __('Войти') }}
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
