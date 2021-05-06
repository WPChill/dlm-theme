<?php
define('DLM_BUNDLE_ID', 644);

function never5_dir() {
	return site_url( '/wp-content/never5/' );
}

function dlm_img() {
	return dlm_assets() . '/images';
}

function dlm_assets() {
	return get_stylesheet_directory_uri() . '/assets';
}

function dlm_styles() {
	if (is_page_template('template-pricing-page.php')) {
		wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css' );
	}
}
add_action('wp_enqueue_scripts', 'dlm_styles');

function dlm_scripts() {
	wp_dequeue_style( 'storefront-style' );
	wp_deregister_style( 'storefront-style' );
	wp_enqueue_style( 'storefront-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), '2.2.0' );
	wp_enqueue_script( 'dlm-sticky-sidebar-js', get_stylesheet_directory_uri() . '/assets/js/sticky-sidebar.js', array( 'jquery' ), true );
	wp_enqueue_script( 'dlm-general-js', get_stylesheet_directory_uri() . '/assets/js/general.js', array( 'jquery' ), true );
	if (is_page_template('template-pricing-page.php')) {
		wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'dlm-pricing-page-js', get_stylesheet_directory_uri() . '/assets/js/pricing-page.js', array( 'jquery' ), true );
	}
}

add_action( 'wp_enqueue_scripts', 'dlm_scripts', 20 );

// add site specific CSS to head, mostly colors
add_action( 'wp_head', function () {
	?>
	<style type="text/css">
		.site-header, .main-navigation ul ul, .secondary-navigation ul ul, .main-navigation ul.menu > li.menu-item-has-children:after, .secondary-navigation ul.menu ul, .main-navigation ul.menu ul, .main-navigation ul.nav-menu ul {
			background-color: <?php echo COLOR_1; ?>;
		}

		.site-header-cart .widget_shopping_cart {
			background-color: <?php echo COLOR_1; ?>;
		}

		a {
			color: <?php echo COLOR_1; ?>;
		}

		.site-footer a:not(.button) {
			color: <?php echo COLOR_1; ?>;
		}

		.page .wpkb-search form p span.wpkb-search-button input {
			background: <?php echo COLOR_1; ?>;
		}

		.extension-bundle-notice a.button, .n5-single-after-content-cta a.button {
			background: <?php echo COLOR_1; ?>;
		}

		#payment .place-order .button, .button.alt {
			background-color: <?php echo COLOR_1; ?>;
		}

		button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover, .widget-area .widget a.button.alt:hover, .added_to_cart:hover {
			background-color: <?php echo COLOR_1; ?>;
		}

		.wpcf7 .wpcf7-submit, .wpcf7 .wpcf7-submit:hover {
			background: <?php echo COLOR_1; ?>;
		}

		.single-wpkb-article #documentation-sidebar .sidebar-doc-block .wpkb-woocommerce-product-button, .tax-wpkb-category #documentation-sidebar .sidebar-doc-block .wpkb-woocommerce-product-button {
			background: <?php echo COLOR_1; ?>;
		}

		#order_review_heading, #order_review {
			border-color: <?php echo COLOR_1; ?>;
		}

		.woocommerce-info, .woocommerce-noreviews, p.no-comments {
			background: <?php echo COLOR_1; ?>;
		}

		.single-product .product .dlm-extension-detail-image {
			background: <?php echo COLOR_1; ?>;
		}

	</style>
	<?php
} );

function storefront_credit() {
	echo '<div class="site-credits">';
	echo '<small><a href="' . site_url( '/my-account/' ) . '">My Account</a></small>';
	echo '<small><a href="' . site_url( '/terms-conditions/' ) . '">Terms & Conditions</a></small>';
	echo '<small><a href="' . site_url( '/privacy-policy/' ) . '">Privacy Policy</a></small>';
	echo '<small class="pluginby"><a href="http://wpchill.com" target="_blank">' . get_bloginfo( 'name' ) . ' is a WPChill plugin</a></small>';
	echo '</div>';
}

// Google Analytics and FB
function never5_head_ga() {

	// No GA for admins
	if ( ( current_user_can( 'manage_options' ) ) || ( defined( 'DLM_NO_GA' ) && true === DLM_NO_GA ) ) {
		return;
	}
	?>
	<script>
		(
			function ( i, s, o, g, r, a, m ) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] || function () {
						(
							i[r].q = i[r].q || []
						).push( arguments )
					}, i[r].l = 1 * new Date();
				a = s.createElement( o ),
					m = s.getElementsByTagName( o )[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore( a, m )
			}
		)( window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga' );

		ga( 'create', '<?php echo GA_ID; ?>', 'auto' );
        ga( 'set', 'anonymizeIp', true );
		ga( 'send', 'pageview' );

	</script>

	<?php
}

add_action( 'wp_head', 'never5_head_ga' );

/**
 * Display Site Branding
 * @since  1.0.0
 * @return void
 */
function storefront_site_branding() {
	?>
	<div class="site-branding">
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img
					src="<?php echo never5_dir(); ?>/logo.png"
					alt="Download Monitor"/><span><?php bloginfo( 'name' ); ?></span></a></h1>
	</div>
	<?php
}

/**
 * No 'posted on' crap please
 */
add_filter( 'storefront_single_post_posted_on_html', function ( $posted_on_html ) {
	return '';
} );

add_shortcode( 'dlm-bundle-notice', function () {

	/** @var WC_Product_Variable $product */
	$product = wc_get_product( DLM_BUNDLE_ID );

	if ( false == $product ) {
		return;
	}

	// find variation price
	$variation_bundle_price = 0;
	foreach ( $product->get_available_variations() as $variation ) {
		if ( $variation['attributes']['attribute_pa_license'] == 'personal' ) {
			$variation_bundle_price = $variation['display_price'];
			break;
		}
	}

	$return = '<div class="extension-bundle-notice">';

	$return .= '<div class="ebn-icon-wrapper"><i class="fa fa-bullhorn"></i></div>';

	$return .= sprintf( '<p>Get <strong>$%s</strong> worth of extensions for just <strong>$%s</strong> with our <a href="/extensions/extension-bundle/"><strong>Extension Bundle!</strong></a></p>', absint(get_post_meta( DLM_BUNDLE_ID, 'value_single', true ) ), $variation_bundle_price );

	//$return .= '<p>Buying multiple extensions? Check out the <a href="/extensions/extension-bundle/">Core Extension Bundle</a> for an amazing discount!</p>';

	$return .= '<a href="/extensions/extension-bundle/" class="button">Click Here For More Information →</a>';

	$return .= '</div>';

	return $return;
} );

/**
 * Override of storefront_post_header()
 */
function storefront_post_header() { ?>
	<header class="entry-header">
		<?php
		if ( is_single() ) {
			$header_end = '</h1>';
			if ( 'documentation' === get_post_type() ) {
				$header_end = ' Documentation' . $header_end;
			}
			storefront_posted_on();
			the_title( '<h1 class="entry-title" itemprop="name headline">', $header_end );
		} else {
			if ( 'post' == get_post_type() ) {
				storefront_posted_on();
			}

			the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
		}
		?>
	</header><!-- .entry-header -->
	<?php
}

/**
 * Documentation stuff
 */
require_once( 'includes/knowledge-base.php' );


/**
 * WooCommerce stuff
 */

require_once( 'includes/woocommerce.php' );

require_once( 'includes/subscription-functions.php');
require_once( 'includes/legacy-upgrade.php');

// add renewal emails
/*
add_filter( 'license_wp_renewal_emails', function () {
	$emails = array();

	$periods = array(
		'd last week'  => '-1 week',
		's today'      => '+0 day',
		's tomorrow'   => '+1 day',
		's next week'  => '+1 week',
		's in 2 weeks' => '+2 weeks',
		's next month' => '+1 month'
	);

	foreach ( $periods as $period_label => $modify ) {
		$emails[] = array(
			'date_modify' => $modify,
			'subject'     => sprintf( 'Your %s license expire%s!', get_bloginfo( 'name' ), $period_label ),
			'body'        => "Hey :fname:,<br/>
			<br/>
			We wanted to remind you that your <strong><em>Legacy</em> :product: license expire{$period_label}!</strong> It's important to keep your license active in order to continue getting updates and support for any issues you may encounter.<br/>
			<br/>
			On January 21st, 2018, we moved our payment plans to yearly subscriptions instead of one-time yearly payments. You can now activate your subscription by clicking the renewal link below, you will keep the same license key.<br/>
            <br/>
            With the new subscription system you can easily stay up to date. Instead of having to renew your license manually every year, your license will now just stay active as long as your subscription is as well. 
            We've also made it easier to switch between licenses. Need a bigger license than you initially purchased? No problem! You can upgrade and downgrade your license at any point in time.<br/>
            <br/>
			Your expiring license key is: :license-key:<br/>
			Your license expires on: :license-expiration-date:<br/>
			<br/>
			<a href=':renewal-link:' style='font-weight:bold;'>Click here to active your new license</a><br/>
			<br/>
			Please let us know if you have any questions regarding renewing your license by simply replying to this email!<br/>
			<br/>
			Best regards,<br/>
			<br/>
			Barry Kooij<br/>
			Founder at " . get_bloginfo( 'name' ) . ", a Never5 product
			",
		);
	}

	return $emails;
} );
*/

add_filter( 'loop_shop_per_page', function($cols){return 24;}, 20 );

function never5_lwp_upgrade_footnote_help() {
	?><p><h5>Need help upgrading your license? <a href="/contact/" target="_blank">We're here to answer your questions!</a></h5></p><?php
}

function never5_lwp_upgrade_footnote_terms() {
	?><p><small>Upgrading your license will renew its expiration date based on the day of upgrading. Upgrading discount is automatically calculated based on remaining days a license is still valid. Upgrades are non refundable. By upgrading your license you agree to the <a href="/terms-conditions/" target="_blank">Terms & Conditions</a>. Personal licences are valid for a single site, Business licenses for 5 sites and a developer licence is valid for 20 websites.</small></p><?php
}

function never5_lwp_upgrade_price_notes() {
	/*?><p><small><strong style="color:green;">This upgrade price includes your $10 bonus!</strong><br/>Additional VAT may be added on checkout if you're based in the EU.</small></p><?php*/
	?><p><small>Additional VAT may be added on checkout if you're based in the EU.</small></p><?php
}

/**
 * @param WC_Product_Variable_Subscription $product
 */
function never5_single_after_content_cta( $product ) {
	$cart_url = add_query_arg( 'add-to-cart', $product->get_id(), wc_get_cart_url() );

	$attributes = $product->get_available_variations();

	if ( ! empty ( $attributes ) ) :
	?>
	<div class="n5-single-after-content-cta">
		<h3><i class="fa fa-shopping-cart" aria-hidden="true"></i>Buy It Now</h3>
		<?php
		$display_attributes = array();
		foreach ( $attributes as $attribute ) {
			$lbl = $attribute['attributes']['attribute_pa_license'];

			$display_attributes[ absint( $attribute['display_price'] ) ] = '<a href="' . add_query_arg( array( 'variation_id' => $attribute['variation_id'], 'attribute_pa_license' => $lbl ), $cart_url ) . '" class="button">' . ucfirst( $lbl ) . ' - $' . $attribute['display_price'] . '</a>';
		}

		ksort( $display_attributes, SORT_NUMERIC );
		$display_attributes = array_reverse( $display_attributes );

		foreach ( $display_attributes as $display_attribute ) {
			echo $display_attribute;
		}
		?>
	</div>
	<?php
	endif;
}

// Add extra information to license upgrade page
add_action( 'license_wp_license_upgrade_find_license_after_fields', 'never5_lwp_upgrade_footnote_help' );
add_action( 'license_wp_license_upgrade_after_fields', 'never5_lwp_upgrade_footnote_help' );
add_action( 'license_wp_license_upgrade_after_fields', 'never5_lwp_upgrade_footnote_terms' );
add_action( 'license_wp_license_upgrade_fields_after_price', 'never5_lwp_upgrade_price_notes' );

// we ceil our worth prices to make them nice and round
add_filter( 'license_wp_license_worth', function ( $worth ) {
	return ceil( $worth );
} );

// temp campaign upgrade stuff
/*add_filter( 'license_wp_license_worth', function($worth){
	return $worth+10;
});*/

add_action( 'wp', function() {
	if( is_product() ) {
		remove_filter('the_content', 'wpautop');
	}
});

function lwp_get_subscription_launch_date() {
	return new \DateTime( "2018-01-21 00:00:00" );
}

// add custom subscription switching CSS
add_action( 'wp_head', function () {
	if ( isset( $_GET['switch-subscription'] ) ) {
?>
        <style type="text/css">
            .single-product .dlm-extension-detail-copy, .single-product .dlm-extension-info-box-documentation, .single-product .dlm-extension-info-box-details {
                display: none;
            }

            .dlm-extension-detail-image {
                width: 50% !important;
                margin: 0 auto !important;
            }

            .single-product .dlm-extension-detail-info {
                width: 50% !important;
                margin: 0 auto !important;
                padding-right: 0 !important;
                float: none !important;;
            }
        </style>
<?php
	}
} );

add_action( 'woocommerce_checkout_create_order', function( $order ) {
	$order->set_customer_user_agent( '' );
} );

add_action( 'woocommerce_checkout_order_review', function() {
	wc_get_template( 'cart/checkout-totals.php' );
	wc_get_template(
		'checkout/form-coupon.php',
		array(
			'checkout' => WC()->checkout(),
		)
	);
}, 15 );

add_filter( 'woocommerce_checkout_fields', 'dlm_checkout_fields' );
function dlm_checkout_fields( $fields ) {
	$fields['billing']['billing_email']['priority'] = 1;
    // Remove Billing fields
    unset( $fields['billing']['billing_company'] );
    //unset( $fields['billing']['billing_email'] );
    unset( $fields['billing']['billing_phone'] );
    unset( $fields['billing']['billing_state'] );
    //unset( $fields['billing']['billing_first_name'] );
    //unset( $fields['billing']['billing_last_name'] );
    unset( $fields['billing']['billing_address_1'] );
    unset( $fields['billing']['billing_address_2'] );
    unset( $fields['billing']['billing_city'] );
    // unset( $fields['billing']['billing_postcode'] );

    return $fields;
}

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_before_form', 'woocommerce_checkout_payment' );
