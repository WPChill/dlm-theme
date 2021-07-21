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

<section class="pt-2 pb-2 links">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<?php
				wp_nav_menu( array( 
					'theme_location' => 'footer-menu',
					'container'      => '',
					'items_wrap'     =>'<ul class="navbar-nav link">%3$s</ul>',
					) );
				?>
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
