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

<section data-jarallax="" data-speed=".8" class="pt-10 pb-11 py-md-14 overlay overlay-black overlay-60 jarallax" style="background-image: none; z-index: 0;" data-jarallax-original-styles="background-image: url(assets/img/covers/cover-4.jpg);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8 text-center">
        <!-- Heading -->
        <h1 class="display-2 fw-bold text-white">
          What Do You Need?
        </h1>

        <!-- Text -->
        <p class="lead text-white-75 mb-0">
          We're here to help you better use Download Monitor. First, let's figure out if we have a solution in our documentation.
        </p>
      </div>
    </div> <!-- / .row -->
  </div> <!-- / .container -->
  <div id="jarallax-container-0" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; z-index: -100;"><div style="background-position: 50% 50%; background-size: cover; background-repeat: no-repeat; background-image: url(&quot;https://landkit.goodthemes.co/assets/img/covers/cover-4.jpg&quot;); position: absolute; top: 0px; left: 0px; width: 100%; height:100%; overflow: hidden; pointer-events: none; transform-style: preserve-3d; backface-visibility: hidden; will-change: transform, opacity; margin-top: -38.8px; transform: translate3d(0px, 21.36px, 0px);">
  </div>
</div>
</section>
<div class="position-relative">
  <div class="shape shape-bottom shape-fluid-x text-light">
    <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path></svg>      
  </div>
</div>

<main class="pb-10 mt-md-n8">
	<div class="container">
		
      <?php echo do_shortcode('[wpkb_search]');?>
  


  </div>
</main>

<section>
  <div class="container">
    <div class="row">
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