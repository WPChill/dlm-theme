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

<section class="pt-6 pt-md-8 pb-8 mb-md-8">
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
                            <header class="entry-header"><h1 class="entry-title"><?php echo $term->name; ?></h1></header>
                        </h2>
                     </div>
                </div> 
                <div class="accordion shadow-light-lg mb-5 mb-md-6" id="helpAccordionOne">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="field">
                    <a href="<?php the_permalink(); ?>">
                        <div class="accordion-item">
                            <div class="me-auto">
                                <!-- Heading -->
                                <h4 class="fw-bold mb-0 p-6">
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
</section>

<?php get_footer(); ?>