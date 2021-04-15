<?php
/**
 * The home page
 *
 * Template Name: Home
 *
 * @package dlm-theme
 */

get_header(); ?>

<div id="primary">


	<?php while ( have_posts() ) : the_post(); ?>

		<?php
		do_action( 'storefront_page_before' );
		?>

		<?php

		// dynamic home intro
		get_template_part( 'template-parts/home', 'intro' );

		// include home
		include( ABSPATH . '/wp-content/never5/home.php' );

//					get_template_part( 'template-parts/home', 'features' );
		?>

		<?php
		/**
		 * @hooked storefront_display_comments - 10
		 */
		do_action( 'storefront_page_after' );
		?>

	<?php endwhile; // end of the loop. ?>

		
</div><!-- #primary -->

<?php get_footer(); ?>
