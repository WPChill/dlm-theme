<?php

get_header();

?>

<div id="documentation-sidebar" class="widget-area">

<?php while ( have_posts() ) : the_post(); ?>

	<?php

	// Get the post content
	$post_content = get_the_content();

	// Get all titles
	preg_match_all( '`<h2 id="[a-z\-]+">([a-zA-Z0-9\s]+)</h2>`is', $post_content, $post_matches );
	?>

	<div class="doc-menu">
		<?php
		if ( count( $post_matches ) > 0 && isset( $post_matches[1] ) && count( $post_matches[1] ) > 0 ) {
			echo '<ul>' . PHP_EOL;
			foreach ( $post_matches[1] as $header_title ) {
				echo '<li><a href="#' . dlm_format_doc_link( $header_title ) . '">' . $header_title . '</a></li>' . PHP_EOL;
			}
			echo '</ul>' . PHP_EOL;
		}
		?>
	</div>

	<?php
	$extension_slug = get_post_meta( get_the_ID(), 'extension_slug', true );
	if ( '' !== $extension_slug ) {
		?>
		<div class="doc-buttons">
			<a href="/extensions/<?php echo $extension_slug; ?>/" class="button" title="<?php echo get_the_title(); ?>">Buy extension</a>
		</div>
	<?php
	}
	?>

	</div>

	<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">


	<?php
	do_action( 'storefront_single_post_before' );

	get_template_part( 'content', 'single' );

	/**
	 * @hooked storefront_post_nav - 10
	 */
	do_action( 'storefront_single_post_after' );
	?>

<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>