<?php

add_filter( 'lwp_print_licenses_on_dashboard', function () {
	return false;
} );

// Dirty way of retrieving legacy licenses. TODO: Remove this a year from sub launch :)
function lwp_print_legacy_licenses() {

	// get licenses of current user
	$licenses = license_wp()->service( 'license_manager' )->get_licenses_by_user( get_current_user_id() );

	foreach ( $licenses as $lk => $license ) {

		/** @var \Never5\LicenseWP\License\License $license */

		$product_id = absint( $license->get_product_id() );

		if ( $product_id > 0 ) {
			$product = wc_get_product( $product_id );

			if ( $product !== false ) {
				if ( $product instanceof WC_Product_Subscription_Variation && 'trash' != $product->get_status() ) {
					unset( $licenses[ $lk ] );
				}
			}
		}

	}


	if ( count( $licenses ) > 0 ) {
//		ob_start();
		wc_get_template( 'my-legacy-licenses.php', array( 'licenses' => $licenses ), 'license-wp', license_wp()->service( 'file' )->plugin_path() . '/templates/' );
//		$content = ob_get_clean();
//		$content = str_replace( "<h2>Licenses</h2>", "<h2>Legacy Licenses</h2>", $content );
//		echo $content;
	}
}

add_action( 'woocommerce_before_my_account', 'lwp_print_legacy_licenses' );

/**
 * Catch legacy renewal actions.
 * Instead of letting LicenseWP renewal kick in, we fill the cart with a yearly subscription
 *  that has the same site activation limit as their legacy license
 */
function lwp_catch_legacy_renewal_action() {
	if ( isset( $_GET['renew_license'] ) && isset( $_GET['activation_email'] ) ) {

		// get license
		/** @var \Never5\LicenseWP\License\License $license */
		$license = license_wp()->service( 'license_factory' )->make( $_GET['renew_license'] );

		// check if license if found
		if ( '' != $license->get_key() ) {

			// fetch parent product
			/** @var WC_Product_Variable_Subscription $parent_product */
			$parent_product = wc_get_product( get_post( $license->get_product_id() )->post_parent );
			if ( is_null( $parent_product ) || false === $parent_product ) {
				return;
			}

			// get variations
			$variation_ids = $parent_product->get_children();

			// we need at least 1
			if ( empty( $variation_ids ) ) {
				return;
			}

			// set first sub license as default, so when we find no exact match they get a personal license
			$new_variation_id = $variation_ids[0];

			// search for match
			foreach ( $variation_ids as $variation_id ) {
				$activation_limit = get_post_meta( $variation_id, '_license_activation_limit', true );

				// check if activation limit of new variation equals limit of license
				if ( $activation_limit == $license->get_activation_limit() ) {
					// they're equal so this new license is the sub version of the legacy license
					$new_variation_id = $variation_id;
					break;
				}
			}

			// get variation data
			$new_variation_data = $parent_product->get_available_variation( wc_get_product( $new_variation_id ) );

			// empty cart
			WC()->cart->empty_cart();

			// add new sub license to cart
			WC()->cart->add_to_cart(
				$parent_product->get_id(),
				1,
				$new_variation_id,
				array(
					'attribute_pa_license' => ucfirst( $new_variation_data['attributes']['attribute_pa_license'] )
				),
				array(
					'lwp_legacy_license' => $license->get_key()
				)
			);

			// redirect to checkout
			wp_redirect( wc_get_checkout_url(), 307 );
		}

		exit;
	}
}

add_action( 'wp', 'lwp_catch_legacy_renewal_action', 5 );

add_filter( 'woocommerce_get_cart_item_from_session', function ( $cart_item, $values ) {
	if ( isset( $values['lwp_legacy_license'] ) ) {
		$cart_item['lwp_legacy_license'] = $values['lwp_legacy_license'];
	}

	return $cart_item;
}, 10, 2 );


add_action( 'woocommerce_checkout_create_order_line_item', function ( $order_item, $cart_item_key, $cart_item, $order ) {
	if ( isset( $cart_item['lwp_legacy_license'] ) ) {
		$order_item->add_meta_data( '_lwp_legacy_license', $cart_item['lwp_legacy_license'] );
	}
}, 10, 4 );

// check if we have a '_lwp_legacy_license' key and set the $_upgrading_key in LWP Order License generation process if we do
add_filter( 'lwp_order_upgrading_key', function ( $_upgrading_key, $item ) {
	foreach ( $item['item_meta'] as $meta_key => $meta_value ) {
		if ( $meta_key == '_lwp_legacy_license' ) {
			$_upgrading_key = $meta_value;
		}
	}

	return $_upgrading_key;
}, 10, 2 );

// don't send our custom manual renewal reminder emails to subs
function rp4wp_filter_legacy_renewal_emails( $licenses, $email_data, $date ) {

	$sub_launch_date = lwp_get_subscription_launch_date();

	/**
	 * @var int $lk
	 * @var \Never5\LicenseWP\License\License $license
	 */
	foreach ( $licenses as $lk => $license ) {
		if ( $license->get_date_created() > $sub_launch_date ) {
			unset( $licenses[ $lk ] );
		}
	}

	return $licenses;
}

add_filter( 'license_wp_renewal_emails_licenses', 'rp4wp_filter_legacy_renewal_emails', 10, 3 );