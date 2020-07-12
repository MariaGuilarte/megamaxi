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
    'resources/assets/css/ag-grid.css',
    'resources/assets/css/ag-theme-material.css',
    'resources/assets/css/aggrid.css',
    'resources/assets/css/app-users.css',
    'resources/assets/css/bootstrap-extended.css',
    'resources/assets/css/bootstrap.css',
    'resources/assets/css/colors.css',
    'resources/assets/css/components.css',
    'resources/assets/css/dark-layout.css',
    'resources/assets/css/palette-gradient.css'
    
], 'public/css/estilos.css')
.scripts([
    
    'resources/assets/js/sweetalert2.all.js'
    
], 'public/js/plantilla.js')
.js(['resources/js/app.js'],'public/js/app.js');

