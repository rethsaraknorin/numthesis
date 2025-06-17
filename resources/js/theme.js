// This file defines a global Alpine.js store for theme management.
document.addEventListener('alpine:init', () => {
    Alpine.store('theme', {
        // Set the initial value from localStorage or system preference
        isDarkMode: localStorage.getItem('theme') === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),

        // The function to toggle the theme
        toggle() {
            this.isDarkMode = !this.isDarkMode;
            localStorage.setItem('theme', this.isDarkMode ? 'dark' : 'light');
        }
    })
})
