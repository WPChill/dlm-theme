<?php
/**
 * Login template form
 *
 * @package wpchill-theme
 */

/*
* Template Name: Login Template
*/

?>

<?php
wp_head();
$args = array(
	'echo'           => true,
	'redirect'       => ( isset( $_SERVER['REQUEST_URI'] ) ) ? site_url( esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) ) : '',
	'form_id'        => 'loginform',
	'label_username' => __( 'Username' ),
	'label_password' => __( 'Password' ),
	'label_remember' => __( 'Remember Me' ),
	'label_log_in'   => __( 'Log In' ),
	'id_username'    => 'user_login',
	'id_password'    => 'user_pass',
	'id_remember'    => 'rememberme',
	'id_submit'      => 'wp-submit',
	'remember'       => true,
	'value_username' => null,
	'value_remember' => false,
);

?>

<div class="container d-flex flex-column">
	<div class="row align-items-center justify-content-center gx-0 min-vh-100">
		<div class="col-12 col-md-5 col-lg-4 py-8 py-md-11">

			<!-- Heading -->
			<h1 class="mb-5 fw-bold text-center">
				Sign in
			</h1>

			<!-- Form -->
			<?php
			if ( isset( $_GET['login'] ) && 'empty' === $_GET['login'] ) : //phpcs:ignore
				?>
			<div id="login-error">
				<p class="mb-5 text-muted"> <?php esc_html_e( 'Username or password field empty', 'wpchill-theme' ); ?></p>
			</div>
				<?php
			elseif ( isset( $_GET['login'] ) && 'failed' === $_GET['login'] ) : //phpcs:ignore
				?>
			<div id="login-error">
				<p class="mb-5 text-muted"> <?php esc_html_e( 'Wrong username or password', 'wpchill-theme' ); ?></p>
			</div>
			<?php endif; ?>
			<?php wpchill_login_form( $args ); ?>

		</div>
	</div> <!-- / .row -->
</div>
