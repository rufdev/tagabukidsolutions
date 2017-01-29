<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package haxel
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'haxel' ); ?></a>
	<div id="jumbosearch">
		<span class="fa fa-remove closeicon"></span>
		<div class="form">
			<?php get_search_form(); ?>
		</div>
	</div>	
	
	<div id="top-bar">
		<div class="top-bar-layer">
		<!--
<div class="container">
			<div id="top-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
			</div>
		</div>
-->
		</div>
	</div>
	
	<header id="masthead" class="site-header" role="banner" data-parallax="scroll" data-speed="0.2" data-z-index="1" data-image-src="<?php header_image(); ?>">
	<div class="layer">
		<div class="container">
			<div class="site-branding">
				<?php if ( haxel_has_logo() ) : ?>					
					<div id="site-logo">
						<?php haxel_logo() ?>
					</div>
				<?php endif; ?>	
				<div id="text-title-desc">
				<h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>
			</div>
			
			<div id="slickmenu"></div>
			<nav id="site-navigation" class="main-navigation front" role="navigation">
					<?php
						// Get the Appropriate Walker First.
						 if (has_nav_menu( 'primary' ) && !get_theme_mod('haxel_disable_nav_desc',true) ) :
								$walker = new Haxel_Menu_With_Description;
							elseif(!has_nav_menu('primary')) :
								$walker = '';
							else : 
								$walker = new Haxel_Menu_With_Icon;
						  endif;
						  //Display the Menu.							
						  wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) ); ?>
			</nav><!-- #site-navigation -->
				
		</div>	
		
		<div class="social-icons">
			<?php get_template_part('social', 'fa'); ?>
				 
		</div>
	</div>	
	</header><!-- #masthead -->
	
	<?php get_template_part('slider', 'nivo' ); ?>
	
	<div class="mega-container">
		<?php get_template_part('featured', 'showcase' ); ?>
		<?php get_template_part('featured', 'posts' ); ?>
		<?php get_template_part('featured', 'content2'); ?>
		<?php get_template_part('featured', 'content1'); ?>
	
		<div id="content" class="site-content container">