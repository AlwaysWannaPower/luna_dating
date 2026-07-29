<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold leading-tight text-text-primary dark:text-dark-text">
                {{ __('Найти людей') }}
            </h2>
        </div>
    </x-slot>

    <!-- Empty State -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-bg-primary dark:bg-dark-bg-card overflow-hidden shadow-sm border border-border dark:border-dark-border rounded-2xl">
                <div class="p-12 text-center">
                    <!-- Search Icon -->
                    <div class="mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-luna-primary/10 to-luna-accent/10 dark:from-luna-primary/20 dark:to-luna-accent/20 flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-luna-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-semibold text-text-primary dark:text-dark-text mb-2">
                        Пока нет анкет для просмотра
                    </h3>
                    <p class="text-text-secondary dark:text-dark-text-muted max-w-md mx-auto">
                        Настройте фильтры поиска или продолжайте заполнять свой профиль — так вам будет проще найти интересных людей рядом.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
