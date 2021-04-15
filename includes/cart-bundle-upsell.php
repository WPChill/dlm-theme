<?php

/**
 * Get bundle value
 *
 * @param String $license
 *
 * @return int
 */
function dlm_get_bundle_value( $license ) {
	return get_post_meta( DLM_BUNDLE_ID, 'value_' . $license, true );
}

function dlm_cart_display_bundle_notice() {

	// check if is WC cart page
	if ( ! is_cart() ) {
		return false;
	}

	if ( ! defined( 'DLM_BUNDLE_ID' ) ) {
		return false;
	}

	// get cart
	$cart = WC()->cart->get_cart();

	// only continue if the cart has contents
	if ( ! is_array( $cart ) || 0 === count( $cart ) ) {
		return false;
	}

	// get cart product ids
	$cart_product_ids = array();
	foreach ( $cart as $cart_item ) {
		$cart_product_ids[] = $cart_item['product_id'];
	}

	// abort if bundle isn't in cart already
	if ( in_array( DLM_BUNDLE_ID, $cart_product_ids ) ) {
		return false;
	}

	// bundle products
	$bundle_products = explode( ',', get_post_meta( DLM_BUNDLE_ID, 'bundle_products', true ) );

	// exit no bundle products set
	if ( ! is_array( $bundle_products ) || 0 === count( $bundle_products ) ) {
		return false;
	}

	// get products in cart that are bundle products
	$bundle_products_in_cart = array_intersect( $cart_product_ids, $bundle_products );

	// calc total cost of bundle items in cart
	$bundle_products_in_cart_cost = 0;

	// first product license
	$product_license = '';

	// loop
	foreach ( $cart as $cart_item ) {
		if ( ! in_array( $cart_item['product_id'], $bundle_products_in_cart ) ) {
			continue;
		}
		$bundle_products_in_cart_cost += $cart_item['line_subtotal'];

		// set product license
		if ( '' === $product_license ) {
			$product_license = $cart_item['variation']['attribute_pa_license'];
		}
	}

	/** @var WC_Product_Variable $product */
	$product = wc_get_product( DLM_BUNDLE_ID );

	if ( false == $product ) {
		return;
	}

	// find variation price
	$variation_bundle_price = 0;
	foreach ( $product->get_available_variations() as $variation ) {
		if ( $variation['attributes']['attribute_pa_license'] == $product_license ) {
			$variation_bundle_price = $variation['display_price'];
			break;
		}
	}

	// calculate difference
	$upgrade_difference = $variation_bundle_price-$bundle_products_in_cart_cost;

	// only display notice if difference is bigger than 1
	if( $upgrade_difference < 1 ) {
		return false;
	}

	// display notice
	?>
	<div class="extension-bundle-notice">
		<div class="ebn-icon-wrapper"><i class="fa fa-bullhorn"></i></div>
		<p>Before you order! You can get <strong><?php echo ( count( $bundle_products ) - count( $bundle_products_in_cart ) ); ?> extra extensions</strong> for <strong>just $<?php echo $upgrade_difference; ?></strong></strong> extra!</p>
		<a href="<?php echo wc_get_cart_url(); ?>?do_bundle=1" class="button">Add the Extension Bundle to my cart→</a>
	</div>
<?php
}

add_action( 'woocommerce_before_cart', 'dlm_cart_display_bundle_notice', 10 );

function dlm_catch_bundle_upgrade() {
	if ( isset( $_GET['do_bundle'] ) ) {

		// check if is WC cart page
		if ( ! is_cart() ) {
			return false;
		}

		// get cart
		$cart = WC()->cart->get_cart();

		// get cart product ids
		$cart_product_ids = array();
		foreach ( $cart as $cart_item ) {
			$cart_product_ids[] = $cart_item['product_id'];
		}

		// bundle products
		$bundle_products = explode( ',', get_post_meta( DLM_BUNDLE_ID, 'bundle_products', true ) );

		// exit no bundle products set
		if ( ! is_array( $bundle_products ) || 0 === count( $bundle_products ) ) {
			return false;
		}

		// get products in cart that are bundle products
		$bundle_products_in_cart = array_intersect( $cart_product_ids, $bundle_products );

		// first product license
		$product_license = '';

		// loop
		foreach ( $cart as $cart_item_key => $cart_item ) {
			if ( ! in_array( $cart_item['product_id'], $bundle_products_in_cart ) ) {
				continue;
			}

			// remove item from cart
			WC()->cart->remove_cart_item( $cart_item_key );

			// set product license
			if ( '' === $product_license ) {
				$product_license = $cart_item['variation']['attribute_pa_license'];
			}
		}

		/** @var WC_Product_Variable $product */
		$product = wc_get_product( DLM_BUNDLE_ID );

		// Find correct variation ID and add to cart
		foreach ( $product->get_available_variations() as $variation ) {
			if ( $variation['attributes']['attribute_pa_license'] == $product_license ) {

				// Add bundle to cart
				WC()->cart->add_to_cart( DLM_BUNDLE_ID, 1, $variation['variation_id'], array( 'License' => ucfirst( $product_license ) ) );

				break;
			}
		}

		// add success message
		wc_add_notice( "Bundle added to cart! We've automatically removed products that are included in the bundle!", 'success' );

		wp_redirect( wc_get_cart_url(), 302 );
		exit();
	}
}

add_action( 'wp', 'dlm_catch_bundle_upgrade' );