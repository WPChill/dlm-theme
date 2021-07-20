<?php get_header();

       $terms = get_terms([
       'taxonomy' => 'wpkb-category',
       'hide_empty' => false,
       'number' => 1,
       'parent' => 0
   ]);
?>

<section class="pt-8 pt-md-11 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="sidebar card shadow-light-lg">
                    <?php
                    $terms = get_terms([
                        'taxonomy' => 'wpkb-category',
                        'hide_empty' => false,
                        'parent' => 0
                    ]);
                    ?>
                    <h4 class="m-5">Categories</h4>
                    <?php foreach ($terms as $term): ?>
                    <a href="<?php echo get_term_link($term) ?>">
                        <ul class="list-unstyled ms-5">
                            <li class=" text-gray-800">
                                <?php echo $term->name; ?>
                                <hr class="border-gray">
                            </li>
                        </ul>
                    </a>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-12 col-md-8">
            <?php while ( have_posts() ) : the_post(); ?>
                <h1 class=" col-12 col-md-8display-4 mb-2">
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