<x-app-layout>
    <div class="py-6 sm:py-10">
        <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Header -->
            <div class="text-center space-y-1">
                <h2 class="text-2xl font-bold text-text-primary dark:text-dark-text-primary">
                    {{ __('Открой кого-то нового') }}
                </h2>
                <p class="text-sm text-text-secondary dark:text-dark-text-muted">
                    {{ __('Лайкни или пропусти — следующий уже рядом') }}
                </p>
            </div>

            <!-- Card Container -->
            <div x-data="swipeCard()" x-init="loadNextCard()" class="relative">

                <!-- Empty State -->
                <div x-show="!card && !loading"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="aspect-[3/4] rounded-3xl bg-bg-card dark:bg-dark-bg-card border border-border dark:border-dark-border flex flex-col items-center justify-center p-8 text-center">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-luna-primary/10 to-luna-accent/10 dark:from-luna-primary/20 dark:to-luna-accent/20 flex items-center justify-center mb-5">
                        <svg class="w-10 h-10 text-luna-primary/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-text-primary dark:text-dark-text-primary mb-2">
                        {{ __('Пока никого не нашли') }}
                    </h3>
                    <p class="text-sm text-text-secondary dark:text-dark-text-muted max-w-xs">
                        {{ __('Попробуй изменить предпочтения в профиле') }}
                    </p>
                    <a href="{{ route('profile.edit') }}"
                       class="mt-6 px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-luna-primary to-luna-accent hover:shadow-lg hover:shadow-luna-primary/20 transition-all">
                        {{ __('Редактировать профиль') }}
                    </a>
                </div>

                <!-- Loading & Swipe Card (mutually exclusive via card state) -->
                <div x-show="card"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 -translate-y-4"
                     class="relative aspect-[3/4] rounded-3xl bg-bg-card dark:bg-dark-bg-card border border-border dark:border-dark-border shadow-xl overflow-hidden">

                    <!-- Avatar / Photo -->
                    <div class="absolute inset-0">
                        <template x-if="card.avatar">
                            <img :src="card.avatar" :alt="card.name"
                                 class="w-full h-full object-cover"
                                 x-on:error="console.error('Image load error:', $event)"
                                 x-on:load="$refs.container.classList.remove('animate-pulse')">
                        </template>
                        <template x-if="!card.avatar">
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-luna-primary/10 to-luna-accent/10 dark:from-luna-primary/20 dark:to-luna-accent/20">
                                <span class="text-8xl font-bold text-luna-primary/60" x-text="card.name.charAt(0).toUpperCase()"></span>
                            </div>
                        </template>

                        <!-- Gradient overlay at bottom for text readability -->
                        <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    </div>

                    <!-- Card Info Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 pb-28 text-white">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-3xl font-bold" x-text="card.name"></h3>
                            <span class="bg-white/20 backdrop-blur-sm text-white text-lg font-medium px-3 py-1 rounded-full" x-text="card.age + ' ' + ageLabel"></span>
                        </div>

                        <template x-if="card.city">
                            <div class="flex items-center gap-2 text-white/90 mb-3">
                                <svg class="w-4 h-4 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-base" x-text="card.city"></span>
                            </div>
                        </template>

                        <template x-if="card.bio">
                            <div class="mt-2 pt-3 border-t border-white/20">
                                <p class="text-sm text-white/90 line-clamp-3 leading-relaxed" x-text="card.bio"></p>
                            </div>
                        </template>
                    </div>

                    <!-- Action Buttons (fixed at bottom) -->
                    <div class="absolute bottom-6 left-0 right-0 flex justify-center items-center gap-6 px-8">
                        <!-- Skip Button -->
                        <button @click="skipCard()"
                                x-show="!processing"
                                class="w-16 h-16 rounded-full bg-bg-primary dark:bg-dark-bg-card border-2 border-red-200 dark:border-red-800 flex items-center justify-center shadow-lg hover:bg-red-50 dark:hover:bg-red-900/20 hover:border-red-400 hover:scale-110 active:scale-95 transition-all duration-200 group/skip">
                            <svg class="w-8 h-8 text-red-400 group-hover/skip:text-red-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <!-- Like Button -->
                        <button @click="likeCard()"
                                x-show="!processing"
                                class="w-16 h-16 rounded-full bg-gradient-to-br from-luna-primary to-luna-accent border-2 border-luna-primary flex items-center justify-center shadow-lg shadow-luna-primary/30 hover:shadow-xl hover:shadow-luna-primary/40 hover:scale-110 active:scale-95 transition-all duration-200 group/like">
                            <svg class="w-8 h-8 text-white group-hover/like:fill-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Like Indicator Animation -->
                    <div x-show="animating === 'like'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-50 rotate-12"
                         x-transition:enter-end="opacity-100 scale-100 rotate-12"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100 rotate-12"
                         x-transition:leave-end="opacity-0 scale-50 rotate-12"
                         class="absolute top-8 right-8 px-6 py-3 rounded-2xl bg-green-500 text-white font-extrabold text-3xl transform rotate-12 shadow-lg z-10">
                        LIKE ❤️
                    </div>

                    <!-- Skip Indicator Animation -->
                    <div x-show="animating === 'skip'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-50 -rotate-12"
                         x-transition:enter-end="opacity-100 scale-100 -rotate-12"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100 -rotate-12"
                         x-transition:leave-end="opacity-0 scale-50 -rotate-12"
                         class="absolute top-8 left-8 px-6 py-3 rounded-2xl bg-gray-500 text-white font-extrabold text-3xl transform -rotate-12 shadow-lg z-10">
                        NOPE ✕
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
    function swipeCard() {
        return {
            card: null,
            isLoading: false,
            isAnimating: false,
            processing: false,
            animating: null,
            showSkipIndicator: false,
            showLikeIndicator: false,
            ageLabel: "{{ __('лет') }}",

            async loadNextCard() {
                if (this.isLoading || this.isAnimating) return;

                this.isLoading = true;

                try {
                    const response = await fetch('{{ route("discover.next") }}', {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        }
                    });

                    const data = await response.json();
                    this.card = data.data || null;
                } catch (error) {
                    console.error('Error loading card:', error);
                } finally {
                    this.isLoading = false;
                }
            },

            async makeDecision(action) {
                if (!this.card || this.isAnimating || this.processing) return;

                this.processing = true;
                this.isAnimating = true;

                // Set indicator for animation
                if (action === 'like') {
                    this.animating = 'like';
                } else {
                    this.animating = 'skip';
                }

                // Save decision to server
                try {
                    if (action === 'like') {
                        await fetch('{{ route("likes.store", ":userId") }}'.replace(':userId', this.card.id), {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                    } else {
                        await fetch('{{ route("skips.store") }}', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                to_user_id: this.card.id
                            })
                        });
                    }
                } catch (error) {
                    console.error('Error saving decision:', error);
                }

                // Hide indicator and prepare next card
                setTimeout(() => {
                    this.showLikeIndicator = false;
                    this.showSkipIndicator = false;
                    this.card = null; // Force fade out
                    this.animating = null;

                    setTimeout(() => {
                        this.isAnimating = false;
                        this.processing = false;
                        this.loadNextCard();
                    }, 200); // Small delay to allow fade out
                }, 350);
            },

            likeCard() {
                this.makeDecision('like');
            },

            skipCard() {
                this.makeDecision('skip');
            }
        }
    }
    </script>
</x-app-layout>
