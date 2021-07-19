<?php get_header();

       $terms = get_terms([
       'taxonomy' => 'wpkb-category',
       'hide_empty' => false,
       'number' => 1,
       'parent' => 0
   ]);

?>

<section class="pt-8 pt-md-11 bg-light">
<?php while ( have_posts() ) : the_post(); ?>
    <div class="container">
        <div class="row align-items-center">
            <h1 class="display-4 mb-2">
                <?php the_title(); ?>
            </h1>
            <hr class="my-6 my-md-8 border-gray-300">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-8">
            <p>
                <?php echo term_description(); ?>
            </p>
        </div>
    </div>  
    <?php endwhile; // end of the loop. ?> 
</section>
<?php get_footer(); ?>