<?php
/**
 * Homepage template form
 *
 * @package wpchill-theme
 */

/*
* Template Name: Homepage Template
*/
?>
<?php get_header(); ?>

<!--Intro -->
<section class="pb-5">
	<div class="container col-xxl-12 col-md-12 p-5">
		<div class="row align-items-center homepage-header">
			<div class="col-xxl-6 col-md-6 text-md-left mb-xs-3 mb-md-0 order-sm-1 order-2">
				<h1 class="lh-1 mb-3 intro"> Introducing </br> Download Monitor</h1>
				<p  class="mb-4 description"><?php esc_html_e('A WordPress plugin which provides an intuitive UI for uploading and managing downloadable files, inserting download links into posts & logging downloads.', 'wpchill-theme'); ?></p>
				<div class="pb-5 text-left">
					<a class="btn btn-primary lift button-background homepage-click" href="/pricing">
					View pricing
						<i class="fe fe-arrow-right d-none d-md-inline ms-3"></i>
					</a>
        		</div>
			</div>
			<div class="col-xxl-6 col-md-6 text-right order-sm-2 order-1" style="z-index:0;">
				<img class="img-fluid" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/DM2.png">
			</div>
		</div>

	</div>
</section>

<!--Benefits -->
<section class="pt-5 pb-5">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-4 benefits">
				<!-- Icon -->
				<div class="mb-3 text-benefits">
					<img class="homepage-benefits" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/Union.png">         
				</div>
				<!-- Heading -->
				<h3 class="homepage-titles"><?php esc_html_e( 'Organize.', 'wpchill-theme' ); ?></h3>
				<!-- Text -->
				<p class="mb-10 benefits-description">
					<?php esc_html_e( 'Add, manage, categorise and tag downloadable files using the familiar WordPress UI', 'wpchill-theme' ); ?>
				</p>
			</div>

			<div class="col-12 col-md-4 benefits">
				<!-- Icon -->
				<div class="mb-3 text-benefits">
					<img class="homepage-benefits" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/scale.png">          
				</div>
				<!-- Heading -->
				<h3 class="homepage-titles"><?php esc_html_e( 'Track.', 'wpchill-theme' ); ?></h3>
				<!-- Text -->
				<p class="mb-10 benefits-description">
					<?php esc_html_e( 'Display download links, track downloads, log access & show file download counts', 'wpchill-theme' ); ?>
				</p>
			</div>

			<div class="col-12 col-md-4 benefits">
				<!-- Icon -->
				<div class="mb-3 text-benefits">
					<img class="homepage-benefits" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/headphones.png">           
				</div>
				<!-- Heading -->
				<h3 class="homepage-titles"><?php esc_html_e( 'Support.', 'wpchill-theme' ); ?></h3>
				<!-- Text -->
				<p class="mb-10 benefits-description">
					<?php esc_html_e( 'Support for adding multiple file versions per download, as well as mirrors', 'wpchill-theme' ); ?>
				</p>
			</div>
		</div>
	</div>
</section>

<!--Extensions -->
<?php

// get featured products
$fp_query = new WP_Query();
$fp_ids   = $fp_query->query( array(
	'post_type'      => 'product',
	'fields'         => 'ids',
	'posts_per_page' => 3,
	'order'          => 'ASC',
	'orderby'        => 'menu_order',
	'tax_query'      => array(
		array(
			'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => 'featured',
			'operator' => 'IN',
		)
	)
) );

?>

<section class="homepage-extensions">
	<div class="container">
	<h2 class="extensions-title text-center pt-10">Popular Extensions</h2>
		<div class="row">
		<?php foreach ( $fp_ids as $fp_id ) : $fproduct = wc_get_product( $fp_id ); ?>
			<div class="col-12 col-md-6 col-lg-4 d-flex">
				<div class="card mb-6 shadow-light-lg lift lift-lg">
				<a href="<?php echo get_permalink( $fproduct->get_id() ); ?>" class="bg-primary text-center">
					<!-- Image -->
					<?php echo get_the_post_thumbnail( $fproduct->get_id(), 'shop_catalog', array('class' => 'card-img-top', 'style' => 'width:auto') ); ?>
					<div class="position-relative">
						<div class="shape shape-bottom shape-fluid-x svg-shim text-white">
							<svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path></svg>
						</div>
					</div>
				</a>
				<a class="card-body" href="#!">
					<!-- Heading -->
					<h3 class="extensions-subtitle">
						<?php echo $fproduct->get_title(); ?>
					</h3>
					<!-- Text -->
					<p class="mb-0 extensions-subtitle">
						<?php echo esc_html( $fproduct->get_short_description() ); ?>
					</p>
             	 </a>
			 	 <div class="card-meta mt-auto" href="#!">
					<!-- Divider -->
					<hr class="card-meta-divider extensions-divider">
					<!-- Price -->
					<span class="text-uppercase me-2 extensions-price">
						$<?php echo $fproduct->get_price(); ?>
					</span>
					<!-- Read more -->
					<a class="text-uppercase ms-auto extensions-more" href="<?php echo get_permalink( $fproduct->get_id() ); ?>">Read More</a>
				</div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
		<div class="text-center pb-10">
			<a class="btn btn-primary lift button-background click-extensions" href="/extensions/">
			Browse our Extensions Catalog
			</a>
        </div>
	</div>
</section>

<!--Interfaces -->
<section class="pt-5">
	<div class="container interface">
		<div class="row align-items-center justify-content-between">
			<div class="col-12 col-md-6 order-md-1">
				<div class="position-relative vw-md-50 float-end d-block">
					<div class="position-relative d-md-block aos-init aos-animate">
						<div class="card">
							<img class="interface-image img-fluid"   src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/interface.png">
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 py-md-14 order-md-2 aos-init aos-animate">
				<span class="badge rounded-pill bg-success-soft mb-3">
					<span class="h6 text-uppercase">WHY CHOOSE DM</span>
				</span>
				<p class="interface-description"><strong>Download Monitor’s</strong> goal is to keep your files organized and provide means to monitor the amount of downloads a file has, along with an easy method of linking to those files using shortcodes.</p>
			</div>	
		</div>
		</div>
	</div>
</section>

<section class="pt-10">
	<div class="container intuitive">
		<div class="row align-items-center justify-content-between">
			<div class="col-12 col-md-6 order-md-2 aos-init aos-animate">
				<div class="card">
					<img class="card options-image-intuitive" style="width:100%"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/intuitive.png">
				</div>
			</div>
			<div class="col-12 col-md-6 order-md-1 aos-init aos-animate ">
				<h2 class="intuitive-title">Intuitive Admin</h2>
				<div class="intuitive-description">
					<p>The admin UI lists your downloads in an organized fashion listing useful file information and at-a-glance stats, whilst also providing search and filter functionality. Any user familiar with WordPress will find this instantly recognizable and easy to use.</p>
					<p>There is also a log viewer page and a nifty top downloads widget on the dashboard.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="pt-8">
	<div class="container quick-add">
		<div class="row row-quick-add align-items-center justify-content-between">
			<div class="col-12 col-md-6 aos-init aos-animate ">
				<h2 class="quick-add-title">Quick-Add Panel</h2>
				<p class="quick-add-description">To make referencing existing downloads, or uploading new ones from posts, Download Monitor adds an ‘Insert Download’ button above your post editor to load the quick-add panel for convenience.</p>
			</div>
			<div class="col-12 col-md-6 aos-init aos-animate">
				<div class="card">
					<img class="options-image-quick-add" style="width:100%"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/quick-add.png">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="pt-8">
	<div class="container versioning">
		<div class="row align-items-center justify-content-between">
			<div class="col-12 col-md-6 order-md-2 aos-init aos-animate">
				<div class="card">
					<img class="options-image-versioning" style="width:100%"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/versioning.png">
				</div>
			</div>
			<div class="col-12 col-md-6 order-md-1 aos-init aos-animate ">
				<h2 class="versioning-title">File Versioning</h2>
				<p class="versioning-description">As well as adding the main file, you can have other versions of files using the ‘File Versions’ interface. Your main version is clearly highlighted in blue and all versions can be re-ordered via drag and drop. Each file can also contain mirrors if you wish to reduce server load.</p>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
