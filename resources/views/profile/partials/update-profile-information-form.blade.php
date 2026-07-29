<section>
    <header>
        <h2 class="text-lg font-semibold text-text-primary dark:text-dark-text">
            {{ __('Информация профиля') }}
        </h2>

        <p class="mt-1 text-sm text-text-secondary dark:text-dark-text-muted">
            {{ __("Обновите информацию вашего аккаунта и email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Имя')" class="text-sm font-medium" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="Ваше имя" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-medium" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" placeholder="you@example.com" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 rounded-xl bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-200 dark:border-yellow-800/30">
                    <p class="text-sm text-yellow-700 dark:text-yellow-300">
                        {{ __('Адрес электронной почты не подтверждён.') }}

                        <button form="send-verification" class="underline text-sm text-luna-primary hover:underline focus:outline-none transition-colors duration-200">
                            {{ __('Нажмите здесь, чтобы отправить письмо повторно.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Новое письмо подтверждения отправлено на ваш адрес.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
