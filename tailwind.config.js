const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
const colorSaveList = [];
const extendeColors = {};

for (const key in colors) {
    extendeColors[key] = colors[key];

    [100, 200, 300, 400, 500, 600, 700, 800, 900].forEach(colorValue => {
        colorSaveList.push(`text-${key}-${colorValue}`);
        colorSaveList.push(`bg-${key}-${colorValue}`);
    });
}

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    safelist: colorSaveList,

    theme: {
        extend: {
            colors: {
                primary: colors.teal,
                secondary: colors.slate,
                yellow: colors.yellow,
                gray: colors.slate,
                orange: colors.orange,
                positive: colors.emerald,
                warning: colors.amber,
                negative: colors.rose,
                info: colors.sky,
            },

            transitionProperty: {
                'height': 'height',
                'spacing': 'margin, padding',
            },

            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/typography'),
        require('tailwind-scrollbar')
    ],
};
