const path = require('path');


module.exports = {
    plugins: [
        require('unplugin-element-plus/webpack')({}),
    ],
    resolve: {
        alias: {
            '@' : path.resolve('resources/js'),
            '@resources': path.resolve(__dirname, 'resources/'),
            '@core': path.resolve(__dirname, 'resources/js/@core'),
            '@modules': path.resolve(__dirname, 'resources/js/Pages/Modules'),
        }
    },
}
