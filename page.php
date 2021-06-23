<?php
/**
 * Page Handler
 *
 * @package wpchill-theme
 */

?>
<?php get_header(); ?>
<?php get_template_part( 'template-parts/element', 'page-header' ); ?>

<div id="main" class="main">
	<div class="container">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) :
				the_post();
				?>
		<article>

			<section class="pt-8 pt-md-11">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-12 col-md-10 col-lg-9 col-xl-8">
						<?php if ( has_post_thumbnail() ) : ?>
							<figure class="figure mb-7">

								<!-- Image -->
								<img class="figure-img img-fluid rounded lift lift-lg" src="<?php echo esc_attr( get_the_post_thumbnail_url() ); ?>" >

								<!-- Caption -->
								<figcaption class="figure-caption text-center">
									<?php echo esc_html( get_the_post_thumbnail_caption() ); ?>
								</figcaption>

							</figure>
						<?php endif; ?>
							<!-- Heading -->

							<?php echo the_title( '<h1 class="display-4 text-center">', '</h1>' ); // phpcs:ignore ?>

						</div>
					</div> <!-- / .row -->
				</div> <!-- / .container -->
			</section>

			<!-- Content -->
				<?php get_template_part( 'template-parts/element', 'page-content' ); ?>

		</article>

	</div>
</div>
				<?php
			endwhile;
		};
		?>


<?php get_footer(); ?>
