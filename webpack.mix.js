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
require('vuetifyjs-mix-extension')

mix.js('resources/js/app.js', 'public/js').vuetify('vuetify-loader')
    .sass('resources/sass/app.scss', 'public/css');

    mix.webpackConfig({
        resolve: {
            alias: {
               /// Internal Plugins
               '#': __dirname + '/resources/js',
               '#Components' : __dirname + "/resources/js/components",
               
               /// External Plugins
               '@': __dirname + '/src',
            }
         }
    })
    
    mix.version()