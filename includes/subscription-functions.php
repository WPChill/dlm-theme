<?php

add_action( 'woocommerce_subscription_details_after_subscription_table', function ( $subscription ) {
	// get licenses of current subscription
	$licenses = license_wp()->service( 'license_manager' )->get_licenses_by_order( $subscription->get_parent_id() );

	if ( count( $licenses ) > 0 ) {
		wc_get_template( 'my-licenses.php', array( 'licenses' => $licenses ), 'license-wp', license_wp()->service( 'file' )->plugin_path() . '/templates/' );
	}
}, 1 );

// set 'upgrading_key' key when a 'subscription_switch' is initialized
add_filter( 'woocommerce_add_cart_item_data', function ( $cart_item_data, $product_id, $variation_id ) {
	unset( $cart_item_data['subscription_change_key'] );
	if ( isset( $cart_item_data['subscription_switch'] ) ) {

		$subscription = wcs_get_subscription( absint( $cart_item_data['subscription_switch']['subscription_id'] ) );
		if ( false != $subscription ) {

			// fetch license of parent order
			$licenses = license_wp()->service( 'license_manager' )->get_licenses_by_order( $subscription->get_parent_id() );

			if ( ! empty( $licenses ) ) {
				$license = array_shift( $licenses );

				// set renewing key
				$cart_item_data['subscription_change_key'] = $license->get_key();
			}

		}

	}

//	error_log(print_r($cart_item_data,1),0);

	return $cart_item_data;
}, 11, 3 );

// remove notice on check out sub change
add_filter( 'woocommerce_add_notice', function ( $message ) {
	if ( 'Choose a new subscription.' == $message ) {
		$message = '';
	}

	return $message;
}, 10, 1 );

add_filter( 'woocommerce_get_cart_item_from_session', function ( $cart_item, $values ) {
	if ( isset( $values['subscription_change_key'] ) ) {
		$cart_item['subscription_change_key'] = $values['subscription_change_key'];
	}

	return $cart_item;
}, 10, 2 );


add_action( 'woocommerce_checkout_create_order_line_item', function ( $order_item, $cart_item_key, $cart_item, $order ) {
	if ( isset( $cart_item['subscription_change_key'] ) ) {
		$order_item->add_meta_data( '_subscription_change_key', $cart_item['subscription_change_key'] );
	}
}, 10, 4 );

// filter upgrading key in LWP/WooCommerce/Order to be our custom 'change_key'
add_filter( 'lwp_order_upgrading_key', function ( $_upgrading_key, $item ) {
	foreach ( $item['item_meta'] as $meta_key => $meta_value ) {
		if ( $meta_key == '_subscription_change_key' ) {
			$_upgrading_key = $meta_value;
		}
	}

	return $_upgrading_key;
}, 10, 2 );

// don't update date on upgrade, we set it after subscription switch is done
add_filter( 'lwp_upgrade_update_date_expires', 'lwp_do_not_update_order_data_on_sub_switch', 10, 4 );
add_filter( 'lwp_upgrade_update_order_id', 'lwp_do_not_update_order_data_on_sub_switch', 10, 4 );

/**
 * @param bool $should_update
 * @param Never5\LicenseWP\License\License $license
 * @param \WC_Order $order
 * @param array $item
 *
 * @return mixed
 */
function lwp_do_not_update_order_data_on_sub_switch( $should_update, $license, $order, $item ) {

	// check if a '_subscription_change_key' is set in this item.
	// If this is set, we do NOT want to update specific license data
	if ( ! empty( $item ) ) {
		foreach ( $item['item_meta'] as $meta_key => $meta_value ) {
			if ( $meta_key == '_subscription_change_key' ) {
				return false;
			}
		}
	}

	return $should_update;
}

// set new license expiry date after subscription is 'switched'
add_action( 'woocommerce_subscriptions_switch_completed', function ( $order ) {

	$subscriptions = wcs_get_subscriptions_for_order( $order->get_id() );
	if ( ! empty( $subscriptions ) ) {

		/** @var \WC_Subscription $subscription */
		foreach ( $subscriptions as $subscription ) {

			// set subscription next payment date in datetime object
			$date_expires = new \DateTime( $subscription->get_date( "next_payment", "UTC" ) );
			$date_expires->setTime( 0, 0, 0 );

			// fetch licenses of sub parent order
			$licenses = license_wp()->service( 'license_manager' )->get_licenses_by_order( $subscription->get_parent_id() );

			if ( ! empty( $licenses ) ) {
				/** @var \Never5\LicenseWP\License\License $license */
				foreach ( $licenses as $license ) {

					// set new expiry date
					$license->set_date_expires( $date_expires );

					// perist license
					license_wp()->service( 'license_repository' )->persist( $license );
				}
			}
		}
	}

}, 10, 1 );

// remove default 'renewal date' notice
remove_filter( 'wcs_cart_totals_order_total_html', 'wcs_add_cart_first_renewal_payment_date', 10, 2 );

// add custom 'renewal date' notice
/**
 * @param string $order_total_html
 * @param \WC_Cart $cart
 *
 * @return string
 */
function rp4wp_add_cart_first_renewal_payment_date( $order_total_html, $cart ) {

	$items = $cart->get_cart();
	if ( ! empty( $items ) ) {
		$item = array_shift( $items );
		if ( ! empty( $item['subscription_change_key'] ) ) {
			if ( 0 !== $cart->next_payment_date ) {
				$first_renewal_date = date_i18n( wc_date_format(), wcs_date_to_time( get_date_from_gmt( $cart->next_payment_date ) ) );
				// translators: placeholder is a date
				$order_total_html .= '<div class="first-payment-date"><small>' . sprintf( __( 'First renewal: %s', 'woocommerce-subscriptions' ), $first_renewal_date ) . '</small></div>';
			}
		}
	}

	return $order_total_html;
}

add_filter( 'wcs_cart_totals_order_total_html', 'rp4wp_add_cart_first_renewal_payment_date', 10, 2 );