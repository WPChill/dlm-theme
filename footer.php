<?php
/**
 * Footer
 *
 * @package wpchill-theme
 */

?>
<!-- FOOTER -->
<footer class="bg-gray-200 mt-5">
	<div class="position-relative">
		<div class="shape shape-bottom shape-fluid-x text-gray-200">
			<svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path></svg>      
		</div>
	</div>
	<section class="pt-10 pb-10">
	<div class="container pb-5">
	<h2 class="pb-5 footer-title">Looking For Help?</h2>
		<div class="row">
			<div class="col-12 col-md-4 ask">
				<!-- Heading -->
				<a href="/blog" class="footer-titles"><?php esc_html_e('Forum.', 'wpchill-theme'); ?></a>
				<!-- Text -->
				<p class="mb-6 mb-md-0 footer-description">
				For premium extension support simply reply to your purchase email. If you're looking for support for Download Monitor itself please use the community forum.
				</p>
			</div>

			<div class="col-12 col-md-4 ask">
				<!-- Heading -->
				<a class="footer-titles"><?php esc_html_e('Bugs.', 'wpchill-theme'); ?></a>
				<!-- Text -->
				<p class="mb-6 mb-md-0 footer-description">
				Found a bug? Please create an issue on GitHub.
				</p>
			</div>

			<div class="col-12 col-md-4 ask">
				<!-- Heading -->
				<a href="/contact/" class="footer-titles"><?php esc_html_e('Contact.', 'wpchill-theme'); ?></a>
				<!-- Text -->
				<p class="mb-6 mb-md-0 footer-description">
				For everything else, contact us.
				</p>
			</div>
		</div>
	</div>
</section>
<section class="pt-5 pb-5 links">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6">
				<div class="row">
					<div class="col-12 col-md-4">
						<a href="/my-account/edit-address/" class="mb-md-0 link">
						<?php esc_html_e('My account', 'wpchill-theme'); ?>
						</a>
					</div>
					<div class="col-12 col-md-4">
						<a href="/terms-conditions" class="mb-md-0 link">
						<?php esc_html_e('Terms & Conditions', 'wpchill-theme'); ?>
						</a>
					</div>
					<div class="col-12 col-md-4">
						<a href="/privacy-policy" class="mb-md-0 link">
						<?php esc_html_e('Privacy Policy', 'wpchill-theme'); ?>
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 ">
				<a href="/pricing/" class="link mr-0">
				Download Monitor is a WPChill plugin
				</a>
			</div>
		</div>
	</div>
</section>

</footer>
<?php if ( is_checkout() ) : ?>
<section class="mt-12">
	<div class="container-full p-0">
		<p class="text-center text-white bg-primary pb-4 pt-4 mb-0"><?php esc_html_e( 'Download Monitor is a WPChill plugin', 'woocommerce' ); ?></p>
	</div>
<section>
<?php endif; ?>

	<?php wp_footer(); ?>

</body>
