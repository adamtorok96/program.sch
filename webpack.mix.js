const mix = require('laravel-mix');

const scripts = [
    'resources/assets/js/app.js'
];

const styles = [
    'resources/assets/sass/app.scss'
];

const fonts = [
    'node_modules/bootstrap-sass/assets/fonts/bootstrap',
    'node_modules/font-awesome/fonts',
    'node_modules/roboto-fontface/fonts/Roboto',
    'node_modules/raleway-webfont/fonts'
];

scripts.forEach(function (script) {
    mix.js(script, 'public/js');
});

styles.forEach(function (style) {
    mix.sass(style, 'public/css');
});

fonts.forEach(function (font) {
    mix.copy(font, 'public/fonts')
});

mix.version();