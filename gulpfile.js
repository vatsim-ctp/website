const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.copy('resources/assets/images', 'public/assets/images/');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/', 'public/build/fonts/bootstrap');
    mix.copy('node_modules/font-awesome/fonts/', 'public/fonts');

    mix.sass('site.scss')
        .browserify(['global.js', 'site.js'], "public/assets/js/site.js");

    mix.sass('admin.scss')
        .browserify(['global.js', 'admin.js'], "public/assets/js/admin.js");

    mix.version(['css/site.css', 'js/site.js', 'css/admin.css', 'js/admin.js']);
});
