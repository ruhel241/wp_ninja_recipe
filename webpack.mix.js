let mix = require('laravel-mix');

mix.setPublicPath('public');

mix.setResourceRoot('../');

mix.sass('src/admin/css/style.scss', 'public/css/style.css')
   .sass('src/admin/css/admin.scss', 'public/css/admin.css')
   .js('src/admin/wp_ninja_recipe.js', 'public/js/wp_ninja_recipe.js')
   .js('src/admin/ninja_recipe_user_view.js', 'public/js/ninja_recipe_user_view.js')
   .js('src/user/nutrition_modal.js', 'public/js/nutrition_modal.js');

