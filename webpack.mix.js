const mix = require('laravel-mix');

mix
  .sass('app/assets/scss/main.scss', 'public/css')
  // .sass('app/assets/scss/editor.scss', 'public/css')
  .copy('app/assets/css/*', 'public/css')
  // .js('app/assets/js/main.js', 'public/js')
  // .copy('app/assets/fonts/*', 'public/fonts')
  // .copy('app/assets/ico/*', 'public')
  // .copy('app/assets/img/*', 'public/img');
