<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="text-2xl font-bold text-text-primary dark:text-dark-text-primary leading-tight">
                {{ __('Мои лайки') }}
            </h2>
            <p class="text-sm text-text-secondary dark:text-dark-text-secondary">
                {{ __('Люди, которым вы понравьтесь') }}
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if($likes->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($likes as $like)
                        @php $user = $like->toUser; @endphp
                        
                        <div class="group bg-bg-card dark:bg-dark-bg-card rounded-2xl border border-border dark:border-dark-border overflow-hidden shadow-sm transition-all duration-300 hover:-translate-y-1">
                            
                            <!-- Аватар -->
                            <div class="relative h-56 overflow-hidden bg-gray-100 dark:bg-gray-800">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-luna-primary/10 to-luna-accent/10 dark:from-luna-primary/20 dark:to-luna-accent/20">
                                        <span class="text-5xl font-bold text-luna-primary/60">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                @endif

                                <!-- Дата лайка -->
                                <div class="absolute top-3 right-3 bg-black/40 backdrop-blur-sm text-white text-xs px-2.5 py-1 rounded-full">
                                    {{ $like->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <!-- Инфо -->
                            <div class="p-4 space-y-3">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-semibold text-text-primary dark:text-dark-text-primary">{{ $user->name }}</h3>
                                    @if($user->age)
                                        <span class="bg-luna-primary/10 text-luna-primary text-xs font-medium px-2.5 py-1 rounded-full">{{ $user->age }}</span>
                                    @endif
                                </div>

                                @if($user->city)
                                    <div class="flex items-center gap-2 text-sm text-text-secondary dark:text-dark-text-secondary">
                                        <svg class="w-4 h-4 shrink-0 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span>{{ $user->city }}</span>
                                    </div>
                                @endif

                                <!-- Кнопка убрать лайк -->
                                <form action="{{ route('likes.destroy', $like) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-semibold text-red-500 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 hover:bg-red-100 dark:hover:bg-red-500/20 transition-all">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        <span>{{ __('Убрать лайк') }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Пагинация -->
                <div class="flex justify-center mt-8">
                    {{ $likes->links() }}
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
                        {{ __('Вы ещё не ставили лайки') }}
                    </h3>
                    <p class="text-sm text-text-secondary dark:text-dark-text-secondary mb-5">
                        {{ __('Начните просматривать анкеты и ставить ❤️') }}
                    </p>
                    <a href="{{ route('discover') }}" 
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-luna-primary to-luna-accent hover:shadow-lg hover:shadow-luna-primary/20 transition-all">
                        {{ __('Просмотреть анкеты') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
