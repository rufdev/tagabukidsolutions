<?php
/*
Plugin Name: Infuse
Description: Allows you to create reusable pieces of content that you can place anywhere in your site. Insert them into your posts, on a sidebar, or place them directly onto the layout thanks to the different areas available.
Author: CPOThemes
Version: 1.2.1
Author URI: http://www.cpothemes.com
*/

//Plugin setup
if(!function_exists('infuse_setup')){
	add_action('plugins_loaded', 'infuse_setup');
	function infuse_setup(){
		//Load text domain
		$textdomain = 'infuse';
		$locale = apply_filters('plugin_locale', get_locale(), $textdomain);
		if(!load_textdomain($textdomain, trailingslashit(WP_LANG_DIR).$textdomain.'/'.$textdomain.'-'.$locale.'.mo')){
			load_plugin_textdomain($textdomain, FALSE, basename(dirname($_SERVER["SCRIPT_FILENAME"])).'/languages/');
		}
	}
}


//Add public stylesheets
add_action('wp_enqueue_scripts', 'infuse_add_styles');
function infuse_add_styles(){
	$stylesheets_path = plugins_url('css/' , __FILE__);
	wp_enqueue_style('infuse-content-blocks', $stylesheets_path.'style.css');
}


//Add Public scripts
add_action('admin_enqueue_scripts', 'infuse_scripts_back');
function infuse_scripts_back( ){
    $scripts_path = plugins_url('scripts/' , __FILE__);
	
	//Register custom scripts for later enqueuing
	wp_register_script('infuse-admin', $scripts_path.'admin.js', array('jquery'), false, true);
}


//Add admin stylesheets
add_action('admin_print_styles', 'infuse_add_styles_admin');
function infuse_add_styles_admin(){
	$stylesheets_path = plugins_url('css/' , __FILE__);
	wp_enqueue_style('infuse-admin', $stylesheets_path.'admin.css');
}


//Activation hook
function infuse_activation(){
	//Migrate cpo_content_block posts to infuse_block
	global $wpdb;
    $wpdb->query("UPDATE $wpdb->posts SET post_type = 'infuse_block' WHERE post_type = 'cpo_content_block'");
}
register_activation_hook(__FILE__, 'infuse_activation');


//Add all Shortcode components
$core_path = plugin_dir_path(__FILE__);

//General
require_once($core_path.'includes/post-types.php');
require_once($core_path.'includes/meta.php');
require_once($core_path.'includes/forms.php');
require_once($core_path.'includes/general.php');
require_once($core_path.'includes/metadata.php');