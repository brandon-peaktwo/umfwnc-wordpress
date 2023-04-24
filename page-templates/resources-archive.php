<?php
	/**
	* Template Name: Resources Archive
	*/
	get_header();
?>


	<?php if(have_posts()) : while (have_posts()) : the_post(); ?>

		<?php
			$resource_total_count = wp_count_posts($post_type = 'resources')->publish;
			$resources_per_page = 12;
		?>


		<!-- <div class="resource-archive-slideshow-head">
			<h1><?php echo get_the_title(); ?></h1>
		</div> -->


		<?php
			$slideshow_background = get_field("slideshow_background_image");
		?>
			<section class="image-content resource-archive-slideshow right-fix">
				<div class="section_container">

					<div id="resource-slideshow-background" class="section_background" data-aos="fade-left" data-aos-delay="0" data-aos-anchor=".image-content">

							<?php if(have_rows('slideshow')) : ?>
									<?php while(have_rows('slideshow')) : the_row(); ?>

									<?php
										$post_object = get_sub_field('resource');
										if($post_object) :
											$post = $post_object;
											setup_postdata($post);
											$preview_image = get_field("preview_image");
									?>

											<div class="background-changer" style="background-image:url(<?php echo $preview_image['url']; ?>);"></div>
									<?php wp_reset_postdata(); ?>
								<?php endif; ?>
							<?php endwhile; ?>
						<?php endif; ?>

					</div>

					<div class="section_content" data-aos="fade-right" data-aos-delay="250" data-aos-anchor=".image-content">
						<div class="bg_dots parallax"></div>
						<div class="section_content-wrapper resource-hero-slideshow-container">

							<?php if(have_rows('slideshow')) : ?>
								<div id="resource-hero-slideshow">
									<?php while(have_rows('slideshow')) : the_row(); ?>

									<?php
										$post_object = get_sub_field('resource');
										$description = get_sub_field('description');
										if($post_object) :
											$post = $post_object;
											setup_postdata($post);

											$categories = get_the_terms($post->ID, "resource_categories");
											$preview_image = get_field("preview_image");
									?>

												<div class="resource-hero-slide" data-bg="<?php echo $preview_image['url']; ?>">
													<div class="fund-t"></div>
													<div>
														<label class="section_label">
															<?php if(!empty($categories)) { echo $categories[0]->name; } ?>
														</label>
														<a href="<?php the_permalink(); ?>" class="mt0"><h2><?php the_title(); ?></h2></a>
														<p><?php echo $description; ?></p>
													</div>
													<a href="<?php the_permalink(); ?>" class="link">
														<?php echo get_field("preview_link_text"); ?> >
													</a>
												</div>

											<?php wp_reset_postdata(); ?>
										<?php endif; ?>
									<?php endwhile; ?>
								</div>
								<div id="resource-hero-slideshow-nav">
									<div class="prev"><</div>
									<div class="dots"></div>
									<div class="next">></div>
								</div>
							<?php endif; ?>

						</div>
					</div>
				</div>
			</section>





		<main class="">

			<?php
			$types = get_terms([
				'taxonomy' => 'resource_categories',
				'hide_empty' => false,
			]);
			?>
				<div id="give-to-a-fund-container">
					<div id="give-to-a-fund-search" class="columns">
						<div>
							<div class="reset-button reset-resources">reset [x]</div>
							<input type="text" placeholder="SEARCH" class="resource-search">
							<div class="glass"><svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z"/></svg></div>
						</div>
						<div class="custom-select">
							<select id="fund-category-select" class="resource-select">
									<option value="">
										CATEGORY
									</option>
								<?php foreach ($types as $type) : ?>
									<option value="<?php echo $type->term_id; ?>">
										<?php echo $type->name; ?>
									</option>
								<?php endforeach; ?>
							</select>
							<svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M4 .755l14.374 11.245-14.374 11.219.619.781 15.381-12-15.391-12-.609.755z"/></svg>
						</div>
					</div>
				</div>







			<?php
				// LOOP OF RESOURCES
				$args = array(
					'post_type' => "resources",
					'post_status' => 'publish',
					'posts_per_page' => 12,
					'paged' => $paged
				);
				$loop = new WP_Query($args);

				if($loop->have_posts()) :
					$resource_count = 0;
			?>
				<section class="resources-archive right-fix">
					<?php while($loop->have_posts()) : $loop->the_post(); ?>

						<?php
							$preview_description = get_field("preview_description");
							$preview_link_text = get_field("preview_link_text");
							$preview_image = get_field("preview_image");

							$args = array(
								'taxonomy' => 'resource_categories',
								'limit' => 1
							);
							$terms = get_the_terms(get_the_id(), "resource_categories");
						?>

						<div class="resource-entry">
							<div class="bg-image" style="background-image: url(<?php echo $preview_image['url']; ?>);"></div>
							<div class="inner-content">
								<div>
									<label class="section_label">
										<?php if($terms) : ?>
											<?php
												foreach($terms as $term) :
													echo $term->name;
												endforeach;
											?>
										<?php endif; ?>
									</label>
									<p><strong><a href="<?php the_permalink(); ?>" style="text-transform: capitalize;">
										<?php the_title(); ?>
									</a></strong></p>
									<p><?php echo $preview_description; ?></p>
								</div>
								<div>
									<a href="<?php the_permalink(); ?>" class="link">
										<?php echo $preview_link_text; ?> >
									</a>
								</div>
							</div>
						</div>

						<?php $test = true; ?>
						<?php if($resource_count == 5 && $resource_total_count >= 6 && $test) : ?>
							<?php
								// NEWSLTTER SIGN UP AFTER 6TH ENTRY
								$newsletter_bg = get_field("newsletter_bg_image", "option");
								$newsletter_subhead = "Newsletter Sign Up";
								$newsletter_form = get_field("newsletter_form", "option");
								$newsletter_headline = get_field("newsletter_headline", "option");
							?>
								<section class="cta width--max section--main animated newsletter-container">
									<div class="cta_background" style="background-image:url(<?php echo $newsletter_bg['url']; ?>);"></div>
									<div class="cta_container width--thin color--white">
										<header class="section-header">
											<p><?php echo $newsletter_subhead; ?></p>
											<h2><?php echo $newsletter_headline; ?></h2>
											<?php gravity_form($newsletter_form, false, false, false, '', true, 12); ?>
										</header>
									</div>
								</section>
								<div></div>
								<div></div>
						<?php endif; ?>



						<?php $resource_count++; ?>
					<?php endwhile; ?>

				</section>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>




			<?php
				// LOAD MORE BUTTON
				if($resource_total_count > $resources_per_page) :
			?>
				<div
					class="fund-load-more resource-load-more"
					per-page="<?php echo $resources_per_page; ?>"
					current=2
					data-max="<?php echo $resource_total_count; ?>"
				>
					<button>Load More</button>
				</div>
			<?php endif; ?>





			<?php
				// BOTTOM CTA
				$cta_bg = get_field("cta_bg");
				$cta_subhead = get_field("cta_subhead");
				$cta_headline = get_field("cta_headline");
				$cta_link = get_field("cta_link");
			?>
				<section class="cta pad--vertical width--max section--main animated">
					<div class="cta_background" style="background-image:url(<?php echo $cta_bg['url']; ?>);"></div>
					<div class="cta_container width--thin color--white">
						<header class="section-header">
							<div class="fund-t"></div>
							<span><?php echo $cta_subhead; ?></span>
							<h2><?php echo $cta_headline; ?></h2>
							<a href="<?php echo $cta_link['url']; ?>" class="link" target="">
								<?php echo $cta_link['title']; ?>
							</a>
						</header>
					</div>
				</section>


		</main>


	<?php endwhile; endif; ?>


<?php get_footer(); ?>
