<?php 

	namespace NinjaRecipe\Classes;

class ProcessDemoPage 
{
	
		public static function demoPageDisplay()
		{
			if( isset($_GET['ninja_recipe_preview']) && $_GET['ninja_recipe_preview'] )  {
				if( current_user_can( Menu::managePermission() ) ){
					$tableId = intval( $_GET['ninja_recipe_preview'] );
					static::renderPreview($tableId);
				}
			}
		}


		public static function renderPreview($tableId)
		{
			$table = get_post( $tableId );
			
			if($table){
				
				if($table->post_content == 'normal'){
					$RecipeType  = 'Normal Recipe Type';
				}
				elseif ($table->post_content == 'advance') {
					$RecipeType  = 'Advance Recipe Type';
				}

				static::loadDefaultPageTemplate();
				add_action('pre_get_posts', function($query){
					self::pre_get_posts($query);
				}, 100, 1);

				add_filter('post_thumbnail_html', '__return_empty_string');
				add_filter('get_the_excerpt', function( $content ) {
					return '';
				});

				add_filter('the_title', function( $title ) use ( $table ) {
					if(in_the_loop()){
						return $table->post_title;
					}
					return $title;
				}, 100, 1 );

				add_filter('the_content', function($content) use ($table, $RecipeType) {

					if( in_the_loop() ){
						$custom_content = __( $RecipeType .', '.'Demo Preview( ID:', 'ninja_recipe' );
						$content = '<div id="ninja_recipe_demo "style="text-align:center" class="recie_demo"><h3>'.$custom_content.$table->ID.' '.')</h3></div><hr/>';
						$content .= '[ninja_recipe id=' . $table->ID .']'; 
					}
					return $content;
				});
			}

		}

		private static function loadDefaultPageTemplate()
		{
			add_filter('template_include', function( $original ){
			   return locate_template( array('page.php', 'single.php', 'index.php') );
			});
		}


		/**
		 * Set the posts to one
		 *
		 * @param  WP_Query $query
		 *
		 * @return void
		 */
		
		public static function pre_get_posts($query)
		{
			if( $query->is_main_query() ) {
				$query->set('posts_per_page', 1);
			}
		}

}


