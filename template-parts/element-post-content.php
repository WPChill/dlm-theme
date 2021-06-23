<?php
/**
 * Element Post Content template
 *
 * @package wpchill-theme
 */

?>

<section class="pt-6 pt-md-8">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10 col-lg-9 col-xl-8">
				<?php the_content(); ?>
				<?php wpchill_base_theme_author(); ?>
			</div>
		</div>
	</div>
</section>
