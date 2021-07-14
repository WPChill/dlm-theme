<?php
/**
 * Search Form
 *
 * @package wpchill-theme
 */

?>
<!-- SEARCH -->
<section >
	<div class="container">
		<div class="row">
			<div class="col-12">
				<form class="rounded shadow mb-4 mt-4" role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<div class="input-group input-group-lg">

						<!-- Text -->
						<span class="input-group-text border-0 pe-1">
							<i class="fe fe-search"></i>
						</span>

						<!-- Input -->
						<input class="form-control border-0 px-1" type="search" aria-label="Search our blog..." placeholder="Search our blog..." value="<?php echo get_search_query(); ?>" name="s" title= >

						<!-- Text -->
						<span class="input-group-text border-0 py-0 ps-1 pe-3">
							<input class="btn btn-sm btn-primary" type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
						</span>

					</div>
				</form>
			</div>
		</div>
	</div>
</section>

