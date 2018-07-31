<?php namespace NinjaRecipe\Classes; 

class CPT 
{	
	public static $CPTName = 'ninja_recipe_cpt';

	public static function register()
	{
		$cptArgs = array(
			'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => false,
            'show_in_menu'       => false,
            'query_var'          => false,
            'label'				 => __('WP Ninja Recipe', 'ninja_recipe')
		);
		register_post_type( self::$CPTName, $cptArgs );
	}
	
}





