<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-text-primary dark:text-dark-text">
            {{ __('Профиль') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Information -->
            <div class="p-6 bg-bg-primary dark:bg-dark-bg-card shadow-sm border border-border dark:border-dark-border sm:rounded-2xl">
                <div class="flex items-center gap-4 mb-6 pb-4 border-b border-border dark:border-dark-border">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-luna-primary to-luna-accent flex items-center justify-center text-white text-2xl font-bold shadow-lg shadow-luna-primary/20">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-text-primary dark:text-dark-text">{{ Auth::user()->name }}</h3>
                        <p class="text-sm text-text-secondary dark:text-dark-text-muted">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-6 bg-bg-primary dark:bg-dark-bg-card shadow-sm border border-border dark:border-dark-border sm:rounded-2xl">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-border dark:border-dark-border">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-text-primary dark:text-dark-text">{{ __('Обновить пароль') }}</h3>
                        <p class="text-xs text-text-secondary dark:text-dark-text-muted">{{ __('Используйте длинный случайный пароль для безопасности.') }}</p>
                    </div>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-6 bg-bg-primary dark:bg-dark-bg-card shadow-sm border border-red-200 dark:border-red-900/50 sm:rounded-2xl">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-red-200 dark:border-red-900/50">
                    <div class="w-10 h-10 rounded-xl bg-red-50 dark:bg-red-900/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-red-600 dark:text-red-400">{{ __('Удалить аккаунт') }}</h3>
                        <p class="text-xs text-text-secondary dark:text-dark-text-muted">{{ __('После удаления аккаунта все данные будут удалены навсегда.') }}</p>
                    </div>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
