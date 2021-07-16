<?php
/**
 * Home Page
 *
 * @package wpchill-theme
 */

get_header();
$count = 0;
$categories = get_categories();
?>
<?php get_search_form(); ?>
<div class="container pb-7 pb-md-10">
	<div class="row">
		<div class="col-12">
			<div class="row align-items-center">
				<div class="col-auto">
					<!-- Heading -->
					<h6 class="fw-bold text-uppercase text-muted mb-0"><?php esc_html_e('Categories:', 'wpchill-theme') ?></h6>
				</div>
				<div class="col ms-n5">
					<?php foreach ( $categories as $category ): ?>
						<a class="badge rounded-pill bg-secondary-soft" href="<?php echo get_category_link($category) ?>">
							<span class="h6 text-uppercase"><?php esc_html_e($category->name) ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<article>
	<div class="container">
		<div class="row">

			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {

					the_post();
					if ($count) {
						get_template_part( 'template-parts/element', 'post-excerpt-card' );
					} else {
						get_template_part( 'template-parts/element', 'post-excerpt-card-featured' );
					}
					$count++;
				}
			}
			?>

		</div>
	</div>
</article>

<?php get_footer(); ?>
