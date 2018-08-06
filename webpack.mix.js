let mix = require('laravel-mix');

mix.setPublicPath('public');

mix.setResourceRoot('../');

// mix.sass('src/css/style.scss', 'public/css/styles.css');

mix.js('src/admin/wp_ninja_recipe.js', 'public/js/wp_ninja_recipe.js');
mix.js('src/admin/ninja_recipe_user_view.js', 'public/js/ninja_recipe_user_view.js');