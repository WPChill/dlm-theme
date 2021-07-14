<?php
/**
 * Home Page
 *
 * @package wpchill-theme
 */

get_header();
?>
<?php get_search_form(); ?>

<section class="pt-7 pt-md-10">
      <div class="container">
        <div class="row">
          <div class="col-12">

            <!-- Card -->
            <div class="card card-row shadow-light-lg mb-6 lift lift-lg">
              <div class="row gx-0">
                <div class="col-12">

                  <!-- Badge -->
                  <span class="badge rounded-pill bg-light badge-float badge-float-inside">
                    <span class="h6 text-uppercase">Featured</span>
                  </span>

                </div>
                <a class="col-12 col-md-6 order-md-2 bg-cover card-img-end" style="background-image: url(assets/img/photos/photo-27.jpg);" href="#!">

                  <!-- Image (placeholder) -->
                  <img src="assets/img/photos/photo-27.jpg" alt="..." class="img-fluid d-md-none invisible">

                  <!-- Shape -->
                  <div class="shape shape-start shape-fluid-y text-white d-none d-md-block">
                    <svg viewBox="0 0 112 690" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h62.759v172C38.62 384 112 517 112 517v173H0V0z" fill="currentColor"></path></svg>                  </div>

                </a>
                <div class="col-12 col-md-6 order-md-1">

                  <!-- Body -->
                  <a class="card-body" href="#!">

                    <!-- Heading -->
                    <h3>
                      Travel Can Keep You Creatively Inspired.
                    </h3>

                    <!-- Text -->
                    <p class="mb-0 text-muted">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec condimentum quam. Fusce pellentesque faucibus lorem at viverra. Integer at feugiat odio. In placerat euismod risus proin erat purus.
                    </p>

                  </a>

                  <!-- Meta -->
                  <a class="card-meta" href="#!">

                    <!-- Divider -->
                    <hr class="card-meta-divider">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm me-2">
                      <img src="assets/img/avatars/avatar-1.jpg" alt="..." class="avatar-img rounded-circle">
                    </div>

                    <!-- Author -->
                    <h6 class="text-uppercase text-muted me-2 mb-0">
                      Ab Hadley
                    </h6>

                    <!-- Date -->
                    <p class="h6 text-uppercase text-muted mb-0 ms-auto">
                      <time datetime="2019-05-02">May 02</time>
                    </p>

                  </a>

                </div>

              </div> <!-- / .row -->
            </div>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>

<article>
	<div class="container">
		<div class="row">

			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {

					the_post();
					get_template_part( 'template-parts/element', 'post-excerpt-card' );
				}
			}

			?>
		</div>
	</div>
</article>
<div class="position-relative">
    <div class="shape shape-bottom shape-fluid-x text-gray-200">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor"></path></svg>      </div>
</div>
<section class="pt-6 pt-md-8 bg-gray-200">
	<div class="container pb-6 pb-md-8 border-bottom border-gray-300">
	<div class="row align-items-center">
		<div class="col-12 col-md">

		<!-- Heading -->
		<h3 class="mb-1 fw-bold">
			Get our stories delivered
		</h3>

		<!-- Text -->
		<p class="fs-lg text-muted mb-6 mb-md-0">
			From us to your inbox weekly.
		</p>

		</div>
		<div class="col-12 col-md-5">

		<!-- Form -->
		<form>
			<div class="row">
			<div class="col">

				<!-- Input -->
				<input type="email" class="form-control" placeholder="Enter your email">

			</div>
			<div class="col-auto ms-n5">

				<!-- Button -->
				<button class="btn btn-primary" type="submit">
				Subscribe
				</button>

			</div>
			</div> <!-- / .row -->
		</form>

		</div>
	</div> <!-- / .row -->
	</div> <!-- / .container -->
</section>
<?php get_footer(); ?>
