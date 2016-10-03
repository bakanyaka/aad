const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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

elixir(mix => {
    mix.sass('app.scss');
    mix.styles([
        'node_modules/font-awesome/css/font-awesome.css',
        'node_modules/animate.css/animate.css'
    ], 'public/css/vendor.css', './');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/', 'public/fonts');
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');
    mix.webpack('app.js');
});
