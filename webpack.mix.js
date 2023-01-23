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

mix.styles([
    'resources/lib/bootstrap/css/bootstrap.min.css',
    'resources/lib/fontawesome-free/css/all.css',
    'resources/lib/select2/css/select2.min.css',
    'resources/lib/select2/css/select2.min.css',
    'resources/lib/jquery-ui/css/jquery-ui.css',
    'resources/lib/bootstrap-tagsinput/css/bootstrap-tagsinput.css',
], 'public/css/vendors.css');
mix.sass('resources/sass/app.scss', 'public/css');

mix.scripts([
    'resources/lib/jquery/js/jquery.js',
    'resources/lib/bootstrap/js/bootstrap.min.js',
    'resources/lib/jquery-ui/js/jquery-ui.js',
    'resources/lib/select2/js/select2.min.js',
    'resources/lib/notify/js/notify.min.js',
    'resources/lib/bootstrap-tagsinput/js/bootstrap-tagsinput.js',
], 'public/js/vendors.js');
mix.js('resources/js/app.js', 'public/js');

// mix.copyDirectory('resources/lib/fontawesome-free/webfonts', 'public/webfonts');
// if (mix.inProduction()) {
//     mix.version();
// }

//mix.browserSync('http://localhost:8000');


