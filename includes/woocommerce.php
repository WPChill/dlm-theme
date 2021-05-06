<?php

// 3 Columns
function dlm_shop_columns( $columns ) {
	return 3;
}

add_filter( 'loop_shop_columns', 'dlm_shop_columns', 50 );

// Remove Price in loop
remove_filter( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );

// Remove rating in loop
remove_filter( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating' );

// Remove button in loop
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );

// Add short description to loop
function dlm_shop_loop_short_description() {
	$post = get_post();
	echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
}

add_action( 'woocommerce_after_shop_loop_item', 'dlm_shop_loop_short_description' );

function dlm_shop_loop_price_more_btn() {
	$post    = get_post();
	$product = wc_get_product( $post->ID );

	$price_label = '';
	if ( $product->get_price() > 0 ) {
		$price_label = '$' . $product->get_price();
	} else {
		$price_label = 'FREE';
	}


	echo '<div class="product_footer">';
	echo '<p class="loop_price">' . $price_label . '</p>';
	echo '<a href="' . get_permalink( $post->ID ) . '" class="loop_more">Read More</a>';
	echo '</div>' . PHP_EOL;
}

add_action( 'woocommerce_after_shop_loop_item', 'dlm_shop_loop_price_more_btn' );

// Remove result count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// Remove sort select box
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Display prices in variation select
add_filter( 'woocommerce_variation_option_name', 'display_price_in_variation_option_name' );

function display_price_in_variation_option_name( $term ) {
	global $wpdb, $product;

	// don't display in admin and checkout
	if ( is_admin() || is_checkout() ) {
		return $term;
	}

	if ( is_null( $product ) ) {
		error_log( sprintf( "Product is NULL on %s", $term ), 0 );

		return $term;
	}

	$lc_term = strtolower( $term );
	$attributes = $product->get_available_variations();
	if ( ! empty ( $attributes ) ) {
		foreach ( $attributes as $attribute ) {
			if ( $attribute['attributes']['attribute_pa_license'] == $lc_term ) {
				return $term . '<span class="info">' . strip_tags ( wc_price( $attribute['display_price'] ) ) . ' / year</span><br><span class="variation_description">( ' . strip_tags ( $attribute['variation_description'] ) . ')</span>';
			}
		}

	}

	return $term;

}


// Remove helpscout stuff
add_action( 'wp', 'remove_help_scout' );

function remove_help_scout() {
	if ( isset( WC()->integrations->integrations['help-scout'] ) ) {
		remove_action( 'woocommerce_view_order', array(
			WC()->integrations->integrations['help-scout'],
			'view_order_create_conversation'
		), 40 );
		remove_action( 'woocommerce_my_account_my_orders_actions', array(
			WC()->integrations->integrations['help-scout'],
			'orders_actions'
		), 10, 2 );
		remove_action( 'woocommerce_after_my_account', array(
			WC()->integrations->integrations['help-scout'],
			'my_account_conversations_table'
		), 10 );
	}
}

function dlm_title_order_received( $title, $id ) {
	if ( is_order_received_page() && get_the_ID() === $id ) {
		global $wp;

		$order_id  = apply_filters( 'woocommerce_thankyou_order_id', absint( $wp->query_vars['order-received'] ) );
		$order_key = apply_filters( 'woocommerce_thankyou_order_key', empty( $_GET['key'] ) ? '' : wc_clean( $_GET['key'] ) );

		if ( $order_id > 0 ) {
			/** @var \WC_Order $order */
			$order = wc_get_order( $order_id );
			if ( $order->get_order_key() != $order_key ) {
				unset( $order );
			}
		}

		if ( isset ( $order ) ) {
			$title = sprintf( "Thank you, %s!", esc_html( $order->get_billing_first_name() ) );
		}


	}

	return $title;
}

add_filter( 'the_title', 'dlm_title_order_received', 10, 2 );

// Mark virtual orders as complete instead of processing
function dlm_virtual_order_payment_complete_order_status( $order_status, $order_id ) {
	$order = new WC_Order( $order_id );

	if ( 'processing' == $order_status && ( 'on-hold' == $order->get_status() || 'pending' == $order->get_status() || 'failed' == $order->get_status() ) ) {

		$virtual_order = false;

		if ( count( $order->get_items() ) > 0 ) {

			foreach ( $order->get_items() as $item ) {

				if ( 'line_item' == $item['type'] ) {

					//$_product = $order->get_product_from_item( $item );
					$_product = $item->get_product();

					if ( ! $_product->is_virtual() ) {
						// once we've found one non-virtual product we know we're done, break out of the loop
						$virtual_order = false;
						break;
					} else {
						$virtual_order = true;
					}
				}
			}
		}

		// virtual order, mark as completed
		if ( $virtual_order ) {
			return 'completed';
		}
	}

	// non-virtual order, return original status
	return $order_status;
}

add_filter( 'woocommerce_payment_complete_order_status', 'dlm_virtual_order_payment_complete_order_status', 10, 2 );

// Modify the checkout fields
function custom_dlm_checkout_fields( $fields ) {

	unset( $fields['billing']['billing_phone'] );
	unset( $fields['billing']['billing_address_2'] );

	$tmp = $fields['billing']['billing_company'];
	unset( $fields['billing']['billing_company'] );
	$fields['billing']['billing_company'] = $tmp;

	$fields['billing']['billing_company']['class'][0] = 'form-row-last';
	$fields['billing']['billing_company']['clear']    = 'houdoe';

	$fields['billing']['billing_state']['class'][0] = 'form-row-wide';

	unset( $fields['order']['order_comments'] );

	return $fields;
}

add_filter( 'woocommerce_checkout_fields', 'custom_dlm_checkout_fields' );

add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

function dlm_what_happens_next() {
	echo '<div class="dlm-what-happens-next">';
	echo '<strong>What happens next?</strong>';
	echo "<p>After you've completed your payment you'll receive an email containing your license keys and a download links.</p>";
	echo '</div>' . PHP_EOL;
}

add_action( 'woocommerce_after_checkout_form', 'dlm_what_happens_next' );

function dlm_checkout_footer() {
	if ( is_checkout() ) { ?>
		<div class="dlm-checkout-footer">
			<p><?php _e( "©2021 WP Chill. All rights reserved. A <a href='https://wpchill.com' target='_blank'>WP Chill</a> product", 'woocommerce' ); ?></p>
		</div>
	<?php }
}

add_action( 'storefront_page_after', 'dlm_checkout_footer' );

// remove downloads from my-account page
add_filter( 'woocommerce_account_menu_items', function ( $menu_items ) {
	unset( $menu_items['downloads'] );

	return $menu_items;
} );

require_once( 'cart-bundle-upsell.php' );
