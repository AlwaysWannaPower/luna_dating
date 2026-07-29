<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold leading-tight text-text-primary dark:text-dark-text">
                {{ __('Профиль') }}
            </h2>
        </div>
    </x-slot>

    <!-- Profile Card -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-bg-primary dark:bg-dark-bg-card overflow-hidden shadow-sm border border-border dark:border-dark-border rounded-2xl">
                <div class="p-12">
                    @php
                        $user = auth()->user();
                    @endphp
                    
                    <!-- Avatar -->
                    <div class="flex flex-col items-center mb-8">
                        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-luna-primary to-luna-accent flex items-center justify-center text-white text-4xl font-bold mb-4 shadow-lg">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h3 class="text-xl font-semibold text-text-primary dark:text-dark-text">{{ $user->name }}</h3>
                        <p class="text-text-secondary dark:text-dark-text-muted">{{ $user->email }}</p>
                    </div>

                    <!-- Profile Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                        <div class="bg-bg-tertiary dark:bg-dark-bg-hover rounded-xl p-4">
                            <span class="text-sm text-text-muted dark:text-dark-text-muted block mb-1">Имя</span>
                            <span class="text-lg font-medium text-text-primary dark:text-dark-text">{{ $user->name ?? '—' }}</span>
                        </div>
                        <div class="bg-bg-tertiary dark:bg-dark-bg-hover rounded-xl p-4">
                            <span class="text-sm text-text-muted dark:text-dark-text-muted block mb-1">Email</span>
                            <span class="text-lg font-medium text-text-primary dark:text-dark-text">{{ $user->email ?? '—' }}</span>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div class="mt-8 text-center">
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-luna-primary to-luna-accent text-white font-semibold rounded-xl shadow-lg shadow-luna-primary/30 hover:shadow-xl hover:shadow-luna-primary/40 transition-all duration-200">
                            Редактировать профиль
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
