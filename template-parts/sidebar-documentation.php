<?php

// Get the post content
$post_content = get_the_content();


?>

<?php
if ( is_single() ) {
	// Get all titles
	preg_match_all( '`<h2 id="[a-z\-]+">([a-zA-Z0-9\s]+)</h2>`is', $post_content, $post_matches );

	if ( count( $post_matches ) > 0 && isset( $post_matches[1] ) && count( $post_matches[1] ) > 0 ) { ?>
		<div class="sidebar-doc-block">
			<h4>Index</h4>
			<?php
			echo '<ul>' . PHP_EOL;
			foreach ( $post_matches[1] as $header_title ) {
				echo '<li><a href="#' . dlm_format_doc_link( $header_title ) . '">' . $header_title . '</a></li>' . PHP_EOL;
			}
			echo '</ul>' . PHP_EOL;

			?>
		</div>
		<?php
	}
}
?>

<?php echo do_shortcode('[wpkb-woocommerce-button]'); ?>

<div class="sidebar-doc-block">
	<h4>Categories</h4>
	<ul><?php echo $GLOBALS['wpkb']->categories->index(); ?></ul>
</div>

<div class="sidebar-doc-block">
	<h4>Search</h4>
	<?php echo do_shortcode( '[wpkb_search style=quick]' ); ?>
</div>
