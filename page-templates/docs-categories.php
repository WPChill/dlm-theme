<?php
/**
 * Documentation Categories
 *
 * @package wpchill-theme
 */

/*
* Template Name: Docs Cat Template
*/

$terms = get_terms([
    'taxonomy' => 'wpkb-category',
    'hide_empty' => false,
    'parent' => 0
]);

get_header(); ?>

<div class="container">

<?php get_search_form(); ?>

    <div class="row mt-10">
        <?php foreach ($terms as $term): ?>
        <div class="col-12 col-md-6 col-lg-4">
            <a href="<?php echo get_term_link($term) ?>">
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
<?php get_footer(); ?>