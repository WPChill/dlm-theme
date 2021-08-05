<?php
/**
 * Sidebar template
 *
 * @package wpchill-theme
 */

/*
* Template Name: Sidebar Template
*/
get_header(); ?>
<?php get_template_part( 'template-parts/element', 'page-header' ); ?>

	<div id="main" class="main">
		<section class="pt-8 pt-md-11">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-12 col-lg-12 col-xl-12">
						<!-- Heading -->
						<?php echo the_title( '<h1 class="display-4">', '</h1>' ); ?>
						<p class="fs-lg text-gray-700 mb-10"><?php esc_html_e( 'Updated: ', 'wpchill-theme' ) . the_date( 'm/d/Y', ); ?></p>
					</div>
				</div> <!-- / .row -->
			</div> <!-- / .container -->
		</section>

		<div class="container">
			<div class="row">
				<div class="col-12 col-md-8 col-lg-8 col-xl-8">
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) :
							the_post();
							?>
							<article>

								<?php the_content(); ?>

							</article>
						<?php
						endwhile;
					}
					?>
				</div>

				<div class="col-12 col-md-4 col-lg-4 col-xl-4">
					<!-- Card -->
					<div class="card shadow-light-lg">
						<div class="card-body">
							<!-- Heading -->
							<h4>
								Have a question?
							</h4>
							<!-- Text -->
							<p class="fs-sm text-gray-800 mb-5">
								Not sure exactly what we’re looking for or just want clarification? We’d be happy to
								chat
								with you and clear things up for you. Anytime!
							</p>
							<!-- Heading -->
							<h6 class="fw-bold text-uppercase text-gray-700 mb-2">
								Email us
							</h6>
							<!-- Text -->
							<p class="fs-sm mb-0">
								<a href="mailto:support@wpchill.com" class="text-reset">support@wpchill.com</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>