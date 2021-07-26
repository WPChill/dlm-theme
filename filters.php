<?php
/**
 * Theme filters
 *
 * @package wpchill-theme
 */

add_filter( 'wp_nav_menu_items', 'wpchill_main_menu_filter', 10, 2 );

/**
 * Add my account entry on the main menu
 *
 * @param string $items menu items.
 * @param object $args menu object.
 */
function wpchill_main_menu_filter( $items, $args ) {

	if ( 'primary' === $args->theme_location ) {

		if ( ! is_user_logged_in() ) {
			$items .= '<li class="nav-item nav-link login-menu-link"><a class="login-link text-decoration-none" href="' . esc_url( wp_login_url( get_permalink() ) ) . '" rel="nofollow">Log In</a></li>';
		} else {
			$items .= '<li class="nav-item dropdown my-account-menu-link">';
			$items .= '<a class="nav-link" href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '">My Account</a>';
			$items .= '<ul class="dropdown-menu">';
			$items .= '<li class="dropdown-item "><a class="dropdown-item" href="' . get_permalink( get_page_by_path( 'my-account' ) ) . 'orders">Purchase
                                History</a></li>';
			$items .= '<li class="dropdown-item"><a class="dropdown-item"
                                href="' . get_permalink( get_page_by_path( 'my-account' ) ) . 'subscriptions">Subscriptions</a></li>';
			$items .= '<li class="dropdown-item"><a class="dropdown-item"
                                href="' . get_permalink( get_page_by_path( 'my-account' ) ) . 'edit-account">Account
                                Information</a></li>';
			$items .= '<li class="dropdown-item"><a class="dropdown-item"
                                href="' . get_permalink( get_page_by_path( 'my-account' ) ) . 'downloads">Download History</a>
                        </li>';

			$items .= '<li class="dropdown-item"><a class="dropdown-item" href="' . wp_logout_url( home_url() ) . '">Log Out</a></li>';
			$items .= '</ul>';
			$items .= '</li>';
		}
	}

	return $items;
}

add_filter( 'nav_menu_css_class', 'wpchill_theme_nav_menu_item_classes', 10, 4 );

/**
 * Custom classes to menus
 *
 * @param string $classes existing classes.
 * @param object $item    current menu item.
 * @param array  $args    no args provided.
 * @param int    $depth   Submenu.
 */
function wpchill_theme_nav_menu_item_classes( $classes, $item, $args, $depth ) {

	if ( 'my-account' === $args->theme_location ) {
		$classes = implode( ' ', $classes );
		if ( strpos( $classes, 'current-menu-item' ) ) {
			$classes = 'active list-item';
		} else {
			$classes = 'list-item';
		}
		$classes = apply_filters( 'wpchill_nav_menu_item_classes', $classes, $item );
		$classes = explode( ' ', $classes );

	} else {
		$classes = 'nav-item';

		if ( 0 === $depth ) {
			$classes .= ' dropdown';
		} elseif ( 1 <= $depth ) {
			$classes .= ' dropdown-item dropdown';
		}
		$classes = apply_filters( 'wpchill_nav_menu_item_classes', $classes, $item );

		$classes = explode( ' ', $classes );

	}
	return $classes;

}

add_filter( 'walker_nav_menu_start_el', 'wpchill_theme_nav_menu_anchor_classes', 20, 4 );

/**
 * Custom Classes to Anchor Tag
 *
 * @param string $output <li><a></a>.
 * @param string $item   current menu item.
 * @param int    $depth  submenu depth.
 * @param array  $args   no args provided.
 */
function wpchill_theme_nav_menu_anchor_classes( $output, $item, $depth, $args ) {

	if ( 'my-account' === $args->theme_location ) {
		$output = "<a href='" . esc_url( $item->url ) . "' class='" . apply_filters( 'wpchill_nav_menu_anchor_classes', 'list-link text-reset' ) . "'>" . $item->title . '</a>';
	} else {
		if ( 1 <= $depth ) {
			$output = "<a href='" . esc_url( $item->url ) . "' class='" . apply_filters( 'wpchill_nav_menu_anchor_classes', 'dropdown-item' ) . "'>" . $item->title . '</a>';
		} else {
			$output = "<a href='" . esc_url( $item->url ) . "' class='" . apply_filters( 'wpchill_nav_menu_anchor_classes', 'nav-link' ) . "'>" . $item->title . '</a>';
		}
	}

	return $output;
}

add_filter( 'nav_menu_submenu_css_class', 'wpchill_theme_nav_submenu_classes', 10, 3 );

/**
 * Remove text decoration for submenu
 *
 * @param array $classes Existing classes.
 * @param array $args    No args.
 * @param int   $depth   Defaulted by WordPress.
 */
function wpchill_theme_nav_submenu_classes( $classes, $args, $depth ) {
	if ( 0 <= $depth ) {
		$classes = array( 'dropdown-menu' );
	}

	return $classes;
}
