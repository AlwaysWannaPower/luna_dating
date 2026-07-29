<a {{ $attributes->merge(['class' => "inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none"])
        :class="$active ? 'border-luna-primary dark:border-luna-accent text-text-primary dark:text-dark-text' : 'border-transparent text-text-secondary hover:text-text-primary hover:border-bg-tertiary dark:hover:text-dark-text dark:hover:border-dark-border-hover'" }}>
    {{ $slot }}
</a>
