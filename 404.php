<?php get_header();
/**
 * 404 Handler
 *
 * @package wpchill-theme
 */
?>
<section>
	<div class="container d-flex flex-column">
		<div class="row align-items-center justify-content-center gx-0 min-vh-100">
			<div class="col-12 col-md-5 col-lg-4 py-8 py-md-11">

				<!-- Heading -->
				<h1 class="display-3 fw-bold text-center">
					Uh Oh.
				</h1>

				<!-- Text -->
				<p class="mb-5 text-center text-muted">
					We ran into an issue, but don’t worry, we’ll take care of it for sure.
				</p>

				<!-- Link -->
				<div class="text-center">
					<a class="btn btn-primary" href="<?php echo esc_url( get_home_url() ); ?>">
						Back to safety
					</a>
				</div>

			</div>
		</div> <!-- / .row -->
	</div> <!-- / .container -->
</section>
