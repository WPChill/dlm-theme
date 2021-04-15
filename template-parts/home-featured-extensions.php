<?php

// get featured products
$fp_query = new WP_Query();
$fp_ids   = $fp_query->query( array(
	'post_type'      => 'product',
	'fields'         => 'ids',
	'posts_per_page' => 4,
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

/**
 * Note to the crazy divs being closed and opened. This is like a tmp fix so I don't have to rewrite the foundation of this theme.
 */

if ( ! empty( $fp_ids ) ) : ?>
</main></div></div></div>
<div id="content" class="home-featured-extensions-wrap">
    <div class="col-full">
        <div class="home-featured-extensions">
            <h2>Popular Extensions</h2>
            <ul class="products">
				<?php foreach ( $fp_ids as $fp_id ) : $fproduct = wc_get_product( $fp_id ); ?>
                    <li class="product">
                        <a href="<?php echo get_permalink( $fproduct->get_id() ); ?>">
							<?php echo get_the_post_thumbnail( $fproduct->get_id(), 'shop_catalog' ); ?>
                            <h3><?php echo $fproduct->get_title(); ?></h3>
                        </a>
						<?php /*<p><?php echo $fproduct->post->post_excerpt; ?></p>*/ ?>
                        <div class="product_footer"><p class="loop_price">$<?php echo $fproduct->get_price(); ?></p><a
                                    href="<?php echo get_permalink( $fproduct->get_id() ); ?>" class="loop_more">Read
                                More</a></div>
                    </li>
				<?php endforeach; ?>
            </ul>
            <p class="home-featured-show-all"><a href="<?php echo site_url( 'extensions/' ); ?>" class="button alt">Show
                    All Extensions</a></p>
        </div>
    </div>
</div>
<div id="content" class="site-content">
    <div class="col-full">
        <div id="primary">
			<?php endif; ?>
