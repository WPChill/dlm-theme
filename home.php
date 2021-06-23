<?php
/**
 * Home Page
 *
 * @package wpchill-theme
 */

get_header();
?>
<?php get_search_form(); ?>
<article>
	<div class="container">
		<div class="row">


			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {

					the_post();
					get_template_part( 'template-parts/element', 'post-excerpt-card' );
				}
			}

			?>
		</div>
	</div>
</article>

<?php get_footer(); ?>
