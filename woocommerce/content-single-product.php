<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
?>

<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}

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

if ( 'variable' == $product->get_type() || 'variable-subscription' == $product->get_type() ) {
	$variable = true;

	$available_variations = $product->get_available_variations();
	$attributes           = $product->get_variation_attributes();
//	$selected_attributes  = $product->get_variation_default_attributes();
	$selected_attributes  = $product->get_default_attributes();
}

?>
<div class="dlm-extension-cta"><p><i class="fas fa-gift"></i> Get <strong>$624</strong> worth of extensions for just <strong>$125</strong> with our <a href="/extensions/extension-bundle/"><strong>Extension Bundle!</strong></a></p></div>
<div itemscope itemtype="http://schema.org/Product"
	id="product-<?php the_ID(); ?>" <?php post_class(); ?> xmlns="http://www.w3.org/1999/html" style="position:relative">
	<!-- <div class="dlm-extension-detail-image"><?php //the_post_thumbnail( 'full' ); ?></div> -->
	<div class="dlm-extension-title"><h1><?php the_title(); ?></h1></div>
	<div class="dlm-extension-short-description"><?php echo the_excerpt(); ?></div>
	<div class="dlm-extension-detail-info">
		<div class="dlm-extension-info-box dlm-extension-info-box-license">
			<?php
			if ( $variable ) {

				$license_label = "License";
				$button_label  = "Add To Cart";
				if ( isset( $_GET['switch-subscription'] ) ) {
					$license_label = "Select new License";
					$button_label  = "Switch License";
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
												<label <?php echo ($selected_value == $term->slug ? 'class = "selected"' : '') ?> for="<?php esc_attr_e( $term->slug ) ?>"><?php echo apply_filters( 'woocommerce_variation_option_name', $term->name ); ?></label><br><?php
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
					<p class="license-add-to-cart">
						<button type="submit"
						        class="single_add_to_cart_button button alt"><i class="fa fa-shopping-cart" aria-hidden="true"></i><?php echo $button_label; ?></button>
					</p>

					<input type="hidden" name="add-to-cart" value="<?php echo $product->get_id(); ?>"/>
					<input type="hidden" name="product_id" value="<?php echo esc_attr( $product->get_id() ); ?>"/>
					<input type="hidden" name="variation_id" value=""/>

				</form>
				<?php
			} else {
				?>

				<p class="license-free">FREE</p>

				<form class="cart" method="post" enctype='multipart/form-data'>
					<p class="license-add-to-cart">
						<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"/>

						<button type="submit"
						        class="single_add_to_cart_button button alt"><?php echo ucwords( $product->single_add_to_cart_text() ); ?></button>
					</p>
				</form>

				<?php
			}
			?>
            <p class="license-copy">Licenses are yearly subscriptions, you can cancel at any time.<br/><br/>Personal licences are valid for <strong>one website</strong>, Business licenses for <strong>5 websites</strong> and a developer licence is valid for <strong>20 websites</strong>.</p>
			<?php /*<p class="license-copy">Licences grant one year support &amp; updates. Personal licences are valid for a single site, Business licenses for 5 sites and a developer licence is valid for 20 websites.</p>*/ ?>
		</div>

		<?php
		$documentation_slug = get_post_meta( get_the_ID(), 'documentation_slug', true );
		if ( '' !== $documentation_slug ) {
			?>
			<div class="dlm-extension-info-box dlm-extension-info-box-documentation">
				<a href="/kb/<?php echo $documentation_slug; ?>/" class="button"
				   title="<?php echo get_the_title() . ' Documentation'; ?>">Read Documentation</a>
			</div>
			<?php
		}

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
					<div class="dlm-extension-info-box dlm-extension-info-box-details extra-info">
						<table width="100" cellpadding="0" cellspacing="0">
							<?php

							// The Product Meta
							$product_meta = array(
								'_version' => 'Version',
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

		?>
	</div>
	<div class="dlm-extension-detail-copy">
		<?php
		if ( ! isset( $_GET['changelog'] ) ) {
			if ( '' != get_post_meta( $product->get_id(), 'dlm_video', true ) ) {
				?>
				<div class="dlm-product-video-container">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo get_post_meta( $product->get_id(), 'dlm_video', true ); ?>?vq=hd1080" frameborder="0" allowfullscreen></iframe>
				</div>
				<?php
			}
			?>
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
	<meta itemprop="url" content=" <?php the_permalink(); ?>"/>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
