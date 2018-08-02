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
define("NINJA_RECIPE_PLUGIN_DIR_VERSION", plugin_dir_url(__FILE__));


class WPNinjaRecipe
{
	
	public function boot()
	{
		$this->commonHooks();
		$this->adminHooks();
		$this->publicHooks();
		$this->loadTextDomain();
	}

	public function commonHooks()
	{	
		add_action('init', array('NinjaRecipe\Classes\CPT','register'));
		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
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
		
	}


	public function enqueueScripts()
	{
		

	}


	public function adminEnqueueScripts()
	{
		if ( function_exists( 'wp_enqueue_editor' ) ) {
			wp_enqueue_editor();
			wp_enqueue_media();
		}
	}




	public function loadTextDomain()
	{
		
	}

}

add_action('plugins_loaded', function() {
	$wpNinjaRecipe = new WPNinjaRecipe();
	$wpNinjaRecipe->boot();
});

