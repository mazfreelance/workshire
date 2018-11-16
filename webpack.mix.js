//let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
 */
 
const webpack = require('webpack');
let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Custom Mix setup
 |--------------------------------------------------------------------------
 |
 */

mix.webpackConfig({

  plugins: [
    new webpack.ContextReplacementPlugin(
      /moment[\/\\]locale/,
      // A regular expression matching files that should be included
      /(en-gb)\.js/
    )
  ]
});

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
    'node_modules/bootstrap/dist/css/bootstrap.min.css', 
    'node_modules/gijgo/css/gijgo.min.css', 
    'node_modules/bootstrap4c-chosen/dist/css/component-chosen.min.css'
], 'public/css/app.css');

/*
mix.js([  
 	'node_modules/jquery/dist/jquery.min.js', 
 	'node_modules/bootstrap/dist/js/bootstrap.js',
  'node_modules/bootstrap/dist/js/bootstrap.min.js',
  'node_modules/vue/dist/vue.min.js', 
 	'resources/assets/js/app.js',
  'node_modules/gijgo/js/gijgo.min.js' 
], 'public/js/app.js')
.sass('resources/assets/sass/app.scss', 'public/css/app.css'); 
*/
mix
    .sass('resources/assets/sass/app.scss', 'public/css/app.css')
    .sass('resources/assets/sass/custom.scss', 'public/css/custom.css')
    .js([  
      'node_modules/jquery/dist/jquery.min.js', 
      'node_modules/bootstrap/dist/js/bootstrap.js',
      'node_modules/bootstrap/dist/js/bootstrap.min.js',
      'node_modules/vue/dist/vue.min.js', 
      'resources/assets/js/app.js',
      'node_modules/gijgo/js/gijgo.min.js' 
    ], 'public/js/app.js')
    .version();


mix.styles([
  'node_modules/gijgo/css/gijgo.css',
  'node_modules/@fortawesome/fontawesome-free/css/all.css',
], 'public/fonts/font.css'); 

mix.copy([
  'node_modules/gijgo/fonts'
], 'public/fonts');

mix.copy([
  'node_modules/@fortawesome/fontawesome-free/webfonts'
], 'public/webfonts');
 


 