<?php  namespace NinjaRecipe\Classes; 

class Menu
{

	public static function addAdminMenuPages() 
	{
	 	add_menu_page(
            __( 'WP Ninja Recipe', 'ninja_recipe' ),
            __( 'WP Ninja Recipe', 'ninja_recipe' ),
            static::managePermission(),
            'wp-ninja-recipe.php',
            array( static::class, 'renderRecipe'),
            '',
            6
        );
	}

	public static function managePermission()
	{	
		return apply_filters('ninja_recipe_menu_manager_permission','manage_options');
	}


	public static function renderRecipe()
	{
		wp_enqueue_script('wp_ninja_recipe_js', NINJA_RECIPE_PUBLIC_DIR_URL.'js/wp_ninja_recipe.js', array('jquery'), NINJA_RECIPE_PLUGIN_DIR_VERSION, true);
		include	NINJA_RECIPE_PLUGIN_DIR_PATH.'views/admin_view.php';
	}

}

 

