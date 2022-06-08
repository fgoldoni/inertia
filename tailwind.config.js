const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                primary: colors.indigo,
                secondary: colors.slate,
                yellow: colors.yellow,
                gray: colors.slate,
                orange: colors.orange,
                positive: colors.emerald,
                warning: colors.amber,
                negative: colors.red,
                info: colors.sky,
            },

            transitionProperty: {
                'height': 'height',
                'spacing': 'margin, padding',
            },

            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/aspect-ratio'), require('@tailwindcss/typography')],
};
