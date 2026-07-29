@extends('layouts.guest')

@section('title', __('Знакомства'))

@section('content')
<div class="flex flex-col items-center justify-center px-4 py-12 sm:py-20">
    <!-- Hero Section -->
    <div class="max-w-3xl mx-auto text-center mb-12 animate-fade-in">
        <!-- Decorative floating hearts -->
        <div class="absolute top-20 left-10 opacity-10 dark:opacity-5">
            <svg class="w-8 h-8 text-luna-primary animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </div>
        <div class="absolute top-40 right-16 opacity-10 dark:opacity-5">
            <svg class="w-6 h-6 text-luna-accent animate-pulse" style="animation-delay: 1s;" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </div>
        
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight mb-6">
            <span class="block text-text-primary dark:text-dark-text">Найди свою</span>
            <span class="block bg-gradient-to-r from-luna-primary via-luna-accent to-luna-primary bg-clip-text text-transparent">вторую половинку</span>
        </h1>
        <p class="text-lg sm:text-xl text-text-secondary dark:text-dark-text-muted max-w-2xl mx-auto leading-relaxed">
            Luna — это место, где начинаются настоящие истории.<br class="hidden sm:block">
            Тысячи людей уже нашли друг друга. Может быть, следующим будешь ты?
        </p>
    </div>

    <!-- Feature Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-4xl mb-12">
        <div class="bg-bg-primary dark:bg-dark-bg-card rounded-2xl p-6 shadow-sm border border-border dark:border-dark-border hover:shadow-md hover:border-luna-primary/30 dark:hover:border-luna-primary/30 transition-all duration-300 group">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-luna-primary/10 to-luna-accent/10 dark:from-luna-primary/20 dark:to-luna-accent/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-luna-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold mb-2 text-text-primary dark:text-dark-text">Создай профиль</h3>
            <p class="text-sm text-text-secondary dark:text-dark-text-muted">Расскажи о себе и своих интересах. Фотографии помогут привлечь внимание.</p>
        </div>
        
        <div class="bg-bg-primary dark:bg-dark-bg-card rounded-2xl p-6 shadow-sm border border-border dark:border-dark-border hover:shadow-md hover:border-luna-primary/30 dark:hover:border-luna-primary/30 transition-all duration-300 group">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-luna-primary/10 to-luna-accent/10 dark:from-luna-primary/20 dark:to-luna-accent/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-luna-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold mb-2 text-text-primary dark:text-dark-text">Ищи знакомства</h3>
            <p class="text-sm text-text-secondary dark:text-dark-text-muted">Просматривай анкеты, ставь лайки и находи интересных людей рядом.</p>
        </div>
        
        <div class="bg-bg-primary dark:bg-dark-bg-card rounded-2xl p-6 shadow-sm border border-border dark:border-dark-border hover:shadow-md hover:border-luna-primary/30 dark:hover:border-luna-primary/30 transition-all duration-300 group">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-luna-primary/10 to-luna-accent/10 dark:from-luna-primary/20 dark:to-luna-accent/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-luna-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold mb-2 text-text-primary dark:text-dark-text">Общайся</h3>
            <p class="text-sm text-text-secondary dark:text-dark-text-muted">Начни общение с теми, кто понравился тебе. Взаимные симпатии ведут к чату.</p>
        </div>
    </div>

    <!-- CTA Buttons -->
    <div class="flex flex-col sm:flex-row items-center gap-4">
        @guest
        <a href="{{ route('register') }}" 
           class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-luna-primary to-luna-accent text-white font-semibold rounded-xl shadow-lg shadow-luna-primary/30 hover:shadow-xl hover:shadow-luna-primary/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 text-center">
            Зарегистрироваться
        </a>
        <a href="{{ route('login') }}" 
           class="w-full sm:w-auto px-8 py-3.5 bg-bg-primary dark:bg-dark-bg-card text-text-primary dark:text-dark-text font-semibold rounded-xl border border-border dark:border-dark-border hover:border-luna-primary/50 dark:hover:border-luna-primary/50 hover:shadow-md transition-all duration-200 text-center">
            Войти
        </a>
        @endguest
        
        @auth
        <a href="{{ route('dashboard') }}" 
           class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-luna-primary to-luna-accent text-white font-semibold rounded-xl shadow-lg shadow-luna-primary/30 hover:shadow-xl hover:shadow-luna-primary/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 text-center">
            Перейти в приложение
        </a>
        @endauth
    </div>

    <!-- Stats -->
    <div class="mt-16 pt-8 border-t border-border dark:border-dark-border w-full max-w-3xl">
        <div class="grid grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-2xl sm:text-3xl font-bold text-luna-primary">10K+</div>
                <div class="text-xs sm:text-sm text-text-muted dark:text-dark-text-muted mt-1">Пользователей</div>
            </div>
            <div>
                <div class="text-2xl sm:text-3xl font-bold text-luna-primary">1K+</div>
                <div class="text-xs sm:text-sm text-text-muted dark:text-dark-text-muted mt-1">Пар каждый день</div>
            </div>
            <div>
                <div class="text-2xl sm:text-3xl font-bold text-luna-primary">50+</div>
                <div class="text-xs sm:text-sm text-text-muted dark:text-dark-text-muted mt-1">Городов</div>
            </div>
        </div>
    </div>
</div>
@endsection
