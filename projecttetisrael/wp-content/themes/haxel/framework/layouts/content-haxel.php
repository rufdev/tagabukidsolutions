<?php
/**
 * @package Haxel
 */
?>

<?php //DETERMINE CLASSES 
if( $wp_query->current_post == 0 && !is_paged() && is_home() ) {
	 $post_class = "col-md-12";
 }
 else {
	 $post_class = "col-md-6";
 }
 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('grid haxel '.$post_class); ?>>

		<div class="pre-thumb col-md-12 col-sm-12">
			<header class="entry-header">
				<div class="post-categories"><?php echo get_the_category_list(' &#8226; '); ?></div>
				<h1 class="entry-title title-font"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				<div class="postedon"><?php haxel_posted_on_date(); ?></div>
			</header><!-- .entry-header -->
		</div><!--.out-thumb-->

		<div class="featured-thumb col-md-12">
			<?php if (has_post_thumbnail()) : ?>	
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><?php the_post_thumbnail('haxel-thumb'); ?></a>
			<?php else: ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img alt="<?php the_title_attribute() ?>" src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
			<?php endif; ?>
		</div><!--.featured-thumb-->
		
		<div class="out-thumb col-md-12">
				<span class="entry-excerpt"><?php echo substr(get_the_excerpt(),0,200).(get_the_excerpt() ? "..." : "" ); ?></span>
				<span class="readmore"><a class="hvr-underline-from-center" href="<?php the_permalink() ?>"><?php _e('Read More','haxel'); ?></a></span>
		</div>
		
				
		
</article><!-- #post-## -->