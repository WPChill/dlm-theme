<?php
/**
 * Search template
 *
 * @package wpchill-theme
 */

?>
<?php get_header(); ?>
<?php get_search_form(); ?>
<div id="main" class="main">
	<div class="container">
		<div class="row">
			<?php
			if ( have_posts() ) :
				?>
				<?php
				while ( have_posts() ) :
					the_post();
					/* Make sure the template is your content.php */
					get_template_part( 'template-parts/element', 'post-excerpt-card' );

				endwhile;

				the_posts_navigation();

				?>

					<?php

					else :
						/* Show no content found page */
						?>
						<div class="row">
						<p> <?php echo esc_html__( 'No Posts Found', 'wpchill-theme' ); ?></p>
						</div>
						<?php

					endif;
					?>
			</div>
	</div>
</div>

<?php get_footer(); ?>
