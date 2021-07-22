<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header">
	<section class="extensions-header pt-4 pt-md-11 bg-primary">
			<div class="container">
				<div class="d-flex flex-column flex-lg-row flex-md-row justify-content-between">
					<div class="col-12 col-md-6 col-lg-6 order-1 page-title-container align-items-center">
						<h1 class="display-4 text-left text-white woocommerce-products-header__title page-title pt-lg-10 pt-md-10"><?php woocommerce_page_title(); ?></h1>
						<p class="lead text-left text-md-start mb-6 mb-lg-8"><?php esc_html_e( 'Extend the core Download Monitor plugin with it’s powerful extensions. All extensions come with one year of updates and support', 'wpchill-theme' ) ?></p>
					</div>
					<div class="col-12 col-md-6 col-lg-4 order-2 text-center bundle-container align-items-center">
						<div class="px-8 py-10 border border-white border-3 rounded">
							<div class="icon text-primary mb-3">
								<img width="50" height="45" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/box.png">
							</div>
							<p class="text-white bundle-price"><?php esc_html_e( 'Get $624 worth of extensions for just $125 with our Extension Bundle!', 'wpchill-theme' ) ?></p>
							<a href="/extensions/extension-bundle/" class="bundle-button btn btn-primary"><?php esc_html_e( 'Learn More', 'wpchill-theme' ) ?></a>
						</div>
					</div>
				</div>
			</div>
			<a class="arrow-products" href="#products"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/arrow.png" /></a>
		</section>
		<div class="position-relative">
			<div class="shape shape-bottom shape-fluid-x svg-shim text-white">
				<svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path></svg>
			</div>
		</div>
	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	?>
	<div class="woocommerce pt-10">
		<div class="container"> <?php
			do_action( 'woocommerce_before_shop_loop' ); ?>
		</div>
	</div> <?php

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
