const mix = require('laravel-mix');
const gulp = require('gulp');
const scp = require('gulp-scp2');

mix
    .sass('resources/assets/sass/app.scss', 'public/css')
    .js('resources/assets/js/app.js', 'public/js')
    .copy('node_modules/font-awesome/fonts', 'public/fonts')
    .version();