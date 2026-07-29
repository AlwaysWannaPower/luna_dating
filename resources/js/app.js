import Alpine from 'alpinejs';

Alpine.data('theme', () => ({
    dark: false,
    init() {
        const saved = localStorage.getItem('theme');
        if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            this.dark = true;
            document.documentElement.classList.add('dark');
        } else {
            this.dark = false;
            document.documentElement.classList.remove('dark');
        }
    },
    toggle() {
        this.dark = !this.dark;
        document.documentElement.classList.toggle('dark', this.dark);
        localStorage.setItem('theme', this.dark ? 'dark' : 'light');
    },
}));

Alpine.data('dropdown', () => ({
    open: false,
    toggle() { this.open = !this.open; },
    close() { this.open = false; },
}));

window.Alpine = Alpine;
Alpine.start();
