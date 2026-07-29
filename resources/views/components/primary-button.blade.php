<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center px-6 py-3 border border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-luna-primary to-luna-accent shadow-lg shadow-luna-primary/30 hover:shadow-xl hover:shadow-luna-primary/40 focus:outline-none focus:ring-2 focus:ring-luna-primary focus:ring-offset-2 dark:focus:ring-offset-dark-bg active:scale-[0.98] transition-all duration-200"]) }}>
    {{ $slot }}
</button>
