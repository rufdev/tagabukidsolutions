<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package haxel
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function haxel_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'haxel_jetpack_setup' );
