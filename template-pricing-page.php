<?php
/**
 * The pricing page
 *
 * Template Name: Pricing Page
 *
 * @package dlm-theme
 */
$product = wc_get_product( DLM_BUNDLE_ID );
$extensions = $product->get_available_variations();
$cart_url = add_query_arg( 'add-to-cart', $product->get_id(), wc_get_cart_url() );
get_header();
?>
</div>
<section class="pricing-title-section">
		<div class="row justify-content-center">
			<div class="pricing-header">
				<img class="dlm-pricing-logo" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/dlm-logo.png' ?>" />
				<h1><a href="/"><?php esc_html_e( 'Download Monitor', 'dlm-theme' ); ?></a></h1>
			</div>
		</div>
		<div class="pricing-template-subtitle-section">
			<div class="pricing-template-subtitle">
				<h3><?php esc_html_e( 'A WordPress plugin which provides an intuitive UI for uploading and managing downloadable files, inserting download links into posts & logging downloads.', 'dlm-theme' ); ?></h3>
			</div>
		</div>
</section>

<section id="pricing-table" class="pricing-table-section">
	<div class="container">
		<div class="pricing-table--header row">
			<div class="col-md-3">	
				<div class="pricing-table__message">
					<h6>You can change plans or cancel your account at any time</h6>
					<small>Choose a plan and you can upgrade or cancel it any time you want.</small>
				</div>
			</div>
			<?php foreach ( $extensions as $extension ): ?>
				<div class="col-md-3">
					<h4 class="pricing-table__title"><?php echo ucfirst($extension['attributes']['attribute_pa_license']); ?></h4>
					<div class="pricing-table__price"><?php echo $extension['price_html']; ?></div>
					<a href="<?php echo add_query_arg( array( 'variation_id' => $extension['variation_id'], 'attribute_pa_license' => $lbl ), $cart_url ) ?>" class="button"><?php esc_html_e('Buy Now', 'dlm-theme'); ?></a>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="pricing-table row">
			<div class="col-md-3">
				<?php esc_html_e('Supported Sites', 'dlm-theme'); ?>
				<span data-toggle="tooltip" data-placement="right" title="The number of sites on which you can use Modula.">
					<i class="fas fa-question-circle"></i>
				</span>
			</div>
			<div class="col-md-3"><?php esc_html_e('1 Site', 'dlm-theme'); ?></div>
			<div class="col-md-3"><?php esc_html_e('5 Site', 'dlm-theme'); ?></div>
			<div class="col-md-3"><?php esc_html_e('20 Site', 'dlm-theme'); ?></div>
		</div>
		<div class="pricing-table row">
			<div class="col-md-3">
				<?php esc_html_e('Support for 1 full year', 'dlm-theme'); ?>
				<span data-toggle="tooltip" data-placement="right" data-html="true" title="In case you ever run into issues with our plugin (unlikely), feel free to reach out to our support at any time. 
					<br>------------
					<br>1. Priority support - tickets get handled in 12 hours or less. 
					<br>2. Regular support - tickets get handled in 48 hours or less. 
					<br>------------
					<br>* On weekends, response time might slow down to 48hours for priority and up to 96 hours for regular support.">
					<i class="fas fa-question-circle"></i>
				</span>
			</div>
			<div class="col-md-3"><?php esc_html_e('Regular', 'dlm-theme'); ?></div>
			<div class="col-md-3"><?php esc_html_e('Regular', 'dlm-theme'); ?></div>
			<div class="col-md-3"><?php esc_html_e('Priority', 'dlm-theme'); ?></div>
		</div>
		<div class="pricing-table row">
			<div class="col-md-3">
				<?php esc_html_e('Updates for 1 full year', 'dlm-theme'); ?>
				<span data-toggle="tooltip" data-placement="right" data-html="true" title="You’ll have access to free updates for 1 year or until you cancel your subscription. 
					<br> All of our subscriptions are automatically renewing and renew every 12 months from the last payment date.">
					<i class="fas fa-question-circle"></i>
				</span>
			</div>
			<div class="col-md-3"><i class="fas fa-check"></i></div>
			<div class="col-md-3"><i class="fas fa-check"></i></div>
			<div class="col-md-3"><i class="fas fa-check"></i></div>
		</div>
		<div class="row pricing-message">
			<div class="pricing-message__content col-md-12">
				<h5>100% No-Risk Money Back Guarantee!</h5>
				<p>There’s no risk trying Modula: if you don’t like Modula after 14 days, we’ll refund your purchase. We take pride in a frustration-free refund process.</p>
			</div>
		</div>
	</div>
</section>

<section class="faq-section">

	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3 text-center">
				<h3>Frequently Asked Questions.</h3>
				<p>Still have questions? These are some frequently asked questions, but, if your question is not listed feel free to check our <a class="link" target="_blank" href="/kb/">documentation</a> or <a class="link" href="/contact/">contact us</a>.</p>
			</div>
			<div class="col-md-6">
				<div class="accordion" id="leftFaq">
					<div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Who is Download Monitor for?
					</div>
					<div id="collapseOne" class="collapse" data-parent="#leftFaq">
						<div class="card-body">
							Download Monitor is the ideal solution for those who want to keep their files organized and provide means to monitor the amount of downloads a file has, along with an easy method of linking to those files using shortcodes.
						</div>
					</div>

					<div class="card-header" data-toggle="collapse" data-target="#collapseTre" aria-expanded="true" aria-controls="collapseTre">
						What do I need to get started?
					</div>
					<div id="collapseTre" class="collapse" data-parent="#leftFaq">
						<div class="card-body">
						To use Download Monitor on your website, all you need is a self-hosted <a target="_blank" href="https://wordpress.org/">WordPress.org</a> installation or a website hosted on <a href="https://wordpress.com/" target="_blank">WordPress.com</a>’s Business Plan.
						</div>
					</div>

					<div class="card-header" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
						Do you provide support?
					</div>
					<div id="collapseFive" class="collapse" data-parent="#leftFaq">
						<div class="card-body">
						<p>Yes. We work extremely hard to provide great support for any issues that you have. So, in the unlikely event that you do run into any issues with Download Monitor - <a href="/contact">let us know!</a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="accordion" id="leftFaq">
					<div class="card-header" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
						I have pre-sale questions, can you help?
					</div>
					<div id="collapseTwo" class="collapse" data-parent="#leftFaq">
						<div class="card-body">
							Yes, of course! You are welcome to ask us any questions you may have <a href="/contact">here</a>.
						</div>
					</div>

					<div class="card-header" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
						Do I need to renew my license?
					</div>
					<div id="collapseFour" class="collapse" data-parent="#leftFaq">
						<div class="card-body">
							The license key is valid for one year from the purchase date. An active license key is needed for access to updates and support. To renew your license, please <a href="/my-account">log into your account</a>.<a target="_blank" href="https://wordpress.org/">WordPress.org</a> installation or a website hosted on <a href="https://wordpress.com/" target="_blank">WordPress.com</a>’s Business Plan.
						</div>
					</div>

					<div class="card-header" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
						What is your refund policy?
					</div>
					<div id="collapseSix" class="collapse" data-parent="#leftFaq">
						<div class="card-body">
						We have a 14-day refund policy</a> that’s awesome: if for any reason you’re unhappy, <a href="/contact-us">get in touch</a>.
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 text-center mt-lg-3">
                <a class="button button--xl" href="#pricing-table">Get Started Now with Download Monitor</a>
                <div><small class="cta_money_back_guarantee">14 day money back guarantee, love it or get a full refund.</small></div>
            </div>
		</div>
	</div>
</section>

<section class="testimonials">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3 testimonials-title">
				<h3>Why more than 100,000 users</h3>
				<h3>❤️</h3>
				<h3>Download Monitor</h3>
				<p>Don’t take our word for it, here’s what others have to say.</p>
			</div>
			<div class="col-md-4 mb-3">
				<div class="testimonial">
					<div class="testimonial__stars mb-3"></div>
					<div class="testimonial__content mb-3">
						<p class="mb-0">This plugin has done a great job for my client of tracking how assets are being used. I wish we had added it sooner to have download data to complement their Google Analytics!</p>
					</div>
					<div class="testimonial__author">
						<img width="150" height="150" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/lukas.png' ?>" class="testimonial__avatar mr-3" alt="" loading="lazy"> 
						<div class="testimonial__name">
							<h6 class="mb-0">Liesl Lukacs</h6>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="testimonial">
					<div class="testimonial__stars mb-3"></div>
					<div class="testimonial__content mb-3">
						<p class="mb-0">This is by far one of the best Download Manager plugins you can find on the WordPress repository. it has the most needed features with an intuitive, easy to use interface.
										If you want more options you can get some of the paid add-ons. I have been using it for a few days now in a heavy traffic site with no issues so far.</p>
					</div>
					<div class="testimonial__author">
						<img width="150" height="150" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/eli.jpeg' ?>" class="testimonial__avatar mr-3" alt="" loading="lazy" >                                
						<div class="testimonial__name">
							<h6 class="mb-0">Eli</h6>
							<p class="testimonial__title mb-0"></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="testimonial">
					<div class="testimonial__stars mb-3"></div>
					<div class="testimonial__content mb-3">
						<p class="mb-0">It did a great job, very easy, and a complete program for my needs, Thanks to the developer.</p>
					</div>
					<div class="testimonial__author">
						<img width="150" height="150" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/satiq.png' ?>" class="testimonial__avatar mr-3" alt="" loading="lazy">
						<div class="testimonial__name">
							<h6 class="mb-0">Satiq</h6>
							<p class="testimonial__title mb-0"></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="testimonial">
					<div class="testimonial__stars mb-3"></div>
					<div class="testimonial__content mb-3">
						<p class="mb-0">I have used this plugin over six years on one website. Download Monitor has come up trumps every time there has been a WordPress version change, theme update or plugin update on the website. Whenever, you wish to ask a question via support you get an immediate , helpful response. Good people to know.</p>
					</div>
					<div class="testimonial__author">
						<img width="150" height="150" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/wdb.jpeg' ?>" class="testimonial__avatar mr-3" alt="" loading="lazy"> 
						<div class="testimonial__name">
							<h6 class="mb-0">WBD</h6>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="testimonial">
					<div class="testimonial__stars mb-3"></div>
					<div class="testimonial__content mb-3">
						<p class="mb-0">This is a very clean plugin. I love the appearance. Compared to some other WordPress plugins that litter their admin sections with upsells and ugly CSS, this plugin is a pleasure to use.
										It’s also loaded with features — and you can add more if you need them. It really does more than I need. I already have a membership plugin to control access so I don’t need that part. But it does have templates so that I can control what my download links look like. Nice!
										Nice work!</p>
					</div>
					<div class="testimonial__author">
						<img width="150" height="150" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/lflier.jpeg' ?>" class="testimonial__avatar mr-3" alt="" loading="lazy"> 
						<div class="testimonial__name">
							<h6 class="mb-0">Lflier</h6>
							<p class="testimonial__title mb-0"></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="testimonial">
					<div class="testimonial__stars mb-3"></div>
					<div class="testimonial__content mb-3">
						<p class="mb-0">Clean and easy user interface, works as documented. Built on the standard WordPress technology for posts makes this clean and simple. Excellent and responsive support. Everything I expected from a high quality WordPress plugin.
										Using to migrate from a no longer supported download plugin and much happier.
										Thank you!</p>
					</div>
					<div class="testimonial__author">
						<img width="150" height="150" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/gabriel.png' ?>" class="testimonial__avatar mr-3" alt="" loading="lazy">
						<div class="testimonial__name">
							<h6 class="mb-0">Gabriel</h6>
							<p class="testimonial__title mb-0"></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 text-center mt-lg-3">
                <a class="button button--xl" href="#pricing-table">Get Started Now with Download Monitor</a>
                <div><small class="cta_money_back_guarantee">14 day money back guarantee, love it or get a full refund.</small></div>
            </div>
		</div>
	</div>
</section>

<section class="dlm-pricing-footer">
	<div class="footer container">
		<?php _e( "©2021 WP Chill. All rights reserved. A <a href='https://wpchill.com' target='_blank'>WP Chill</a> product", 'woocommerce' ); ?>
	</div>
</section>

<div class="col-full">
