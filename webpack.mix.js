/*
 * Gridly uses Laravel Mix
 *
 * Check the documentation at
 * https://laravel.com/docs/7.x/mix
 */

let mix = require('laravel-mix');

// Autloading jQuery to make it accessible to all the packages
mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
});

// Compile assets
mix.sass('assets/src/sass/styles.scss', 'assets/css')
   .sass('inc/Admin/react/sass/dashboard.scss', 'assets/css')
   .react('inc/Admin/react/src/dashboard.js', 'assets/js')

mix.disableNotifications();