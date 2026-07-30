<section>
    <header>
        <h2 class="text-lg font-semibold text-text-primary dark:text-dark-text">
            {{ __('Обновить пароль') }}
        </h2>

        <p class="mt-1 text-sm text-text-secondary dark:text-dark-text-muted">
            {{ __("Используйте длинный случайный пароль для безопасности.") }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Текущий пароль')" class="text-sm font-medium" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg-card text-text-primary dark:text-dark-text focus:ring-luna-primary focus:border-luna-primary py-2.5 px-4 rounded-xl transition-colors" autocomplete="current-password" placeholder="{{ __('Введите текущий пароль') }}" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Новый пароль')" class="text-sm font-medium" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg-card text-text-primary dark:text-dark-text focus:ring-luna-primary focus:border-luna-primary py-2.5 px-4 rounded-xl transition-colors" autocomplete="new-password" placeholder="{{ __('Минимум 8 символов') }}" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Подтвердите новый пароль')" class="text-sm font-medium" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg-card text-text-primary dark:text-dark-text focus:ring-luna-primary focus:border-luna-primary py-2.5 px-4 rounded-xl transition-colors" autocomplete="new-password" placeholder="{{ __('Повторите новый пароль') }}" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 font-medium"
                >{{ __('Сохранено.') }}</p>
            @endif
        </div>
    </form>
</section>
