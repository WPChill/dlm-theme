<?php get_header(); ?>
	<div id="documentation-sidebar" class="widget-area"><?php get_template_part( 'template-parts/sidebar', 'documentation' ); ?></div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article class="hentry category-overview">
				<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
				<header class="entry-header"><h1 class="entry-title"><?php echo $term->name; ?></h1></header>
				<ul>
				<?php while ( have_posts() ) : the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; // end of the loop. ?>
				</ul>
			</article>
		</main>
		<!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>