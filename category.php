<?php
/**
 * Category template
 *
 * @package wpchill-theme
 */

$categories = get_categories();
?>

<?php get_header(); ?>
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

<section class="main">
	<div class="container">
		<div class="row">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
					<?php
					the_post();
					get_template_part( 'template-parts/element', 'post-excerpt-card' );
					?>
				<?php endwhile; ?>
			<?php else : ?>
				<?php echo esc_html__( 'Sorry, no posts found', 'wpchill-theme' ); ?>
			<?php endif; ?>
		</div>

		<div class="row">
			<div class="col-xs-12 text-center">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 1,
						'prev_text' => '',
						'next_text' => '',
					)
				);
				?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
