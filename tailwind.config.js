import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import flowbite from 'flowbite/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // 'neutral-primary-soft': 'F9FAFB',
                'neutral-primary-soft': '#0B0F19',
                // 'heading': '111827',
                'heading': '#F9FAFB',
                // 'body': '4B5563',
                'body': '#9CA3AF',
                // 'neutral-tertiary': 'F3F4F6',
                'neutral-tertiary': '#1F2937',
                // 'fg-brand': '1A56DB',
                'fg-brand': '#3B82F6',
            },
            borderRadius: {
                'base': '0.5rem',
            }
        },
    },

    plugins: [
        forms,
        flowbite,
    ],
};
