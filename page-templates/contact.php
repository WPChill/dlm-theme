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

<section>
    <div class="container contact">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 text-center pt-10 pb-10">
                <h1 class="pb-5 title-contact">Contact</h1>
                <form>
                    <div class="mb-3">
                        <input type="name" class="form-control form-control-flush field" placeholder="Your name">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control form-control-flush field" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your Email">
                    </div>
                    <div class="mb-3">
                        <input type="subject" class="form-control form-control-flush field" placeholder="Subject">
                    </div>
                    <div class="mb-3">
                        <textarea type="textarea" class="form-control form-control-flush field" placeholder="Message"></textarea>
                    </div>
                    
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label agreement" for="exampleCheck1">I understand and agree that the data I entered in this form will be shared with and stored at Help Scout. More information about your data can be read in our <a> Privacy Policy </a>. </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg contact-send">Send message </button>
                </form>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>