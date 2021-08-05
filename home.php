<?php
/**
 * Home Page
 *
 * @package wpchill-theme
 */

get_header();
?>
<?php get_search_form(); ?>
<?php wpchill_base_theme_categories() ?>
<article>
	<div class="container">
		<div class="row">

			<?php

			if ( have_posts() ) {
				while ( have_posts() ){
					the_post();

					// Check if sticky or not
					if ( is_sticky( get_the_ID() ) ) {
						get_template_part( 'template-parts/element', 'post-excerpt-card-featured' );
					} else {
						get_template_part( 'template-parts/element', 'post-excerpt-card' );
					}

				}
			}
			?>

		</div>
	</div>
</article>

<?php get_footer(); ?>
