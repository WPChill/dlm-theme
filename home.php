<?php
/**
 * Home Page
 *
 * @package wpchill-theme
 */

get_header();
$sticky = new WP_Query( array( 'post__in' => get_option( 'sticky_posts' ) ) );
?>
<?php get_search_form(); ?>
<?php wpchill_base_theme_categories() ?>
<article>
	<div class="container">
		<div class="row">

			<?php
			if ( $sticky->have_posts() ) {
				while ( $sticky->have_posts() ) {
					$sticky->the_post();
					get_template_part( 'template-parts/element', 'post-excerpt-card-featured' );
				}
			}
			
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
