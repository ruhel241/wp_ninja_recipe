<?php namespace NinjaRecipe\Classes;


class RecipeHandler
{
	
	public static function handleAjaxCalls()
	{
		$route = sanitize_text_field($_REQUEST['route'] );

		if( $route == 'add_table' ){
			$tableTitle = sanitize_text_field($_REQUEST['post_title']);
			$recipeType = sanitize_text_field($_REQUEST['recipe_type']);
			$allRecipeCatgoryTypes = wp_unslash($_REQUEST['allRecipeCatgoryTypes']);
			static::addTable($tableTitle, $recipeType, $allRecipeCatgoryTypes);
		}

		if ($route == 'get_table') {
            $tableId = intval($_REQUEST['table_id']);
            static::getTable($tableId, 'ajax');
        }


		if( $route == 'get_tables'){
			$pageNumber = intval($_REQUEST['page_number']);
			$perPage 	= intval($_REQUEST['per_page']);
			static::getTables($pageNumber, $perPage);
		}

        if ($route == 'update_table_config') {
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


	public static function addTable($tableTitle, $recipeType, $allRecipeCatgoryTypes)
	{	
		// return var_dump($allRecipeCatgoryTypes);	
		
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

		if( ! $allRecipeCatgoryTypes['meal_types'] ){
			wp_send_json_error(array(
				'message' => __("Please Select Recipe Meal Type", 'ninja_recipe')
			), 423);
		}

		if( ! $allRecipeCatgoryTypes['cusine_types'] ){
			wp_send_json_error(array(
				'message' => __("Please Select Cusine Type", 'ninja_recipe')
			), 423);
		}

		if( ! $allRecipeCatgoryTypes['preferenceTypes'] ){
			wp_send_json_error(array(
				'message' => __("Please Select Preference Type", 'ninja_recipe')
			), 423);
		}

		$tableData = array(
			'post_title'   => $tableTitle,
			'post_content' => $recipeType,
			// 'post_excerpt' => $allRecipeCatgoryTypes,
			'post_type'	   => CPT::$CPTName,
			'post_status'  => 'publish'
		);

		$tableId = wp_insert_post($tableData);

		// meta add
		update_post_meta($tableId, '_ninija_recipe_table_config', $allRecipeCatgoryTypes);

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



	public static function getTables($pageNumber = 1, $perPage = 10)
	{
		$offset = ($pageNumber - 1 ) * $perPage;
		$tables = get_posts(array(
			'post_type' 	 => CPT::$CPTName,
			'offset' 		 => $offset,
			'posts_per_page' => $perPage
		));

		$totalCount = wp_count_posts(CPT::$CPTName);
		$formattedTables = array();
		foreach ($tables as $table) {
			$formattedTables[] = array(
                'ID'         	   => $table->ID,
                'post_title' 	   => $table->post_title,
                'recipe_type'	   => $table->post_content,
                'recipe_catgories' => $table->post_excerpt,
                'demo_url'	    => home_url().'?ninja_recipe_preview='.$table->ID.'#ninja_recipe_demo'
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

		$formattedTable = (object)array(
			'ID' 		 	   => $table->ID,
			'post_title' 	   => $table->post_title,
			'recipe_type'	   => $table->post_content,
			'recipe_catgories' => $table->post_excerpt
		);
		$tableConfig = get_post_meta($tableId, '_ninija_recipe_table_config', true);
		 wp_send_json_success(array(
            'table'        => $formattedTable,
            'tableConfig'  => $tableConfig,
            'RecipeConfig' => static::getRecipeConfig(),
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
	      // 'post_thumbnail' => "image upload"
		);
		wp_update_post( $UpdateNinjaRecipe );
		update_post_meta($tableId, '_ninija_recipe_table_config', $table_config);

		do_action('ninija_recipe_table_config_updated', $tableId, $table_config);
		// $tableConfig = get_post_meta($tableId, '_ninija_recipe_table_config', true);
		wp_send_json_success(array(
            'message' => __('Table Content has been updated', 'ninja_recipe'),
            // 'tableConfig' => $tableConfig,
        ), 200);


	}




	public static function populateDemoData($tableId) //add meta label etc
    {
        update_post_meta($tableId, '_ninija_recipe_table_config', static::getRecipeConfig());
    }

    public static function getRecipeConfig()
	{
		return array(
				'selectedLabel' => array(
	                'loanAmount' 	     => 'Loan Amount',
	                'downPament'	     => 'Down Payment',
	                'mortgageTerm'	     => 'Mortgage Term',
	                'annualInterestRate' => 'Annual Interest Rate',
	            ),

				'selectedDefault' => array(
					'loanAmountDefVal' 		  => 120000,
					'downPamentDefVal'		  => 20000,
					'mortgageTermDefVal'	  => 30,
					'annualInterestRateDefVal'=> 12
				),
					
				'settings' => false
			);
	}




}




