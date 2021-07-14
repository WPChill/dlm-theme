<?php
/**
 * Category template
 *
 * @package wpchill-theme
 */

?>

<?php get_header(); ?>
<?php get_search_form(); ?>
<h1>hello</h1>
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
