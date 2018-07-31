<?php namespace NinjaRecipe\Classes;


class RecipeHandler
{
	
	public static function handleAjaxCalls()
	{
		$route = sanitize_text_field($_REQUEST['route'] );

		if( $route == 'add_table' ){
			$tableTitle = sanitize_text_field($_REQUEST['post_title']);
			$recipeType = sanitize_text_field($_REQUEST['recipe_type']);
			static::addTable($tableTitle, $recipeType);
		}
		
	}


	public static function addTable($tableTitle, $recipeType)
	{	
		
		if( ! $tableTitle ){
			wp_send_json_error(array(
				'message' => __("Please Provide Table Title", "ninja_recipe")
			), 423);
		}

		if( ! $recipeType ){
			wp_send_json_error(array(
				'message' => __("Please Select Recipe Type", 'ninja_recipe')
			), 423);
		}

		$tableData = array(
			'post_title'   => $tableTitle,
			'post_content' => $recipeType,
			'post_type'	   => CPT::$CPTName,
			'post_status'  => 'publish'
		);

		$tableId = wp_insert_post($tableData);

		do_action('ninja_recipe_added_new_table', $tableId); 

		if(is_wp_error($tableId)){
			wp_send_json_error(array(
				'message' => $tableId->get_error_message()
			), 423);
		}

		 wp_send_json_success(array(
            'message'  => __('Table Successfully created','ninja_recipe'),
            'table_id' => $tableId
        ), 200);

	}



}




