const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        // './storage/framework/views/*.php',
        // './resources/**/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],

    theme: {

        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                main: '#6D9987'
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
