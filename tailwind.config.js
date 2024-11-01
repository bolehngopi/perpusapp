import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                libraryBlue: '#1D4ED8', // Customize your colors
            },
            boxShadow: {
                card: '0 10px 15px -3px rgba(0, 0, 0, 0.1)', // Custom shadow for cards
            },
        },
    },
    plugins: [],
};
