<footer class="bg-bg-primary dark:bg-dark-bg-card border-t border-border dark:border-dark-border mt-auto transition-colors duration-300">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-luna-primary to-luna-accent flex items-center justify-center shadow-md shadow-luna-primary/20">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <span class="text-lg font-bold bg-gradient-to-r from-luna-primary to-luna-accent bg-clip-text text-transparent">Luna</span>
            </div>

            <!-- Links -->
            <div class="flex items-center gap-6 text-sm text-text-secondary dark:text-dark-text-muted">
                <a href="#" class="hover:text-luna-primary dark:hover:text-luna-accent transition-colors">{{ __('Правила') }}</a>
                <a href="#" class="hover:text-luna-primary dark:hover:text-luna-accent transition-colors">{{ __('Поддержка') }}</a>
                <a href="#" class="hover:text-luna-primary dark:hover:text-luna-accent transition-colors">{{ __('Конфиденциальность') }}</a>
            </div>

            <!-- Copyright -->
            <p class="text-xs text-text-muted dark:text-dark-text-muted">
                © {{ date('Y') }} Luna. Все права защищены.
            </p>
        </div>
    </div>
</footer>
