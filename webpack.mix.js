let mix = require('laravel-mix');

mix.setPublicPath('public');

mix.setResourceRoot('../');

// mix.sass('src/css/style.scss', 'public/css/styles.css');

mix.js('src/js/wp_ninja_recipe.js', 'public/js/wp_ninja_recipe.js');