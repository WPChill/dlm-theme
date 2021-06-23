<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WpChill Theme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body data-aos-easing="ease-out-quad" data-aos-duration="700" data-aos-delay="0">

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-white">
		<div class="container">
			<!-- Brand -->
			<?php
			if ( function_exists( 'the_custom_logo' ) ) {
				if ( has_custom_logo() ) {
					?>
			<a class="navbar-brand" href="<?php echo esc_url( get_home_url() ); ?>">
					<?php
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$src            = wp_get_attachment_image_src( $custom_logo_id );

					?>
				<img src="<?php echo esc_attr( $src[0] ); ?>" class="navbar-brand-img" alt="Logo">
			</a>
			<?php } else { ?>
				<h1 class="site-title" >
					<a href="<?php echo esc_attr( get_home_url() ); ?>"><?php echo esc_html( get_option( 'blogname', 'wpchill-theme' ) ); ?></a>
				</h1>

					<?php
			}
			}
			?>
			<!-- Toggler -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
				aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Collapse -->
			<div class="collapse navbar-collapse" id="navbarCollapse">

				<!-- Toggler -->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
					aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fe fe-x"></i>
				</button>
				<?php
				if ( has_nav_menu( 'primary' ) ) :
					wp_nav_menu(
						[
							'menu'           => 'primary',
							'theme_location' => 'primary',
							'menu_id'        => '',
							'container'      => '',
							'items_wrap'     =>
								'<ul class="navbar-nav ms-auto">%3$s</ul>',
						]
					);
				endif;
				?>
			</div>
		</div>

	</nav>
