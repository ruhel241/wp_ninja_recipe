<?php

defined('ABSPATH') or die;
/*
Plugin Name: WP Ninja Recipe
Description: The Best WP Ninja Recipe Plugin for WordPress
Version: 1.0.0
Author: WPManageNinja
Author URI: https://wpmanageninja.com
Plugin URI: https://wpmanageninja.com/products/ninja-mortgage-calculator-plugin
License: GPLv2 or later
Text Domain: ninja_recipe
Domain Path: /languages
*/

include "load.php";
define("NINJA_RECIPE_PLUGIN_DIR_URL", plugin_dir_url(__FILE__));
define("NINJA_RECIPE_PUBLIC_DIR_URL", NINJA_RECIPE_PLUGIN_DIR_URL.'public/');
define("NINJA_RECIPE_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
define("NINJA_RECIPE_PLUGIN_DIR_VERSION", 1.00);


class WPNinjaRecipe
{
	
	public function boot()
	{
		$this->commonHooks();
		$this->publicHooks();
		$this->loadTextDomain();
		if( is_admin() ){
			$this->adminHooks();
		}
	}

	public function commonHooks()
	{	
		add_action('init', array('NinjaRecipe\Classes\CPT','register'));
		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
		add_shortcode('ninja_recipe', array('NinjaRecipe\Classes\RecipeHandler','handleShortCode') );
	}


	public function adminHooks()
	{
		add_action('admin_menu', array('NinjaRecipe\Classes\Menu','addAdminMenuPages'));
		add_action('wp_ajax_ninja_recipe_ajax_actions', array('NinjaRecipe\Classes\RecipeHandler','handleAjaxCalls'));
		add_action('admin_enqueue_scripts', array($this, 'adminEnqueueScripts'));
		add_action('ninja_recipe_added_new_table', array('NinjaRecipe\Classes\RecipeHandler','populateDemoData') );
	}


	public function publicHooks()
	{
		add_action('init', array('NinjaRecipe\Classes\ProcessDemoPage','demoPageDisplay') );
		wp_enqueue_script('nutrition_modal_script', NINJA_RECIPE_PUBLIC_DIR_URL.'js/nutrition_modal.js', array('jquery'), NINJA_RECIPE_PLUGIN_DIR_VERSION, true);	
	}


	public function enqueueScripts()
	{
		wp_register_style( 'ninja_recipe_style', NINJA_RECIPE_PUBLIC_DIR_URL.'css/style.css' , '', NINJA_RECIPE_PLUGIN_DIR_VERSION); 
		wp_enqueue_style( 'ninja_recipe_style' );
		
	}


	public function adminEnqueueScripts()
	{
		if ( function_exists( 'wp_enqueue_editor' ) ) {
			wp_enqueue_editor();
			wp_enqueue_media();
		}
		wp_register_style( 'admin_recipe_style', NINJA_RECIPE_PUBLIC_DIR_URL.'css/admin.css' , '', NINJA_RECIPE_PLUGIN_DIR_VERSION); 
		wp_enqueue_style( 'admin_recipe_style' );
	}




	public function loadTextDomain()
	{
		
	}

}

add_action('plugins_loaded', function() {
	(new WPNinjaRecipe)->boot();
});


