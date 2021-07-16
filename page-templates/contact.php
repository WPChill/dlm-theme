<?php
/**
 * Contact Form
 *
 * @package wpchill-theme
 */

/*
* Template Name: Contact Template
*/
?>
<?php get_header(); ?>

<section class="py-10 py-md-14 overlay overlay-black overlay-60 bg-cover" style="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 text-center">
                <!-- Heading -->
                <h1 class="display-2 fw-bold text-white">
                We’re Here to Help.
                </h1>
                <!-- Text -->
                <p class="lead text-white-75 mb-0">
                We always want to hear from you! Let us know how we can best help you and we'll do our very best.
                </p>
            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</section>
<div class="position-relative">
    <div class="shape shape-bottom shape-fluid-x text-light">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path></svg>     
    </div>
</div>


<section>
    <div class="container contact mt-10">
        <div class="row justify-content-center">
                <h1 class="pb-5 title-contact text-center">Contact</h1>
                <?php echo do_shortcode('[contact-form-7 id="29898" title="Contact form 1"]');?>
        </div>
    </div>
</section>

<?php get_footer(); ?>