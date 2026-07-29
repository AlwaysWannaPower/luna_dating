@props(['active', 'href'])

<a {{ $attributes->merge([
        'class' => 'relative inline-flex items-center px-1 pt-1 border-b-2 h-full text-sm font-medium leading-5 transition-colors duration-200 focus:outline-none',
    ]) }}
   class="{{ $active ? 'border-luna-primary text-text-primary dark:text-dark-text' : 'border-transparent text-text-secondary hover:text-text-primary hover:border-bg-tertiary dark:hover:text-dark-text dark:hover:border-dark-border-hover' }}">
    {{ $slot }}
    @if($active)
        <span class="absolute -bottom-[5px] left-0 right-0 h-[2px] bg-gradient-to-r from-luna-primary to-luna-accent rounded-full"></span>
    @endif
</a>
