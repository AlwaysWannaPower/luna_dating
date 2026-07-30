@props(['active', 'href'])

<a {{ $attributes->merge([
        'class' => 'relative inline-flex items-center px-3 pt-2 text-sm font-medium leading-5 transition-colors duration-200 focus:outline-none rounded-lg',
    ]) }}
   href="{{ $href }}"
   class="
       {{ $active 
           ? 'text-luna-primary dark:text-luna-primary bg-luna-primary/10 dark:bg-luna-primary/10' 
           : 'text-text-secondary hover:text-text-primary hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover dark:hover:text-dark-text' 
       }}
   ">
    {{ $slot }}
    @if($active)
        <span class="absolute bottom-0 left-2 right-2 h-[2px] bg-gradient-to-r from-luna-primary to-luna-accent rounded-full"></span>
    @endif
</a>
