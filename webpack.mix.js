const mix = require('laravel-mix');

mix.js('app/assets/js/app.js', 'public/js')
   .styles([
      'node_modules/bootstrap/dist/css/bootstrap.min.css'
   ], 'public/css/app.css');