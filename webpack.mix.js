const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix
//     .sass('resources/sass/app.scss', 'public/css')
//     .js('resources/js/app.js', 'public/js/app.js')
//     .version();

mix
    .copy('resources/webstack/assets/css', 'public/assets/webstack/css')
    .copy('resources/webstack/assets/images', 'public/assets/webstack/images')
    .copy('resources/webstack/assets/js', 'public/assets/webstack/js');


