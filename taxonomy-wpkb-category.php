<?php
/**
 * Documentation Categories
 *
 * @package wpchill-theme
 */

/*
* Template Name: Docs Cat Template
*/

get_header(); ?>

<section class="pt-6 pt-md-8 pb-8 mb-md-8  bg-light">
    <div class="container">
        <div class="row"> 
            <div class="col-12">
                <div class="row mb-6 mb-md-8 col-md-8">
                    <div class="col-auto">
                        <!-- Icon -->
                        <div class="icon-circle bg-primary text-white">
                            <i class="fe fe-users"></i>
                        </div>
                    </div>
                    <div class="col ms-n4">
                        <!-- Heading -->
                        <h2 class="fw-bold mb-0">
                            <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
                            <header class="entry-header"><h2 class="entry-title"><?php echo $term->name; ?></h2></header>
                        </h2>
                    </div>
                </div> 
                <div class="accordion shadow-light-lg mb-5 mb-md-6 bg-white" id="helpAccordionOne">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="field border border-light">
                    <a class="text-decoration-none" href="<?php the_permalink(); ?>">
                        <div class="accordion-item">
                            <div class="me-auto">
                                <!-- Heading -->
                                <h4 class="fw-bold mb-0 p-6 text-black">
                                   <?php the_title(); ?>
                                </h4>
                            </div>
                        </div>
                        </a>
                    </div>
                    <?php endwhile; // end of the loop. ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <hr class="border-gray-300 my-6 my-md-8">
        <h3 class="fw-bold">
            Related Help Center Categories
        </h3>
        <p class="text-muted mb-6 mb-md-8">
            If you didn’t find what you needed, these could help!
        </p>
        <?php
            $terms = get_terms([
            'taxonomy' => 'wpkb-category',
            'hide_empty' => false,
            'number' => 3,
            'parent' => 0
        ]);
        ?>

        <div class="row mt-10">
            <?php foreach ($terms as $term): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <a class="text-decoration-none" href="<?php echo get_term_link($term) ?>">
                    <div class="card card-border border-primary shadow-lg mb-6 mb-md-8 lift lift-lg">
                        <div class="card-body text-center">
                            <div class="icon-circle bg-primary text-white mb-5">
                                <i class="fe fe-users"></i>
                            </div>
                            <h4 class="fw-bold text-black"><?php echo $term->name; ?></h4>
                            <p class="text-gray-700 mb-5">
                            <?php echo $term->description; ?>
                            </p>
                            <span class="badge rounded-pill bg-dark-soft">
                                <span class="h6 text-uppercase">
                                    <?php echo $term->count . ' ENTRIES'; ?>
                                </span>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>