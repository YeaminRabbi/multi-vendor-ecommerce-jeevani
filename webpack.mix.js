const mix = require('laravel-mix');
//mix.js('src/app.js', 'dist').setPublicPath('dist');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);
