const mix = require('laravel-mix');

const styles = [
    'resources/assets/sass/app.scss'
];

const scripts = [
    'resources/assets/js/app.js',
    'resources/assets/js/google-analytic.js',
    'resources/assets/js/laroute.js',
    'resources/assets/js/admin.js'
];

const fonts = [
    'node_modules/bootstrap-sass/assets/fonts/bootstrap',
    'node_modules/font-awesome/fonts',
    'node_modules/roboto-fontface/fonts/Roboto',
    'node_modules/raleway-webfont/fonts'
];

styles.forEach(function (style) {
   mix.sass(style, 'public/css');
});

scripts.forEach(function (script) {
    mix.js(script, 'public/js');
});

fonts.forEach(function (font) {
    mix.copy(font, 'public/fonts')
});

mix.version();