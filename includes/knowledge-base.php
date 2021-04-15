<?php

/**
 * Documentation related code
 */

function dlm_format_doc_link( $title ) {
	return str_ireplace( ' ', '-', strtolower( $title ) );
}

// Add id's to h2 tags in content of documentation post type
add_filter( 'wp_insert_post_data', function ( $data, $postarr ) {
	// Check if post type is documentation
	if ( 'wpkb-article' === $data['post_type'] ) {
		$data['post_content'] = preg_replace_callback( '`<h2>([a-zA-Z0-9\s]+)</h2>`', function ( $matches ) {
			return '<h2 id="' . dlm_format_doc_link( $matches[1] ) . '">' . $matches[1] . '</h2>';
		}, $data['post_content'] );
	}

	return $data;
}, '99', 2 );

/*
 *
 * @ todo write a post update filter
 *
// Replace the post content
$post->post_content = preg_replace_callback( '`<h2>([a-zA-Z0-9\s]+)</h2>`', function ( $matches ) {
	return '<h2 id="' . dlm_format_doc_link( $matches[1] ) . '">' . $matches[1] . '</h2>';
}, $post->post_content );

var_dump( $test );
*/

add_filter( 'wp_kb_wc_page_url', function () {
	return '/kb/';
} );