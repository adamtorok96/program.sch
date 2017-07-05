const mix = require('laravel-mix');

mix
    .sass('resources/assets/sass/app.scss', 'public/css')
    .js('resources/assets/js/app.js', 'public/js')
    .version();

const fonts = [
    'node_modules/bootstrap-sass/assets/fonts/bootstrap',
    'node_modules/font-awesome/fonts',
    'node_modules/roboto-fontface/fonts/Roboto'
];

fonts.forEach(function (font) {
    mix.copy(font, 'public/fonts')
});

const files = [
    'public/css',
    'public/js',
    'public/fonts',
    'public/mix-manifest.json'
];