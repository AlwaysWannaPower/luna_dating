<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="text-2xl font-bold text-text-primary dark:text-dark-text-primary leading-tight">
                {{ __('Анкеты') }}
            </h2>
            <p class="text-sm text-text-secondary dark:text-dark-text-secondary">
                {{ __('Найди свою вторую половинку') }}
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Фильтры -->
            <div class="bg-bg-card dark:bg-dark-bg-card rounded-2xl border border-border dark:border-dark-border p-5 shadow-sm">
                <form method="GET" action="{{ route('discover') }}" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <!-- Поиск -->
                        <div>
                            <label class="block text-sm font-medium text-text-secondary dark:text-dark-text-secondary mb-1.5">{{ __('Поиск') }}</label>
                            <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" 
                                placeholder="{{ __('Имя или город') }}"
                                class="w-full rounded-xl border-border dark:border-dark-border bg-bg-input dark:bg-dark-bg-input text-text-primary dark:text-dark-text-primary focus:border-luna-primary focus:ring-luna-primary text-sm transition-colors px-3 py-2.5 outline-none">
                        </div>

                        <!-- Пол -->
                        <div>
                            <label class="block text-sm font-medium text-text-secondary dark:text-dark-text-secondary mb-1.5">{{ __('Пол') }}</label>
                            <select name="gender" class="w-full rounded-xl border-border dark:border-dark-border bg-bg-input dark:bg-dark-bg-input text-text-primary dark:text-dark-text-primary focus:border-luna-primary focus:ring-luna-primary text-sm transition-colors px-3 py-2.5 outline-none">
                                <option value="">{{ __('Все') }}</option>
                                <option value="female" {{ ($filters['gender'] ?? '') === 'female' ? 'selected' : '' }}>Женщины</option>
                                <option value="male" {{ ($filters['gender'] ?? '') === 'male' ? 'selected' : '' }}>Мужчины</option>
                            </select>
                        </div>

                        <!-- Город -->
                        <div>
                            <label class="block text-sm font-medium text-text-secondary dark:text-dark-text-secondary mb-1.5">{{ __('Город') }}</label>
                            <input type="text" name="city" value="{{ $filters['city'] ?? '' }}" 
                                placeholder="{{ __('Город') }}"
                                class="w-full rounded-xl border-border dark:border-dark-border bg-bg-input dark:bg-dark-bg-input text-text-primary dark:text-dark-text-primary focus:border-luna-primary focus:ring-luna-primary text-sm transition-colors px-3 py-2.5 outline-none">
                        </div>

                        <!-- Мин. возраст -->
                        <div>
                            <label class="block text-sm font-medium text-text-secondary dark:text-dark-text-secondary mb-1.5">{{ __('От лет') }}</label>
                            <input type="number" name="min_age" value="{{ $filters['min_age'] ?? '' }}" min="18" max="100"
                                class="w-full rounded-xl border-border dark:border-dark-border bg-bg-input dark:bg-dark-bg-input text-text-primary dark:text-dark-text-primary focus:border-luna-primary focus:ring-luna-primary text-sm transition-colors px-3 py-2.5 outline-none">
                        </div>

                        <!-- Макс. возраст -->
                        <div>
                            <label class="block text-sm font-medium text-text-secondary dark:text-dark-text-secondary mb-1.5">{{ __('До лет') }}</label>
                            <input type="number" name="max_age" value="{{ $filters['max_age'] ?? '' }}" min="18" max="100"
                                class="w-full rounded-xl border-border dark:border-dark-border bg-bg-input dark:bg-dark-bg-input text-text-primary dark:text-dark-text-primary focus:border-luna-primary focus:ring-luna-primary text-sm transition-colors px-3 py-2.5 outline-none">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <a href="{{ route('discover') }}" 
                            class="px-4 py-2.5 rounded-xl text-sm font-medium text-text-secondary hover:text-text-primary hover:bg-bg-hover dark:hover:bg-dark-bg-hover transition-colors">
                            {{ __('Сбросить') }}
                        </a>
                        <button type="submit" 
                            class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-luna-primary to-luna-accent hover:shadow-lg hover:shadow-luna-primary/20 transition-all duration-200">
                            {{ __('Применить') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Сетка карточек -->
            @if($users->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($users as $user)
                        <div class="group bg-bg-card dark:bg-dark-bg-card rounded-2xl border border-border dark:border-dark-border overflow-hidden hover:border-luna-primary/40 dark:hover:border-luna-primary/40 shadow-sm hover:shadow-lg hover:shadow-luna-primary/10 transition-all duration-300 hover:-translate-y-1">
                            
                            <!-- Аватар -->
                            <div class="relative h-56 overflow-hidden bg-gray-100 dark:bg-gray-800">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-luna-primary/10 to-luna-accent/10 dark:from-luna-primary/20 dark:to-luna-accent/20">
                                        <span class="text-5xl font-bold text-luna-primary/30">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                                
                                <!-- Оверлей с возрастом -->
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4 pt-12">
                                    <div class="flex items-center gap-2">
                                        <span class="text-white font-semibold text-lg">{{ $user->name }}</span>
                                        @if($user->age)
                                            <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded-full">{{ $user->age }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Инфо -->
                            <div class="p-4 space-y-3">
                                @if($user->city)
                                    <div class="flex items-center gap-2 text-sm text-text-secondary dark:text-dark-text-secondary">
                                        <svg class="w-4 h-4 shrink-0 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span>{{ $user->city }}</span>
                                    </div>
                                @endif

                                @if($user->bio)
                                    <p class="text-sm text-text-secondary dark:text-dark-text-secondary line-clamp-2">{{ Str::limit($user->bio, 80) }}</p>
                                @endif

                                <!-- Кнопка лайка -->
                                <form action="{{ route('likes.store', $user) }}" method="POST">
                                    @csrf
                                    @if(auth()->user()->hasLiked($user))
                                        <button type="submit" 
                                            class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-semibold text-red-500 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 hover:bg-red-100 dark:hover:bg-red-500/20 transition-all">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                            </svg>
                                            <span>{{ __('Нравится') }}</span>
                                        </button>
                                    @else
                                        <button type="submit" 
                                            class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-luna-primary to-luna-accent hover:shadow-md hover:shadow-luna-primary/20 transition-all">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                            </svg>
                                            <span>{{ __('Нравится') }}</span>
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Пагинация -->
                <div class="flex justify-center mt-8">
                    {{ $users->links() }}
                </div>
            @else
                <!-- Пустое состояние -->
                <div class="flex flex-col items-center justify-center py-20">
                    <div class="w-20 h-20 rounded-full bg-bg-tertiary dark:bg-dark-bg-hover flex items-center justify-center mb-5">
                        <svg class="w-10 h-10 text-text-secondary/30 dark:text-dark-text-secondary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-text-primary dark:text-dark-text-primary mb-1">
                        {{ __('Анкеты не найдены') }}
                    </h3>
                    <p class="text-sm text-text-secondary dark:text-dark-text-secondary mb-5">
                        {{ __('Попробуйте изменить параметры поиска') }}
                    </p>
                    <a href="{{ route('discover') }}" 
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-luna-primary to-luna-accent hover:shadow-lg hover:shadow-luna-primary/20 transition-all">
                        {{ __('Сбросить фильтры') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
