<?php
/**
 * Main Functions file
 *
 * @package wpchill-theme
 */

?>

<?php
require_once get_template_directory() . '/filters.php';

/**
 * Theme support
 */
function wpchill_theme_support() {
	add_theme_support( 'custom-logo' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );

	register_nav_menus(
		[
			'primary'       => esc_html__( 'Primary', 'wpchill-theme' ),
			'footer-menu'   => esc_html__( 'Footer', 'wpchill-theme' ),
			'footer-menu-2' => esc_html__( 'Footer 2', 'wpchill-theme' ),
			'footer-menu-3' => esc_html__( 'Footer 3', 'wpchill-theme' ),
			'footer-menu-4' => esc_html__( 'Footer 4', 'wpchill-theme' ),
			'social'        => esc_html__( 'Top Social', 'wpchill-theme' ),
			'my-account'    => esc_html__( 'My Account', 'wpchill-theme' ),
		]
	);
}

add_action( 'after_setup_theme', 'wpchill_theme_support' );

/**
 * Register Styles
 */
function wpchill_theme_register_styles() {
	wp_enqueue_style(
		'wpchill-style',
		get_template_directory_uri() . '/assets/css/wpchill-style.bundle.css',
		'1.0.0',
		'all'
	);
}

add_action( 'wp_enqueue_scripts', 'wpchill_theme_register_styles' );

/**
 * Register Scripts
 */
function wpchill_theme_register_scripts() {
	wp_enqueue_script(
		'wpchill-theme-js',
		get_template_directory_uri() . '/assets/js/theme.bundle.js',
		[],
		'1.0',
		true
	);
	wp_enqueue_script(
		'wpchill-theme-vendor-js',
		get_template_directory_uri() . '/assets/js/vendor.bundle.js',
		[],
		'1.0',
		true
	);
	if ( is_product() ) {
		wp_enqueue_script( 
			'wpchill-product-page-js', 
			get_stylesheet_directory_uri() . '/assets/js/product-page.js', 
			array( 'jquery' ), 
			true 
		);
	}
}
add_action( 'wp_enqueue_scripts', 'wpchill_theme_register_scripts' );

if ( ! function_exists( 'wpchill_base_theme_author' ) ) {
	/**
	 * Displays the author box
	 */
	function wpchill_base_theme_author() {

		echo '<div class="row align-items-center py-5 border-top border-bottom">';
			echo '<div class="col-auto"></div>';
		// TO DO - ADD AVATAR!
			echo '<div class="col ms-n5">';
				echo '<h6 class="text-uppercase mb-0">';
				echo get_the_author();
				echo '</h6>';
				echo '<div class="author-description">';
					echo '<time class="fs-sm text-muted" datetime="2019-05-20">';
					$post_date = get_the_date( 'l F j, Y' );
					echo esc_html( $post_date );
					echo '</time>';
				echo '</div>';
		// Social links.
			echo '</div>';
		echo '</div>';

	}
}

/**
 * Register sidebars
 */
function wpchill_theme_init_sidebar() {

	register_sidebars(
		4,
		array(
			'id'            => 'footer-widgets',
			/* translators: %d: digit */
			'name'          => __( 'Footer Widgets %d', 'wpchill-theme' ),
			'description'   => __( 'Shown in the footer area.', 'wpchill-theme' ),
			'before_widget' => '<div id="%1$s" >',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="fw-bold text-uppercase text-gray-700">',
			'after_title'   => '</h6>',
		)
	);

}
add_action( 'widgets_init', 'wpchill_theme_init_sidebar' );

/**
 * SHOP PAGE
 * Get short description
 */
function wpchill_theme_get_product_description() {
	global $product;

	echo '<p class="mb-0 pb-6 extensions-description">' . esc_html( $product->get_short_description() ) . '</p>';
}

add_action( 'woocommerce_shop_loop_item_title', 'wpchill_theme_get_product_description', 20 );
remove_action ('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action ('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);
// Remove breadcrumps from product page
remove_action ( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
// Remove Product title from descripton
remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
// Remove Related products from single product page
remove_action ('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

function woocommerce_template_loop_product_link_open() {
	global $product;

	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

	echo '<a href="' . esc_url( $link ) . '" class="card-img-top text-decoration-none ">';
}

function woocommerce_get_product_thumbnail( $size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0 ) {
	global $product;

	$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

	return $product ? $product->get_image( $image_size, array( 'class' => 'card-img-top' ) ) : '';
}

function wpchill_woocommerce_product_add_to_cart_text( $text ) {
	return esc_html__( 'Read more' );
}

add_filter( 'woocommerce_product_add_to_cart_text', 'wpchill_woocommerce_product_add_to_cart_text' );


/**
 * PRODUCT PAGE
 * Stop WP from adding P tag automatically
 */
add_action( 'wp', function() {
	if( is_product() ) {
		remove_filter('the_content', 'wpautop');
	}
});

// Display prices in variation select
add_filter( 'woocommerce_variation_option_name', 'wpchill_display_price_in_variation_option_name' );

function wpchill_display_price_in_variation_option_name( $term ) {
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
				if(!empty( $attribute['variation_description'] ) ) {
					$term = $attribute['variation_description'];
				} 
				return '<span class="variation_description me-auto">' . wp_strip_all_tags( $term ) . '</span><span class="info">' . wp_strip_all_tags( wc_price( $attribute['display_price'] ) ) . ' / year</span>';
			}
		}

	}

	return $term;
}

/**
 * Redirect the user to our custom login page
 */
// function wpchill_redirect_login_page() {
// 	$login_page  = home_url( '/login/' );
// 	$page_viewed = isset( $_SERVER['REQUEST_URI'] ) ? basename( esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) ) : '';

// 	if ( 0 === strpos( $page_viewed, 'wp-login.php' ) && isset( $_SERVER['REQUEST_METHOD'] ) && 'GET' === $_SERVER['REQUEST_METHOD'] ) {

// 		wp_redirect( $login_page );//phpcs:ignore
// 		exit;
// 	}
// }
// if ( ! is_user_logged_in() ) {
// 	add_action( 'init', 'wpchill_redirect_login_page' );
// }

// /**
//  * Redirect users after succesfull login
//  */
// function admin_default_page() {
// 	return '/';
// }

// 	add_filter( 'login_redirect', 'admin_default_page' );

// /**
//  * Redirect the user to our logout page after logout
//  */
// function logout_redirect() {
// 	$login_page = home_url( '/login/' );
// 	wp_redirect( $login_page . '?login=false' );//phpcs:ignore
// 	exit;
// }
// add_action( 'wp_logout', 'logout_redirect' );

// /**
//  * Override the basic WordPress login form and use our own
//  *
//  * @param array $args various arguments we pass inside the form.
//  */
// function wpchill_login_form( $args ) {

// 	$form = '
// 			<form class="mb-6" name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
// 				' . '
// 				<div class="form-group">
// 					<label class="form-label" for="' . esc_attr( $args['id_username'] ) . '">' . esc_html( $args['label_username'] ) . '</label>
// 					<input class="form-control" type="text" name="log" id="' . esc_attr( $args['id_username'] ) . '" class="input" value="' . esc_attr( $args['value_username'] ) . '" size="20" />
// 				</div>
// 				<div class="form-group">
// 					<label class="form-label" for="' . esc_attr( $args['id_password'] ) . '">' . esc_html( $args['label_password'] ) . '</label>
// 					<input class="form-control" type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" class="input" value="" size="20" />
// 				</div>
// 				' . '
// 				' . ( $args['remember'] ? '<p class="login-remember"><label><input name="rememberme" type="checkbox" id="' . esc_attr( $args['id_remember'] ) . '" value="forever"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' . esc_html( $args['label_remember'] ) . '</label></p>' : '' ) . '
// 				<p class="login-submit">
// 					<input type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="btn w-100 btn-primary" value="' . esc_attr( $args['label_log_in'] ) . '" />
// 					<input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
// 				</p>
// 				' . '
// 			</form>';

// 	if ( $args['echo'] ) {
// 		echo $form;// phpcs:ignore
// 	} else {
// 		return $form;
// 	}
// }

// /**
//  * Redirect the user on failed login attempt
//  */
// function wpchill_custom_login_failed() {
// 	$login_page = home_url( '/login/' );
// 	wp_redirect( $login_page . '?login=failed' ); //phpcs:ignore
// 	exit;
// }
// add_action( 'wp_login_failed', 'wpchill_custom_login_failed' );

// /**
//  * Redirect the user on empty fields
//  *
//  * @param string $user     e.g admin.
//  * @param string $username the username that was entered.
//  * @param string $password the password that was entered.
//  */
// function wpchill_verify_user_pass( $user, $username, $password ) {
// 	$login_page = home_url( '/login/' );
// 	if ( '' === $username || '' === $password ) {
// 		wp_redirect( $login_page . '?login=empty' );//phpcs:ignore
// 		exit;
// 	}
// }
// add_filter( 'authenticate', 'wpchill_verify_user_pass', 1, 3 );
