const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    important: true,
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                garamond: ['"EB Garamond"', 'serif'],
                nunito: ['Nunito', 'sans-serif'],
            },

            colors: {
                spotify: {
                    DEFAULT: '#01D260',
                }  ,
            },
            transitionProperty: {
                'height': 'height',
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
