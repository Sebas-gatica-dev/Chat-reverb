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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require('tailwind-scrollbar')({ nocompatible: true })],
    safelist: [
        'bg-red-500', // Clase de fondo rojo
        'text-center', // Clase de texto centrado
        'px-4', // Clase de padding horizontal
        'max-w-7xl',
         'max-w-6xl',  
         'max-w-5xl', 
         'max-w-4xl'
        // Agrega todas las clases que necesites aquí
      ],
};
