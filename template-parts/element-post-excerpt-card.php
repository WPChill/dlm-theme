<?php
/**
 * Handler for search results to display nicely as a list
 *
 * @package wpchill-theme
 */

?>

<div class="col-12 col-md-6 col-lg-4 d-flex">
	<!-- Card -->
	<div class="card mb-6 shadow-light-lg lift lift-lg df-jc-sb">
		<?php if ( has_post_thumbnail() ) : ?>
			<!-- Image -->
			<a class="card-img-top" href="<?php echo esc_url( get_permalink() ); ?>">

				<!-- Image -->
				<img src="<?php echo esc_attr( get_the_post_thumbnail_url() ); ?>" alt="..." class="card-img-top">

				<!-- Shape -->
				<div class="position-relative">
					<div class="shape shape-bottom shape-fluid-x svg-shim text-white">
						<svg viewBox="0 0 2880 480" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd"
								  d="M2160 0C1440 240 720 240 720 240H0v240h2880V0h-720z" fill="currentColor"></path>
						</svg>
					</div>
				</div>

			</a>
		<?php endif; ?>
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
