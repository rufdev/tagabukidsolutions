<?php
// Exit if accessed directly
if(!defined('ABSPATH')) exit;


//Register post type
function infuse_post_types(){
	//Add portfolio
	$labels = array('name' => __('Content Blocks', 'infuse'),
	'singular_name' => __('Content Block', 'infuse'),
	'add_new' => __('Add Content Block', 'infuse'),
	'add_new_item' => __('Add New Content Block', 'infuse'),
	'edit_item' => __('Edit Content Block', 'infuse'),
	'new_item' => __('New Content Block', 'infuse'),
	'view_item' => __('View Content Blocks', 'infuse'),
	'search_items' => __('Search Content Blocks', 'infuse'),
	'not_found' =>  __('No content blocks found.', 'infuse'),
	'not_found_in_trash' => __('No content blocks found in the trash.', 'infuse'), 
	'parent_item_colon' => '');
	
	$fields = array('labels' => $labels,
	'public' => false,
	'publicly_queryable' => false,
	'show_ui' => true, 
	'query_var' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'show_in_nav_menus' => true,
	'menu_icon' => 'dashicons-schedule',
	'menu_position' => null,
	'supports' => array('title', 'editor')); 
	register_post_type('infuse_block', $fields);
}
add_action('init', 'infuse_post_types');


//Declare columns
function infuse_post_columns($columns){
	$columns = array(
	'cb' => '<input type="checkbox" />',
	'title' => __('Title', 'infuse'),
	'infuse-shortcode' => __('Shortcode', 'infuse'),
	'infuse-location' => __('Location', 'infuse'),
	'infuse-pages' => __('Pages', 'infuse'),
	);
	return $columns;
}
add_filter('manage_edit-infuse_block_columns', 'infuse_post_columns') ;


//Declare column content
function infuse_post_columns_content($column){
	global $post;
	switch($column){
		case 'infuse-location': 
			echo get_post_meta($post->ID, 'block_location', true).'<br>('.get_post_meta($post->ID, 'block_priority', true).')';
		break;	
		case 'infuse-shortcode': 
			echo '<div style="background:rgba(0,0,0,0.04); padding:4px 10px; font-family:monospace;">';
			echo '[infuse_block id="'.$post->ID.'"]';
			echo '</div>';
		break;	
		case 'infuse-pages': 
			$pages = get_post_meta($post->ID, 'block_pages', true);
			if(is_array($pages)) foreach($pages as $current_page => $current_value){
				echo infuse_metadata_pages($current_page).'<br>';
			}
		break;	
		default:break;
	}
}
add_action('manage_posts_custom_column', 'infuse_post_columns_content', 2);


//Add metaboxes to block posts
function infuse_metaboxes(){
	add_meta_box('infuse_block_settings', __('Block Display', 'infuse'), 'infuse_metabox_settings', 'infuse_block', 'side', 'default');
	add_meta_box('infuse_block_location', __('Block Location', 'infuse'), 'infuse_metabox_location', 'infuse_block', 'normal', 'high');
	add_meta_box('infuse_block_appearance', __('Block Appearance', 'infuse'), 'infuse_metabox_appearance', 'infuse_block', 'normal', 'high');
}
add_action('add_meta_boxes', 'infuse_metaboxes');


//Settings & appearance
function infuse_metabox_settings($post){
	echo '<p>';
	echo __('Choose the pages where you want this block to be displayed. You can choose Show Always to keep it visible at all times.', 'infuse');
	echo '</p>';
	infuse_meta_fields($post, infuse_metadata_block_settings());
}


//Location metabox
function infuse_metabox_location($post){ 
	wp_enqueue_script('infuse-admin');
	
	$location_value = esc_attr(get_post_meta($post->ID, 'block_location', true));
	$priority_value = esc_attr(get_post_meta($post->ID, 'block_priority', true));
	
	echo '<p>';
	echo __('Please specify the name of the WordPress action hook you wish to add this content in. You can use any existing hook from your current theme or from any plugin, but you can also select a hook from the list for your convenience.', 'infuse');
	echo '</p>';
	echo '<div class="infuse-metabox-location">';
	echo '<input type="text" value="'.$location_value.'" class="infuse-input-location" name="block_location" id="block_location" placeholder="'.__('Name of the action hook', 'infuse').'"/>';
	echo '<input type="text" value="'.$priority_value.'" class="infuse-input-location infuse-input-priority" name="block_priority" id="block_priority" placeholder="'.__('Priority (10)', 'infuse').'"/>';
	echo '</div>';
	
	$locations = infuse_metadata_locations();
	$tab_content = '';
	$active_class = ' infuse-tab-active';
	
	echo '<div class="infuse-tabs">';
	echo '<div class="infuse-tab-menu">';
	foreach($locations as $current_key => $current_location){
		$location_key = esc_attr($current_key);
		$location_name = isset($current_location['name']) ? esc_attr($current_location['name']) : __('(Unknown)', 'infuse');
		$location_description = isset($current_location['description']) ? esc_attr($current_location['description']) : '';
		$location_image = isset($current_location['image']) ? esc_url($current_location['image']) : '';
		echo '<div class="infuse-tab'.$active_class.'" rel="#infuse-tab-content-'.$location_key.'">';
		if($location_image != ''){
			echo '<img class="infuse-tab-image" src="'.$location_image.'">';
		}
		echo '<div class="infuse-tab-title">'.$location_name.'</div>';
		echo '<div class="infuse-tab-description">'.$location_description.'</div>';
		echo '</div>';
		
		$tab_content .= '<div class="infuse-tab-group'.$active_class.'" id="infuse-tab-content-'.$location_key.'">';
		foreach($current_location['hooks'] as $hook_key => $hook_description){
			$hook_key = esc_attr($hook_key);
			$hook_description = esc_html($hook_description);
			$tab_content .= '<div class="infuse-tab-content" rel="'.$hook_key.'">';
			$tab_content .= '<div class="infuse-tab-content-title">'.$hook_key.'</div>';
			$tab_content .= '<div class="infuse-tab-content-description">'.$hook_description.'</div>';
			$tab_content .= '</div>';
		}
		$tab_content .= '</div>';
		$active_class = '';
	}
	echo '</div>';
	echo '<div class="infuse-tab-body">';
	echo $tab_content;
	echo '</div>';
	echo '</div>';
	
	echo '<div class="infuse-shortcode-preview">';
	echo __('You can also use this shortcode to embed this content block into your posts:', 'infuse');
	echo '<div class="infuse-shortcode-preview-content">';
	echo '[infuse_block id="'.$post->ID.'"]';
	echo '</div>';
	echo '</div>';
}


//Display metaboxes
function infuse_metabox_appearance($post){ 
	do_action('infuse_metabox_before_appearance');
	// echo '<p>';
	// echo __('Add the name of the WordPress action hook you wish to add this content in. You can also select a hook from the list.', 'infuse');
	// echo '</p>';
	
	echo '<div class="infuse-appearance">';
	
	//Margins & paddings
	echo '<div class="infuse-appearance-preview">';
	
	//Margins
	echo '<div class="infuse-appearance-margins">';
	echo '<div class="infuse-appearance-tag">'.__('Margin', 'infuse').'</div>';
	echo '<input class="infuse-appearance-input infuse-appearance-input-top" type="text" value="'.esc_attr(get_post_meta($post->ID, 'block_margin_top', true)).'" name="block_margin_top" id="block_margin_top" placeholder="0">';
	echo '<input class="infuse-appearance-input infuse-appearance-input-bottom" type="text" value="'.esc_attr(get_post_meta($post->ID, 'block_margin_bottom', true)).'" name="block_margin_bottom" id="block_margin_bottom" placeholder="0">';
	echo '<input class="infuse-appearance-input infuse-appearance-input-left" type="text" value="'.esc_attr(get_post_meta($post->ID, 'block_margin_left', true)).'" name="block_margin_left" id="block_margin_left" placeholder="0">';
	echo '<input class="infuse-appearance-input infuse-appearance-input-right" type="text" value="'.esc_attr(get_post_meta($post->ID, 'block_margin_right', true)).'" name="block_margin_right" id="block_margin_right" placeholder="0">';
	
	//Paddings
	echo '<div class="infuse-appearance-paddings">';
	echo '<div class="infuse-appearance-tag">'.__('Padding', 'infuse').'</div>';
	echo '<input class="infuse-appearance-input infuse-appearance-input-top" type="text" value="'.esc_attr(get_post_meta($post->ID, 'block_padding_top', true)).'" name="block_padding_top" id="block_padding_top" placeholder="0">';
	echo '<input class="infuse-appearance-input infuse-appearance-input-bottom" type="text" value="'.esc_attr(get_post_meta($post->ID, 'block_padding_bottom', true)).'" name="block_padding_bottom" id="block_padding_bottom" placeholder="0">';
	echo '<input class="infuse-appearance-input infuse-appearance-input-left" type="text" value="'.esc_attr(get_post_meta($post->ID, 'block_padding_left', true)).'" name="block_padding_left" id="block_padding_left" placeholder="0">';
	echo '<input class="infuse-appearance-input infuse-appearance-input-right" type="text" value="'.esc_attr(get_post_meta($post->ID, 'block_padding_right', true)).'" name="block_padding_right" id="block_padding_right" placeholder="0">';
	echo '<div class="infuse-appearance-inner"></div>';
	echo '</div>';
	
	echo '</div>'; //End margins
	
	echo '</div>';
	
	echo '<div class="infuse-appearance-content infuse-appearance-content-right">';
	
	$data = infuse_metadata_block_appearance();
	
	echo '<div class="infuse-appearance-field">';
	echo '<div class="infuse-appearance-field-title">'.__('Background Color', 'infuse').'</div>';
	echo infuse_form_color('block_bg', get_post_meta($post->ID, 'block_bg', true));
	echo '</div>';
	
	echo '<div class="infuse-appearance-field">';
	echo '<div class="infuse-appearance-field-title">'.__('Text Color', 'infuse').'</div>';
	echo infuse_form_select('block_color', get_post_meta($post->ID, 'block_color', true), infuse_metadata_color(), $data['block_color']);
	echo '</div>';
	
	
	echo '</div>';
	
	
	echo '</div>';
	
	//infuse_meta_fields($post, infuse_metadata_block_appearance());
	do_action('infuse_metabox_after_appearance');
}


//Save metaboxes on post update
function infuse_metabox_save($post){
	infuse_meta_save(infuse_metadata_block_settings());
	infuse_meta_save(infuse_metadata_block_appearance());
	infuse_meta_save(infuse_metadata_block_location());
}
add_action('save_post_infuse_block', 'infuse_metabox_save');