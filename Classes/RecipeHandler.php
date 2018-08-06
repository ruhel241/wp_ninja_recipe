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

		if ($route == 'get_table') {
            $tableId = intval($_REQUEST['table_id']);
            static::getTable($tableId, 'ajax');
        }


		if( $route == 'get_tables'){
			$pageNumber = intval($_REQUEST['page_number']);
			$perPage 	= intval($_REQUEST['per_page']);


			if ( isset( $_REQUEST['search'] ) && $_REQUEST['search'] ) {
				$search = sanitize_text_field( $_REQUEST['search'] );
			}

			if( isset($_REQUEST['meal_type']) && $_REQUEST['meal_type'] ){
				$meal_type = serialize( strval($_REQUEST['meal_type']) );
			}

			if( isset($_REQUEST['cusine_type']) && $_REQUEST['cusine_type'] ){
				$cusine_type = serialize( strval($_REQUEST['cusine_type']) );
			}

			if( isset($_REQUEST['preference_type']) && $_REQUEST['preference_type'] ){
				$preference_type = serialize( strval($_REQUEST['preference_type']) );
			}


			static::getTables($pageNumber, $perPage, $search, $meal_type, $cusine_type, $preference_type);
		}

        if ($route == 'update_table') {
            $tableId = intval($_REQUEST['table_id']);
            $table_con = wp_unslash($_REQUEST['table_config']);
			$table_config = json_decode(trim(stripslashes($table_con)), true);

			$recipeType = sanitize_text_field($_REQUEST['recipe_type']); 
			static::updateTableConfig($tableId, $table_config, $recipeType);
        }


        if ( $route == 'delete_table' ) {
            $tableId = intval($_REQUEST['table_id']);
            static::deleteTable($tableId);
        }
	}



	public static function handleShortCode($atts)
	{
		$defaults = apply_filters('ninja_recipe_shortcode_default', array(
			'id' => null
		));
		$attributes = shortcode_atts($defaults, $atts);
		$tableId    = $attributes['id'];
		$post 	    = get_post($tableId);
		$recipeMetaData = get_post_meta($tableId, '_ninija_recipe_table_config', true);
		wp_enqueue_script('ninja_recipe_user_view', NINJA_RECIPE_PUBLIC_DIR_URL.'js/ninja_recipe_user_view.js', array('jquery'), NINJA_RECIPE_PLUGIN_DIR_VERSION, true);
		wp_localize_script('ninja_recipe_user_view','recipeMetaDataVars', array(
			'post' 			=> $post,
			'recipeMetaData'=> $recipeMetaData
		));
		return "<div id='wp_ninja_recipe'></div>";
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



	public static function getTables($pageNumber = 1, $perPage = 10, $search, $meal_type, $cusine_type, $preference_type)
	{

		$offset = ($pageNumber - 1 ) * $perPage;
		$args = array(
			'post_type' 	 => CPT::$CPTName,
			'offset' 		 => $offset,
			'posts_per_page' => $perPage,
			's'				 => $search,
			'meta_query'	 => array(
				'relation' => 'AND',
				array(
					'key'	 => '_ninija_recipe_table_config',
					'value'  =>  $meal_type,
					'compare' => 'LIKE'
				),
				array(
					'key'	 => '_ninija_recipe_table_config',
					'value'  =>  $cusine_type,
					'compare' => 'LIKE'
					
				),
				array(
					'key'	 => '_ninija_recipe_table_config',
					'value'  =>  $preference_type,
					'compare' => 'LIKE'
					
				)

			)
		);

		
		

		$tables = get_posts( $args );
		$totalCount = wp_count_posts(CPT::$CPTName);
		$formattedTables = array();
		foreach ($tables as $table) {
			$formattedTables[] = array(
                'ID'         	   => $table->ID,
                'post_title' 	   => $table->post_title,
                'recipe_type'	   => $table->post_content,
                'tableConfig' 	   => get_post_meta($table->ID,'_ninija_recipe_table_config', true),
                'demo_url'	   	   => home_url().'?ninja_recipe_preview='.$table->ID.'#ninja_recipe_demo',
                'defaultImage'	   => NINJA_RECIPE_PUBLIC_DIR_URL.'img/default-image.jpg'
            );
		}
		wp_send_json_success(array(
			'tables' => $formattedTables,
			'total'  => intval($totalCount->publish)

		), 200);
	}


	public  static function getTable($tableId, $returnType = 'ajax')
	{
			
		$table = get_post($tableId);
		$tableConfig = get_post_meta($tableId, '_ninija_recipe_table_config', true);

		$formattedTable = (object)array(
			'ID' 		 	   => $table->ID,
			'post_title' 	   => $table->post_title,
			'recipe_type'	   => $table->post_content
		);
		
		wp_send_json_success(array(
            'table'        => $formattedTable,
            'tableConfig'  => $tableConfig,
            //'demoRecipeConfig' => static::getRecipeConfig(),
            'demo_url' => home_url().'?ninja_recipe_preview='.$tableId.'#ninja_recipe_demo'
        ), 200);
	}



	public function deleteTable($tableId)
	{	
		delete_post_meta($tableId, '_ninija_recipe_table_config');	
		wp_delete_post($tableId);
		wp_send_json_success(array(
		  'message' => __('The Table successfully deleted!', 'ninja_recipe')
		),200);
	}



	public function updateTableConfig($tableId, $table_config, $recipeType)
	{
		
		$UpdateNinjaRecipe = array(
	      'ID'           => $tableId,
	      'post_content' => $recipeType,
	    );
		wp_update_post($UpdateNinjaRecipe);

		update_post_meta($tableId, '_ninija_recipe_table_config', $table_config);

		do_action('ninija_recipe_table_config_updated', $tableId, $table_config);
		$tableConfig = get_post_meta($tableId, '_ninija_recipe_table_config', true);
		wp_send_json_success(array(
            'message' => __('Table Content has been updated', 'ninja_recipe'),
            'tableConfig' => $tableConfig,
        ), 200);


	}


	public static function populateDemoData($tableId) //add meta label etc
    {
        //update_post_meta($tableId, '_ninija_recipe_table_config', static::getRecipeConfig());
    }

    public static function getRecipeConfig()
	{
		return array(
			
            'ingredient'  => 'ami bala asi',
            'description' => 'tmi vala aso ni',
            'nutrition'	  => 'oy vala asi'
	           
			);
	}




}




