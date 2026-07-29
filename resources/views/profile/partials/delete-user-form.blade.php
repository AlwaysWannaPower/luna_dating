<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-red-600 dark:text-red-400">
            {{ __('Удалить аккаунт') }}
        </h2>

        <p class="mt-1 text-sm text-text-secondary dark:text-dark-text-muted">
            {{ __('После удаления аккаунта все его данные будут удалены навсегда. Перед удалением скачайте данные, которые хотите сохранить.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Удалить аккаунт') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-bg-primary dark:bg-dark-bg-card">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-text-primary dark:text-dark-text">
                {{ __('Вы уверены, что хотите удалить свой аккаунт?') }}
            </h2>

            <p class="mt-1 text-sm text-text-secondary dark:text-dark-text-muted">
                {{ __('После удаления аккаунта все его данные будут удалены навсегда. Введите пароль для подтверждения.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Пароль') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg-card focus:ring-red-500 focus:border-red-500"
                    placeholder="{{ __('Пароль') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Отмена') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Удалить аккаунт') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
