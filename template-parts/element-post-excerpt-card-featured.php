<?php
/**
 * Handler for search results to display nicely as a list
 *
 * @package wpchill-theme
 */

?>

<div class="col-12">
	<!-- Card -->
	<div class="card card-row shadow-light-lg mb-6 lift lift-lg">
		<div class="row gx-0">
		<div class="col-12">
			<!-- Badge -->
			<span class="badge rounded-pill bg-light badge-float badge-float-inside">
				<span class="h6 text-uppercase"><?php esc_html_e( 'Featured', 'wpchill-theme' ); ?></span>
			</span>
		</div>
		<?php if ( has_post_thumbnail() ) : ?>
		<!-- Image -->
			<a class="col-12 col-md-6 order-md-2 bg-cover card-img-end" href="<?php echo esc_url( get_permalink() ); ?>" style="background-image: url(<?php echo esc_attr( get_the_post_thumbnail_url() ); ?>);">

				<!-- Image -->
				<img src="<?php echo esc_attr( get_the_post_thumbnail_url() ); ?>" class="img-fluid d-md-none invisible">

				<!-- Shape -->
				<div class="shape shape-start shape-fluid-y text-white d-none d-md-block">
                    <svg viewBox="0 0 112 690" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h62.759v172C38.62 384 112 517 112 517v173H0V0z" fill="currentColor"></path></svg>                  
				</div>

			</a>
		<?php endif; ?>
			<div class="col-12 col-md-6 order-md-1">
				<!-- Body -->
				<a class="card-body" href="<?php echo esc_url( get_permalink() ); ?>">

					<!-- Heading -->
					<h3>
						<?php the_title(); ?>
					</h3>

					<!-- Text -->
					<p class="mb-0 text-muted">
						<?php the_excerpt(); ?>
					</p>

				</a>

				<!-- Meta -->
				<?php wpchill_base_theme_author(); ?>
			</div>
		</div>
	</div>

</div>
