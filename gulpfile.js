var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.styles([
        'animate.css',
        'bootstrap.min.css',
        'jquery.bootstrap-touchspin.min.css',
        'font-awesome.min.css',
        'prettyPhoto.css',
        'main.css',
        'responsive.css'
    ],'public/css/all.css');

    mix.scripts([
        'bootstrap.min.js',
        'jquery.bootstrap-touchspin.min.js',
        'jquery.js',
        'jquery.scrollUp.min.js',
        'price-range.js',
        'jquery.prettyPhoto.js',
        'main.js'
    ],'public/js/all.js')

    mix.version(['css/all.css','js/all.js']);

    mix.copy('resources/assets/fonts','public/build/fonts');

});
