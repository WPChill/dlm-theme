<?php
/**
 * Element Page Content Template
 *
 * @package wpchill-theme
 */

?>
<section class="pt-6 pt-md-8 <?php echo ( is_checkout() ? 'col-md-8 mx-auto' : '' ); ?>">
	<div class="container">
		<?php the_content(); ?>
	</div>
</section>

<?php if ( is_checkout() ) : ?>
<div class="checkout-footer col-md-5 mx-auto mt-8">
	<h4 class="text-center"><?php esc_html_e( 'What happens next?', 'woocommerce' ); ?></h4>
	<p class="text-center"><?php esc_html_e( "After you've completed your payment you'll receive an email containing your license keys and a download links.", 'woocommerce' ); ?></p>
</div>
<?php endif ?>
