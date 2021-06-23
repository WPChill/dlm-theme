<?php
/**
 * Download History Template
 *
 * @package wpchill-theme
 */

/*
Template Name: My Account
*/

?>

<?php get_header(); ?>
<header class="bg-dark pt-9 pb-11 d-none d-md-block">
	<div class="container-md">
		<div class="row align-items-center">
			<div class="col">

				<!-- Heading -->
				<h1 class="fw-bold text-white mb-2">
					Account Settings
				</h1>

				<!-- Text -->
				<?php $current_user = wp_get_current_user();  // phpcs:ignore ?>
				<p class="fs-lg text-white-75 mb-0">
					Settings for : <?php echo esc_html( $current_user->user_login ); ?>
				</p>

			</div>
			<div class="col-auto">

				<!-- Button -->
				<button class="btn btn-sm btn-gray-300-20">
					<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">Log out?</a>
				</button>

			</div>
		</div> <!-- / .row -->
	</div> <!-- / .container -->
</header>

<main class="pb-8 pb-md-11 mt-md-n6">
	<div class="container-md">
		<div class="row">

			<div class="col-12 col-md-3">

				<!-- Card -->
				<div class="card card-bleed border-bottom border-bottom-md-0 shadow-light-lg">

					<!-- Collapse -->
					<div class="collapse d-md-block" id="sidenavCollapse">
						<div class="card-body">

							<?php
							wp_nav_menu(
								[
									'theme_location' => 'my-account',
									'menu_id'        => '',
									'container'      => '',
									'items_wrap'     => '<ul class="card-list list text-gray-700 mb-6">%3$s</ul>',
								]
							);
							?>

						</div>
					</div>

				</div>

			</div>

			<div class="col-12 col-md-9">
				<div class="card card-bleed shadow-light-lg mb-6">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col">

								<!-- Heading -->
								<h4 class="mb-0">
									<?php the_title(); ?>
								</h4>

							</div>
						</div>
					</div>
					<div class="card-body">

					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
					<?php endif; ?>

					</div>
				</div>
			</div>

		</div> <!-- / .row -->
	</div> <!-- / .container -->
</main>

<?php get_footer(); ?>
