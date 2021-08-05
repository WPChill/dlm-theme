<?php
$terms = get_terms( [
		'taxonomy'   => 'wpkb-category',
		'hide_empty' => false,
		'parent'     => 0
] );
$count = 0;
get_header(); ?>

	<section class="pt-8 pb-8 pt-md-11">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-3">
					<div class="sidebar card shadow-light-lg">
						<?php if ( count( $terms ) ) { ?>
							<h4 class="m-5">Categories</h4>
							<ul class="list-unstyled ms-5">
								<?php foreach ( $terms as $term ): $count ++ ?>
									<li>
										<a href="<?php echo get_term_link( $term ) ?>"  class="text-gray-800">
											<?php echo esc_html( $term->name ); ?>
										</a>
									</li>
								<?php endforeach ?>
							</ul>
						<?php } ?>
					</div>
				</div>
				<div class="col-12 col-md-8">
					<?php while ( have_posts() ) :
					the_post(); ?>
					<h1 class=" col-12 col-md-8 mb-2">
						<?php the_title(); ?>
					</h1>
					<hr class="my-6 my-md-8 border-gray-300">
					<div class="">
						<p class="text-gray-800 mb-6 mb-md-8">
							<?php the_content(); ?>
						</p>
					</div>
				</div>
				<?php endwhile; // end of the loop. ?>
			</div>
		</div>
	</section>
<?php get_footer(); ?>