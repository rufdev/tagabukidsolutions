<?php
/**
 * The front page template file.
 *
 * @package haxel
 */

get_header('front'); ?>

	<div id="primary" class="content-areas <?php do_action('haxel_primary-width') ?>">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 */
					do_action('haxel_blog_layout'); 
					
				?>

			<?php endwhile; ?>

			<?php haxel_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
