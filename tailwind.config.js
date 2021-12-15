const defaultTheme = require('tailwindcss/defaultTheme');

const colors = require('tailwindcss/colors');


module.exports = {
    important: true,
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/components/*.vue',
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
                    DEFAULT: '#FF4C65',
                },
                transparent: 'transparent',
                current: 'currentColor',
                gray: colors.trueGray,
                red: colors.red,
                blue: colors.sky,
                yellow: colors.amber,
            },
            transitionProperty: {
                'height': 'height',
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            visibility: ["group-hover"],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
