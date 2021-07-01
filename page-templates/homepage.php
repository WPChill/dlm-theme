<?php
/**
 * Login template form
 *
 * @package wpchill-theme
 */

/*
* Template Name: Homepage Template
*/
?>
<?php get_header(); ?>

<section class="pb-5">
	<div class="container col-xxl-12 col-md-12 p-5">
		<div class="row align-items-center homepage-header">
			<div class="col-xxl-6 col-md-6 text-md-left mb-xs-3 mb-md-0 ">
				<h1 class="lh-1 mb-3 intro">Introducing </br> Download Monitor</h1>
				<p class="mb-4 description">A WordPress plugin which provides an intuitive UI for uploading and managing downloadable files, inserting download links into posts & logging downloads.</p>

				<div class="d-grid gap-2">
					<a class="btn btn-primary homepage-click me-1" href="/pricing/">
						View pricing
						<i class="fe fe-arrow-right d-none d-md-inline ms-3"></i>
					</a>
					
				</div>
			</div>
			<div class="col-xxl-6 col-md-6 text-right" style="z-index:0;">
				<img class="img-fluid" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/Union.png">
			</div>
		</div>

	</div>
</section>

<section class="pt-5 pb-5">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-4 benefits">
				<!-- Icon -->
				<div class="mb-3 text-benefits">
					<img class="homepage-benefits" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/Union.png">         
				</div>
				<!-- Heading -->
				<h3 class="homepage-titles">Organise.</h3>
				<!-- Text -->
				<p class="mb-6 mb-md-0 benefits-description">
				Add, manage, categorise and tag downloadable files using the familiar WordPress UI
				</p>
			</div>

			<div class="col-12 col-md-4">
				<!-- Icon -->
				<div class="mb-3 text-benefits">
					<img class="homepage-benefits" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/scale.png">          
				</div>
				<!-- Heading -->
				<h3>Track.</h3>
				<!-- Text -->
				<p class="mb-6 mb-md-0 benefits-description">
				Display download links, track downloads, log access & show file download counts
				</p>
			</div>

			<div class="col-12 col-md-4">
				<!-- Icon -->
				<div class="mb-3 text-benefits">
					<img class="homepage-benefits" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/headphones.png">           
				</div>
				<!-- Heading -->
				<h3>Support.</h3>
				<!-- Text -->
				<p class="mb-6 mb-md-0 benefits-description">
				Support for adding multiple file versions per download, as well as mirrors
				</p>
			</div>
		</div>
	</div>
</section>

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

<section class="py-8 py-md-11 border-bottom">

	<div class="container homepage-extentions">
		
		<div class="row">
		<h2 class="extentions-title">Popular Extensions</h2>
			<div class="col-12 col-md-6 d-flex card-extension">
			<?php foreach ( $fp_ids as $fp_id ) : $fproduct = wc_get_product( $fp_id ); ?>
				<div class="card mb-6 shadow-light-lg lift lift-lg">
					<div class="card-img-top">
						<a href="<?php echo get_permalink( $fproduct->get_id() ); ?>">
							<?php echo get_the_post_thumbnail( $fproduct->get_id(), 'shop_catalog' ); ?>
						</a>   
					</div>     
					<a class="card-body">
						<h3><?php echo $fproduct->get_title(); ?></h3>
						<p><?php echo esc_html( $fproduct->get_short_description() ); ?></p>
					</a>
					<a class="card-meta">
						<p class="loop_price">$<?php echo $fproduct->get_price(); ?></p>
						<a href="<?php echo get_permalink( $fproduct->get_id() ); ?>" class="loop_more">Read More</a>
					</a>
				</div>
			<?php endforeach; ?>
			</div>
			<div class="d-grid gap-2">
				<a class="btn-lg btn-primary click-extensions" href="/pricing/">
				Browse our Extensions Catalog
				</a>
			</div>
		</div>
	</div>
</section>

<section class="pt-8 pt-md-11">
	<div class="container interface">
		<div class="row align-items-center justify-content-between">
			<div class="col-12 col-md-4 order-md-2 aos-init aos-animate">
				<h2>WHY CHOOSE DM</h2>
				<p class="options-description">Download Monitor’s goal is to keep your files organized and provide means to monitor the amount of downloads a file has, along with an easy method of linking to those files using shortcodes.</p>
			</div>
			<div class="col-12 col-md-8 order-md-1 aos-init aos-animate">
				<div class="card">
					<img class="options-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/interface.png">
				</div>
			</div>
		</div>
	</div>
</section>
<section class="pt-8 pt-md-11">
	<div class="container intuitive">
		<div class="row align-items-center justify-content-between">
			<div class="col-12 col-md-6 order-md-2 aos-init aos-animate">
				<div class="card">
					<img class="options-image-intuitive" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/intuitive.png">
				</div>
			</div>
			<div class="col-12 col-md-6 order-md-1 aos-init aos-animate description-intuitive">
				<h2>Intuitive Admin</h2>
				<p>The admin UI lists your downloads in an organized fashion listing useful file information and at-a-glance stats, whilst also providing search and filter functionality. Any user familiar with WordPress will find this instantly recognizable and easy to use.</p>
				<p>There is also a log viewer page and a nifty top downloads widget on the dashboard.</p>
			</div>
		</div>
	</div>
</section>

<section class="pt-8 pt-md-11">
	<div class="container quick-add">
		<div class="row align-items-center justify-content-between">
			<div class="col-12 col-md-6 order-md-2 aos-init aos-animate description-quick-add">
				<h2>Quick-Add Panel</h2>
				<p>To make referencing existing downloads, or uploading new ones from posts, Download Monitor adds an ‘Insert Download’ button above your post editor to load the quick-add panel for convenience.</p>
			</div>
			<div class="col-12 col-md-6 order-md-1 aos-init aos-animate">
				<div class="card">
					<img class="options-image-quick-add" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/quick-add.png">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="pt-8 pt-md-11">
	<div class="container versioning">
		<div class="row align-items-center justify-content-between">
			<div class="col-12 col-md-6 order-md-2 aos-init aos-animate">
				<div class="card">
					<img class="options-image-versioning" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/versioning.png">
				</div>
			</div>
			<div class="col-12 col-md-6 order-md-1 aos-init aos-animate description-versioning">
				<h2>File Versioning</h2>
				<p>As well as adding the main file, you can have other versions of files using the ‘File Versions’ interface. Your main version is clearly highlighted in blue and all versions can be re-ordered via drag and drop. Each file can also contain mirrors if you wish to reduce server load.</p>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
