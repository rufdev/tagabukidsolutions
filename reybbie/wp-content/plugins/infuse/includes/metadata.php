<?php

function infuse_metadata_block_settings(){

	$metadata = array();
	
	$metadata['block_pages'] = array(
	'name' => 'block_pages',
	'label' => __('Show In Pages', 'infuse'),
	'desc' => __('Select in which pages this block should be displayed.', 'infuse'),
	'type' => 'checkbox',
	'option' => infuse_metadata_pages());
	
	return apply_filters('infuse_metadata_block_settings', $metadata);
}


function infuse_metadata_block_location(){

	$metadata = array();
	
	$metadata['block_location'] = array(
	'name' => 'block_location',
	'label' => __('block Location', 'infuse'),
	'desc' => __('Select where block should be displayed.', 'infuse'),
	'type' => 'text');
	
	$metadata['block_priority'] = array(
	'name' => 'block_priority',
	'label' => __('Block Priority', 'infuse'),
	'desc' => __('Determines the priority in case of multiple blocks using the same location. Blocks with a lower number will appear first.', 'infuse'),
	'type' => 'text');
	
	return apply_filters('infuse_metadata_block_settings', $metadata);
}

//Store metadata for block posts
function infuse_metadata_block_appearance(){

	$metadata = array();
	
	$metadata['block_padding_top'] = array(
	'name' => 'block_padding_top',
	'label' => __('Top Padding', 'infuse'),
	'placeholder' => '10',
	'type' => 'text');
	
	$metadata['block_padding_right'] = array(
	'name' => 'block_padding_right',
	'label' => __('Right Padding', 'infuse'),
	'placeholder' => '10',
	'type' => 'text');
	
	$metadata['block_padding_bottom'] = array(
	'name' => 'block_padding_bottom',
	'label' => __('Bottom Padding', 'infuse'),
	'placeholder' => '10',
	'type' => 'text');
	
	$metadata['block_padding_left'] = array(
	'name' => 'block_padding_left',
	'label' => __('Left Padding', 'infuse'),
	'placeholder' => '10',
	'type' => 'text');
	
	
	$metadata['block_margin_top'] = array(
	'name' => 'block_margin_top',
	'label' => __('Top margin', 'infuse'),
	'placeholder' => '0',
	'type' => 'text');
	
	$metadata['block_margin_right'] = array(
	'name' => 'block_margin_right',
	'label' => __('Right margin', 'infuse'),
	'placeholder' => '0',
	'type' => 'text');
	
	$metadata['block_margin_bottom'] = array(
	'name' => 'block_margin_bottom',
	'label' => __('Bottom margin', 'infuse'),
	'placeholder' => '0',
	'type' => 'text');
	
	$metadata['block_margin_left'] = array(
	'name' => 'block_margin_left',
	'label' => __('Left margin', 'infuse'),
	'placeholder' => '0',
	'type' => 'text');
	

	$metadata['block_bg'] = array(
	'name' => 'block_bg',
	'label' => __('Background Color', 'infuse'),
	'desc' => __('Indicates the background color for this content block. Leave empty for a transparent background.', 'infuse'),
	'type' => 'color');
	
	$metadata['block_color'] = array(
	'name' => 'block_color',
	'label' => __('Color Scheme', 'infuse'),
	'desc' => __('Allows you to change the color of texts inside this block, in case you use a dark color as the background.', 'infuse'),
	'type' => 'select',
	'option' => infuse_metadata_color());
	
	return apply_filters('infuse_metadata_block_appearance', $metadata);
}


//Position within the site
function infuse_metadata_locations($key = null){
	$metadata = array(
	'wordpress' => infuse_metadata_locations_wordpress(),
	'cpothemes' => infuse_metadata_locations_cpothemes(),
	'woocommerce' => infuse_metadata_locations_woocommerce(),
	//'edd' => infuse_metadata_locations_edd(),
	'genesis' => infuse_metadata_locations_genesis(),
	//'bbpress' => infuse_metadata_locations_bbpress(),
	//'buddypress' => infuse_metadata_locations_buddypress(),
	);
	
	$metadata = apply_filters('infuse_metadata_locations', $metadata);
	return $key != null && isset($metadata[$key]) ? $metadata[$key] : $metadata;
}


//Position within the site
function infuse_metadata_locations_wordpress($key = null){
	$metadata = array(
	'name' => 'WordPress',
	'description' => __('Standard WordPress action hooks.', 'infuse'),
	'image' => plugins_url('/../images/' , __FILE__).'wordpress.png',
	'hooks' => array(
		'wp_head' => __('In the head of the document', 'infuse'),
		'wp_footer' => __('In the footer, right before closing the body tag', 'infuse'),
		)
	);
	
	$metadata = apply_filters('infuse_metadata_locations', $metadata);
	return $metadata;
}


//Position within the site
function infuse_metadata_locations_cpothemes($key = null){
	$metadata = array(
	'name' => 'CPOThemes',
	'description' => __('Themes using the CPO framework.', 'infuse'),
	'image' => plugins_url('/../images/' , __FILE__).'cpothemes.png',
	'hooks' => array(
		'cpotheme_before_wrapper' => __('Before the main website wrapper', 'infuse'),
		'cpotheme_top' => __('In the topmost  bar', 'infuse'),
		'cpotheme_header' => __('In the header area with the menu and logo', 'infuse'),
		'cpotheme_before_main' => __('Before the main content area, above post content and sidebar', 'infuse'),
		'cpotheme_before_title' => __('Before the title of the page', 'infuse'),
		'cpotheme_title' => __('In the title of the page', 'infuse'),
		'cpotheme_after_title' => __('After the title of the page', 'infuse'),
		'cpotheme_before_content' => __('Before post content, at the same level as the sidebar', 'infuse'),
		'cpotheme_after_content' => __('After post content, at the same level as the sidebar', 'infuse'),
		'cpotheme_after_main' => __('After main content, under the post content and sidebar', 'infuse'),
		'cpotheme_subfooter' => __('In the subfooter area', 'infuse'),
		'cpotheme_before_footer' => __('Before the footer area', 'infuse'),
		'cpotheme_footer' => __('In the footer', 'infuse'),
		'cpotheme_after_footer' => __('After the footer area', 'infuse'),
		'cpotheme_after_wrapper' => __('After the main website wrapper', 'infuse'),
		'cpotheme_author_links' => __('On the links located in the author bios', 'infuse'),
		'cpotheme_before_404' => __('Before the content of 404 pages', 'infuse'),
		'cpotheme_404' => __('On 404 pages', 'infuse'),
		'cpotheme_after_404' => __('After the content of 404 pages', 'infuse'),
		)
	);
	
	$metadata = apply_filters('infuse_metadata_locations', $metadata);
	return $metadata;
}


//Position within the site
function infuse_metadata_locations_genesis($key = null){
	$metadata = array(
	'name' => 'Genesis',
	'description' => __('Themes using the Genesis framework.', 'infuse'),
	'image' => plugins_url('/../images/' , __FILE__).'genesis.png',
	'hooks' => array(
		'genesis_before' => __('Before the main website wrapper', 'infuse'),
		'genesis_before_header' => __('Before the header area', 'infuse'),
		'genesis_header' => __('In the header area before the site logo', 'infuse'),
		'genesis_site_title' => __('In the site title', 'infuse'),
		'genesis_site_description' => __('In the site description after the title', 'infuse'),
		'genesis_header_right' => __('In the header to the right of the site title', 'infuse'),
		'genesis_after_header' => __('After the header area', 'infuse'),
		'genesis_before_content_sidebar_wrap' => __('Before the wrapper of main content area', 'infuse'),
		'genesis_before_content' => __('Before the main content area', 'infuse'),
		'genesis_before_loop' => __('Before the main loop', 'infuse'),
		'genesis_loop' => __('In the loop, right before it starts', 'infuse'),
		'genesis_before_entry' => __('Before an individual entry in the loop', 'infuse'),
		'genesis_entry_header' => __('In the header of an individual entry', 'infuse'),
		'genesis_entry_content' => __('In the content of an individual entry', 'infuse'),
		'genesis_entry_footer' => __('In the footer of an individual entry', 'infuse'),
		'genesis_after_entry' => __('After an individual entry in the loop', 'infuse'),
		'genesis_after_endwhile' => __('After the loop finishes', 'infuse'),
		'genesis_after_loop' => __('After the main loop', 'infuse'),
		'genesis_after_content' => __('After the main content area', 'infuse'),
		'genesis_before_sidebar_widget_area' => __('Before the sidebar widget area', 'infuse'),
		'genesis_after_sidebar_widget_area' => __('After the sidebar widget area', 'infuse'),
		'genesis_after_content_sidebar_wrap' => __('After the wrapper of main content area', 'infuse'),
		'genesis_before_footer' => __('Before the footer', 'infuse'),
		'genesis_footer' => __('In the footer', 'infuse'),
		'genesis_after_footer' => __('After the footer', 'infuse'),
		'genesis_after' => __('After the main website wrapper', 'infuse'),
		)
	);
	
	$metadata = apply_filters('infuse_metadata_locations', $metadata);
	return $metadata;
}


function infuse_metadata_locations_bbpress($key = null){
	$metadata = array(
	'name' => 'bbPress',
	'description' => __('Forums and topics.', 'infuse'),
	'image' => plugins_url('/../images/' , __FILE__).'bbpress.png',
	'hooks' => array(
		'woocommerce_before_main' => __('Before main shop content', 'infuse'),
		)
	);
	
	$metadata = apply_filters('infuse_metadata_locations', $metadata);
	return $metadata;
}


function infuse_metadata_locations_buddypress($key = null){
	$metadata = array(
	'name' => 'BuddyPress',
	'description' => __('Social pages and user profiles.', 'infuse'),
	'image' => plugins_url('/../images/' , __FILE__).'buddypress.png',
	'hooks' => array(
		'woocommerce_before_main' => __('Before main shop content', 'infuse'),
		)
	);
	
	$metadata = apply_filters('infuse_metadata_locations', $metadata);
	return $metadata;
}


function infuse_metadata_locations_woocommerce($key = null){
	$metadata = array(
	'name' => 'WooCommerce',
	'description' => __('Shop pages powered by WooCommerce.', 'infuse'),
	'image' => plugins_url('/../images/' , __FILE__).'woocommerce.png',
	'hooks' => array(
		'woocommerce_before_main' => __('Before main shop content', 'infuse'),
		'woocommerce_before_cart' => __('Before the cart contents', 'infuse'),
		'woocommerce_after_cart' => __('After the cart contents', 'infuse'),
		'woocommerce_before_checkout_form' => __('Before the checkout form', 'infuse'),
		'woocommerce_after_checkout_form' => __('After the checkout form', 'infuse'),
		'woocommerce_thankyou' => __('In the thank you page shown after making a purchase', 'infuse'),
		)
	);
	
	$metadata = apply_filters('infuse_metadata_locations', $metadata);
	return $metadata;
}


//Position within the site
function infuse_metadata_locations_edd($key = null){
	$metadata = array(
	'name' => 'Easy Digital Downloads',
	'description' => __('Shop pages powered by EDD.', 'infuse'),
	'image' => plugins_url('/../images/' , __FILE__).'edd.png',
	'hooks' => array(
		'woocommerce_before_main' => __('Before main shop content', 'infuse'),
		'woocommerce_before_cart' => __('Before the cart contents', 'infuse'),
		'edd_after_download_content' => __('After the contents of a single download item.', 'infuse'),
		'woocommerce_before_checkout_form' => __('Before the checkout form', 'infuse'),
		'woocommerce_after_checkout_form' => __('After the checkout form', 'infuse'),
		'woocommerce_thankyou' => __('In the thank you page shown after making a purchase', 'infuse'),
		)
	);
	
	$metadata = apply_filters('infuse_metadata_locations', $metadata);
	return $metadata;
}


//Location through out the site
function infuse_metadata_pages($key = null){
	$metadata = array(
	'always' => __('Show Always', 'infuse'),
	'home' => __('Home Page', 'infuse'),
	'post' => __('Posts', 'infuse'),
	'page' => __('Pages', 'infuse'),
	'404' => __('404 Pages', 'infuse'),
	'search' => __('Search Pages', 'infuse'));
	
	//Add public post types
	//$metadata['custom_post_types'] = array('name' => __('Custom Post Types', 'infuse'), 'type' => 'separator');
	$post_types = get_post_types(array('public' => true), 'objects');
	foreach($post_types as $current_type => $current_data)
		if(!isset($metadata[$current_type])) 
			$metadata[$current_type] = $current_data->labels->name;
	
	//Add public taxonomies
	$taxonomies = get_taxonomies(array('public' => true), 'objects');
	foreach($taxonomies as $taxonomy => $current_data)
		if(!isset($metadata[$taxonomy])) 
			$metadata[$taxonomy] = $current_data->labels->name;
	
	return $key != null && isset($metadata[$key]) ? $metadata[$key] : $metadata;
}


//Conditional filters
function infuse_metadata_filters($key = null){
	$metadata = array(
	'logged_in' => __('Logged In Users Only', 'infuse'),
	'logged_out' => __('Logged Out Users Only', 'infuse'),
	);
	
	return $key != null && isset($metadata[$key]) ? $metadata[$key] : $metadata;
}


function infuse_metadata_color($key = null){
	$metadata = array(
	'light' => __('Light Scheme', 'infuse'),
	'dark' => __('Dark Scheme', 'infuse'),
	);
	return $key != null && isset($metadata[$key]) ? $metadata[$key] : $metadata;
}