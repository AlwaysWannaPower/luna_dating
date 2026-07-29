@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination') }}" class="flex items-center justify-center gap-1 mt-8 px-4">

        {{-- Previous Page Link (Mobile-only compact) --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
               class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-text-primary dark:text-dark-text-primary bg-bg-card dark:bg-dark-bg-card border border-border dark:border-dark-border rounded-xl hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover transition-colors duration-200"
               aria-label="{{ __('Previous') }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="inline-flex items-center justify-center w-9 h-9 text-sm text-text-secondary/50 dark:text-dark-text-secondary/50 bg-bg-tertiary/30 dark:bg-dark-bg-hover/50 rounded-xl cursor-default select-none">
                    ···
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page">
                            <span class="inline-flex items-center justify-center w-9 h-9 text-sm font-semibold text-white bg-gradient-to-br from-luna-primary to-luna-accent rounded-xl shadow-sm">
                                {{ $page }}
                            </span>
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-text-primary dark:text-dark-text-primary bg-bg-card dark:bg-dark-bg-card border border-border dark:border-dark-border rounded-xl hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover hover:border-luna-primary/30 dark:hover:border-luna-primary/30 transition-colors duration-200"
                           aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link (Mobile-only compact) --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
               class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-text-primary dark:text-dark-text-primary bg-bg-card dark:bg-dark-bg-card border border-border dark:border-dark-border rounded-xl hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover transition-colors duration-200"
               aria-label="{{ __('Next') }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @endif

    </nav>
@endif
