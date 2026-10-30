import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                pivot: {
                    bg: '#F8F9FF',
                    card: '#EFF4FF',
                    ink: '#0D1C2F',
                    muted: '#44474D',
                    link: '#006493',
                    accent: '#36B5FD',
                    line: '#D5E3FD',
                    dark: '#0D1C32',
                    error: '#BA1A1A',
                },
            },
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};