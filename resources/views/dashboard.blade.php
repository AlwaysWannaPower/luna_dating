<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold leading-tight text-text-primary dark:text-dark-text">
                {{ __('Мои совпадения') }}
            </h2>
            <a href="{{ route('discover') }}" 
               class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-luna-primary to-luna-accent text-white font-semibold rounded-xl shadow-lg shadow-luna-primary/30 hover:shadow-xl hover:shadow-luna-primary/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Найти людей
            </a>
        </div>
    </x-slot>

    <!-- Empty State -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-bg-primary dark:bg-dark-bg-card overflow-hidden shadow-sm border border-border dark:border-dark-border rounded-2xl">
                <div class="p-12 text-center">
                    <!-- Heart Icon -->
                    <div class="mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-luna-primary/10 to-luna-accent/10 dark:from-luna-primary/20 dark:to-luna-accent/20 flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-luna-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-semibold text-text-primary dark:text-dark-text mb-2">
                        Пока нет совпадений
                    </h3>
                    <p class="text-text-secondary dark:text-dark-text-muted max-w-md mx-auto mb-8">
                        Когда кто-то взаимно лайкнет ваш профиль, здесь появится совпадение. Продолжайте просмотр анкет!
                    </p>
                    
                    <a href="{{ route('discover') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-luna-primary to-luna-accent text-white font-semibold rounded-xl shadow-lg shadow-luna-primary/30 hover:shadow-xl hover:shadow-luna-primary/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Начать поиск
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
