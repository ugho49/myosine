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
        'bootstrap/dist/css/bootstrap.min.css',
        'bootstrap-material-design/dist/css/bootstrap-material-design.min.css',
        'bootstrap-material-design/dist/css/ripples.min.css',
        'fotorama/fotorama.css'
    ],
    'public/css/vendor.css', 'resources/assets/components');

    mix.styles([
            'dropzone/dist/min/basic.min.css',
            'dropzone/dist/min/dropzone.min.css',
            'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
        ],
        'public/css/vendor_admin.css', 'resources/assets/components');

    mix.stylesIn('resources/assets/styles'); // generate all.css

    // copy font for bootstrap
    mix.copy('resources/assets/components/bootstrap/fonts', 'public/build/fonts');
    // copy images for fotorama
    mix.copy('resources/assets/components/fotorama/fotorama.png', 'public/build/css/fotorama.png');
    mix.copy('resources/assets/components/fotorama/fotorama@2x.png', 'public/build/css/fotorama@2x.png');

    mix.scripts([
        'jquery/dist/jquery.min.js',
        'bootstrap/dist/js/bootstrap.min.js',
        'bootstrap-material-design/dist/js/material.min.js',
        'bootstrap-material-design/dist/js/ripples.min.js',
        'fotorama/fotorama.js'
    ],
    'public/js/vendor.js', 'resources/assets/components');

    mix.scripts([
            'moment/min/moment.min.js',
            'moment/locale/fr.js',
            'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            'bootbox.js/bootbox.js',
            'dropzone/dist/min/dropzone.min.js',
        ],
        'public/js/vendor_admin.js', 'resources/assets/components');

    mix.scriptsIn('resources/assets/scripts'); // generate all.js

    mix.version([
        'css/vendor.css',
        'css/vendor_admin.css',
        'css/all.css',
        'js/vendor.js',
        'js/vendor_admin.js',
        'js/all.js'
    ]);
});
