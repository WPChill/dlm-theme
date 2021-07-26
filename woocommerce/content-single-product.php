<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

// Enqueue variation scripts
wp_enqueue_script( 'wc-add-to-cart-variation' );

/** @var WC_Product_Variable_Subscription $product */
global $product;

//$available_variations
$variable = false;

// defaults
$available_variations = array();
$attributes = array();
$selected_attributes = array();
$bundle = false;

if ( 'variable' == $product->get_type() || 'variable-subscription' == $product->get_type() ) {
	$variable = true;

	$available_variations = $product->get_available_variations();
	$attributes           = $product->get_variation_attributes();
//	$selected_attributes  = $product->get_variation_default_attributes();
	$selected_attributes  = $product->get_default_attributes();
}

if ($product->get_id() == DLM_BUNDLE_ID) {
	$bundle = true;
}

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<section class="woocommerce-products-header">
	<section class="extension-header pt-6 pb-6 bg-primary">
		<div class="container align-items-center">
			<div class="text-center cta-bundle">
				<span><img class="icon" width="35" height="30" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/box.png" /></span>
				<span class="mb-0 text-white">Get $624 worth of extensions for just $125 with our <a class="extension-bundle-link text-decoration-none" href="/extensions/extension-bundle/">Extension Bundle!</a></span>
			</div>
		</div>
	</section>
	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</section>

<div class="container">
	<?php the_title( '<h1 class="extension-title product_title entry-title text-center mt-7">', '</h1>' ); ?>
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
		<div class="extension-short-description mb-7"><?php esc_html_e( the_excerpt() ); ?></div>
		<div class="row extension-details-container">
			<div class="wpchill-extension-detail-info col-12 col-md-12 col-lg-4 order-md-2 pb-6">
				<div class="wpchill-extension-info-box wpchill-extension-info-box-bundle bg-primary text-white text-center p-8" style="display: <?php echo ( !$bundle ? 'block' : 'none' ) ?>">
					<span><img class="icon mb-4" width="35" height="30" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/buy.png" /></span>
					<h3 class='purchase-extension-title'><?php esc_html_e('Purchase Extension', 'wpchill-theme'); ?></h3>
					<p class='purchase-extension-description mb-0'><?php esc_html_e( 'Get all of our extensions, save money, and keep your files organized.', 'wpchill-theme' ); ?></p><br>
					<a href="/extensions/extension-bundle/" class="bundle-button btn btn-primary mb-2 wpchill-purchase-sidebar-button"><?php esc_html_e( 'BUNDLE & SAVE', 'wpchill-theme' ); ?></a><br>
					<span>...<?php esc_html_e( 'or,', 'wpchill-theme' ); ?> <a href="#" id="extension-only" class="text-white"><?php esc_html_e( 'just purchase this extension', 'wpchill-theme' ); ?></a>.</span>
				</div>
				<div class="wpchill-extension-info-box wpchill-extension-info-box-license bg-primary text-white p-8" style="display: <?php echo ( $bundle ? 'block' : 'none' ) ?>">
					<?php
					if ( $variable ) {
						$license_label = 'License';
						$button_label  = 'Add To Cart';
						if ( isset( $_GET['switch-subscription'] ) ) {
							$license_label = 'Select new License';
							$button_label  = 'Switch License';
						}
						?>
						<form class="variations_form cart" method="post" enctype='multipart/form-data'
							data-product_id="<?php the_ID(); ?>"
							data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">

							<?php if ( ! empty( $available_variations ) ) { ?>
								<!-- <p class="license-label"><?php //echo $license_label; ?>:</p> -->
								<p class="license-select variations">
									<?php $loop = 0;
									foreach ( $attributes as $name => $options ) : $loop ++; ?>
										<fieldgroup id="<?php esc_attr_e( sanitize_title( $name ) ); ?>">
											<?php
											if ( is_array( $options ) ) {

												if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
													$selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
												} elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
													$selected_value = $selected_attributes[ sanitize_title( $name ) ];
												} else {
													$selected_value = '';
												}

												// Get terms if this is a taxonomy - ordered
												if ( taxonomy_exists( sanitize_title( $name ) ) ) {

													$orderby = wc_attribute_orderby( sanitize_title( $name ) );

													switch ( $orderby ) {
														case 'name' :
															$args = array(
																'orderby'    => 'name',
																'hide_empty' => false,
																'menu_order' => false
															);
															break;
														case 'id' :
															$args = array(
																'orderby'    => 'id',
																'order'      => 'ASC',
																'menu_order' => false,
																'hide_empty' => false
															);
															break;
														case 'menu_order' :
															$args = array( 'menu_order' => 'ASC', 'hide_empty' => false );
															break;
													}

													$terms = get_terms( sanitize_title( $name ), $args );

													foreach ( $terms as $term ) {
														if ( ! in_array( $term->slug, $options ) ) {
															continue;
														} ?>
															<input <?php echo ($selected_value == $term->slug ? 'checked' : '' ) ?> type="radio" id="<?php esc_attr_e( $term->slug ) ?>" name="attribute_<?php echo sanitize_title( $name ); ?>" value="<?php esc_attr_e( $term->slug ) ?>">
															<label <?php echo ($selected_value == $term->slug ? 'class = "selected"' : '') ?> for="<?php esc_attr_e( $term->slug ) ?>"><?php echo apply_filters( 'woocommerce_variation_option_name', $term->name ); ?></label><br>
														<?php
													}
												}
											}
											?>
										</fieldgroup>
									<?php endforeach; ?>
								</p>

								<?php
							}
							?>
							<p class="license-add-to-cart text-center">
								<button type="submit" class="single_add_to_cart_button button alt bundle-button btn btn-primary mb-2 text-uppercase"><?php echo esc_html( $button_label ); ?></button>
							</p>

							<input type="hidden" name="add-to-cart" value="<?php echo $product->get_id(); ?>"/>
							<input type="hidden" name="product_id" value="<?php echo esc_attr( $product->get_id() ); ?>"/>
							<input type="hidden" name="variation_id" value=""/>

						</form>
						<?php
					} else {
						?>

						<p class="license-free"><?php esc_html_e('FREE', 'wpchill-theme') ?></p>

						<form class="cart" method="post" enctype='multipart/form-data'>
							<p class="license-add-to-cart">
								<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"/>

								<button type="submit"
										class="single_add_to_cart_button button alt"><?php echo ucwords( $product->single_add_to_cart_text() ); ?></button>
							</p>
						</form>

						<?php
					}
					?><p class="license-copy"><?php esc_html_e('Licenses are yearly subscriptions, you can cancel at any time.') ?></p>
				</div>

				<div class="text-center mt-4">
				<?php
				// Get API product
				$api_raw = get_post_meta( $product->get_id(), '_api_product_permissions', true );

				if ( '' !== $api_raw ) {

					// Remove brackets
					$api_ids = json_decode( $api_raw );

					if ( 1 === count( $api_ids ) ) {
						$api_id = array_shift( $api_ids );

						// Check if we've got an integer
						if ( is_integer( $api_id ) && $api_id > 0 ) {

							?>
							<div class="wpchill-extension-info-box wpchill-extension-info-box-details extra-info">
								<table width="100" cellpadding="0" cellspacing="0">
									<?php

									// The Product Meta
									$product_meta = array(
										'_version' => 'Version:',
									);

									// Loop through the meta
									foreach ( $product_meta as $key => $label ) {
										$meta_value = get_post_meta( $api_id, $key, true );
										if ( '' !== $meta_value ) {
											?>
											<tr>
												<th><?php echo $label; ?></th>
												<td><?php echo $meta_value; ?></td>
											</tr>
											<?php
										}
									}
									?>
								</table>
							</div>
							<?php
						}
					}
				}
				// Documentation link
				$documentation_slug = get_post_meta( get_the_ID(), 'documentation_slug', true );
				if ( '' !== $documentation_slug ) {
					?>
					<div class="wpchill-extension-info-box wpchill-extension-info-box-documentation read-doc">
						<a href="/kb/<?php echo $documentation_slug; ?>/" class=""
						title="<?php echo get_the_title() . ' Documentation'; ?>">Read Documentation</a>
					</div>
					<?php
				} 
				?>
				</div>
			</div>
			<div class="wpchill-extension-detail-copy col-12 col-md-12 col-lg-8 order-md-1">
			<?php
				if ( ! isset( $_GET['changelog'] ) ) {
					if ( '' != get_post_meta( $product->get_id(), 'wpchill_video', true ) ) { ?>
						<div class="wpchill-product-video-container">
							<iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo get_post_meta( $product->get_id(), 'wpchill_video', true ); ?>?vq=hd1080" frameborder="0" allowfullscreen></iframe>
						</div>
					<?php } ?>
					<?php the_content(); ?>
					<?php //never5_single_after_content_cta( $product ); ?>
					<?php
				} else {
					// Check if we've got an integer
					if ( isset( $api_id ) && is_integer( $api_id ) && $api_id > 0 ) {

						$changelog = get_post_meta( $api_id, '_changelog', true );
						if ( '' !== $changelog ) {

							echo '<h1>' . get_the_title() . ' Changelog</h1>';

							// Format changelog
							$changelog = preg_replace( "/####?[ ]?([0-9\.]+): ([A-Z0-9 ,]+)/i", "<h2>$1</h2>" . PHP_EOL . "<i>$2</i>" . PHP_EOL . "<ul>", $changelog );
							$changelog = preg_replace( "/\* ([A-Z0-9 \._,\:'\(\)\/\-&\{\}\"\'\%]+)/i", "<li>$1</li>", $changelog );
							$changelog = preg_replace( "/" . PHP_EOL . "<h2>/i", "</ul>" . PHP_EOL . PHP_EOL . "<h2>", $changelog );
							$changelog .= PHP_EOL . "</ul>";

							echo '<div class="changelog">' . $changelog . '</div>' . PHP_EOL;
						} else {
							echo '<p>Whoops, no changelog found. Please do <a href="/contact/">let us know</a> about this issue!</p>' . PHP_EOL;
						}
					}
				} 
			?>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
