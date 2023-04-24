<?php get_header(); ?>


	<?php if(have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="resource-content">

		<div class="resource-share">
			<ul>
				<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank"><svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path></svg></a></li>
				<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/></svg></a></li>
				<li><a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>&text=<?php the_title(); ?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.066 9.645c.183 4.04-2.83 8.544-8.164 8.544-1.622 0-3.131-.476-4.402-1.291 1.524.18 3.045-.244 4.252-1.189-1.256-.023-2.317-.854-2.684-1.995.451.086.895.061 1.298-.049-1.381-.278-2.335-1.522-2.304-2.853.388.215.83.344 1.301.359-1.279-.855-1.641-2.544-.889-3.835 1.416 1.738 3.533 2.881 5.92 3.001-.419-1.796.944-3.527 2.799-3.527.825 0 1.572.349 2.096.907.654-.128 1.27-.368 1.824-.697-.215.671-.67 1.233-1.263 1.589.581-.07 1.135-.224 1.649-.453-.384.578-.87 1.084-1.433 1.489z"/></svg></a></li>
			</ul>
		</div>


		<?php
			// HERO IMAGE
			$hero_has_video = get_field("hero_has_video");
			$hero_video_link = get_field("hero_video_link");
			$resource_hero_image = get_field("resource_hero_image");
		?>
			<section class="container-sm flex-hero">
				<div class="relative">

					<div class="bg" style="background-image: url(<?php echo $resource_hero_image['url']; ?>);">
						<img src="<?php echo $resource_hero_image['url']; ?>">
					</div>
					<?php if($hero_has_video) : ?>
						<div class="click-play-video modal-open" data-id="1">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 22v-20l18 10-18 10z"/></svg>
						</div>
					<?php endif; ?>
				<div>
			</section>

			<section class="container-sm">
				<div class="relative">

					<?php
						// $args = array(
						// 	'taxonomy' => 'resource_categories',
						// 	'limit' => 1
						// );
						// $cats = get_categories($args);

						$args = array(
							'taxonomy' => 'resource_categories',
							'limit' => 1
						);
						$terms = get_the_terms(get_the_id(), "resource_categories");
					?>

					<label class="section_label"><?php echo $terms[0]->name; ?></label>
					<h1><?php the_title(); ?></h1>
				<div>
			</section>














		<?php if(have_rows('resource_content')) : ?>
			<?php while(have_rows('resource_content')) : the_row(); ?>


				<?php
				// WYSIWYG FLEXIBLE CONTENT
				if(get_row_layout() == 'flex_wysiwyg') :
					$wysiwyg = get_sub_field('wysiwyg');
				?>
					<section class="container-sm flex-wysiwyg">
						<?php echo $wysiwyg; ?>
					</section>

				<?php
				// QUOTE FLEXIBLE CONTENT
				elseif(get_row_layout() == 'flex_quote') :
					$quote = get_sub_field('quote');
					$author = get_sub_field('author');
				?>
				<section class="quote width--max margin--vertical">
					<div class="quote_box section--main animated">
						<div class="bg_dots parallax" style="transform: translate3d(0px, 3px, 0px);"></div>
						<div class="quotation">“</div>
						<p class=""><?php echo $quote; ?></p>
						<?php if($author) : ?>
							<span class="quote_name">- <?php echo $author; ?></span>
						<?php endif; ?>
					</div>
				</section>



				<?php
				// IMAGE FLEXIBLE CONTENT
				elseif(get_row_layout() == 'flex_image') :
					$image = get_sub_field('image');
					$source = get_sub_field('source');

				?>
					<section class="container-sm flex-img">
						<div class="relative">
							<img src="<?php echo $image['url']; ?>">
							<?php if($source) : ?>
								<span><?php echo $source; ?></span>
							<?php endif; ?>
					</section>

				<?php
				// NEWSLETTER FLEXIBLE CONTENT
				elseif(get_row_layout() == 'flex_newsletter') :
					$show_newsletter = get_sub_field('show_newsletter');
					$newsletter_bg = get_field("newsletter_bg_image", "option");
					$newsletter_form = get_field("newsletter_form", "option");
					$newsletter_subhead = "NEWSLETTER";
					$newsletter_headline = get_field("newsletter_headline", "option");

					if($show_newsletter) :
				?>
						<section class="cta width--max section--main animated newsletter-container single">
							<div class="cta_background" style="background-image:url(<?php echo $newsletter_bg['url']; ?>);"></div>
							<div class="cta_container width--thin color--white">
								<header class="section-header">
									<p><?php echo $newsletter_subhead; ?></p>
									<h2><?php echo $newsletter_headline; ?></h2>
									<?php gravity_form($newsletter_form, false, false, false, '', true, 12); ?>
								</header>
							</div>
						</section>
					<?php endif; ?>


				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>











		<section class="container-sm text-center resources-recent">
			<label class="section_label">RECENT RESOURCES</label>
			<h2>Stories you may be interested in</h2>
		</section>


		<?php
			$args = array(
				'post_type' => "resources",
				'post_status' => 'publish',
				'posts_per_page' => 3,
				'paged' => $paged,
				'post__not_in' => array( $post->ID )
			);
			$loop = new WP_Query($args);

			if($loop->have_posts()) :
		?>
				<section class="resources-archive centered">
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
									<label class="section_label"><?php echo $terms[0]->name; ?></label>
									<p class="mb-0"><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></p>
									<p><?php echo $preview_description; ?></p>
								</div>
								<a href="<?php the_permalink(); ?>" class="link">
									<?php echo $preview_link_text; ?> >
								</a>
							</div>
						</div>

					<?php endwhile; ?>

				</section>
			<?php endif; ?>
		<?php wp_reset_postdata(); ?>


	</div>




	<?php if($hero_has_video) : ?>
		<div class="modal content-modal resource-video" data-id="1">
			<div class="flex">
				<div class="container">
				<a class="modal-close" id="modal1">close</a>

					<div class="responsive-video">
						<iframe width="560" height="315" src="<?php echo $hero_video_link; ?>" frameborder="0" allowfullscreen></iframe>
					</div>

				</div>
			</div>
		</div>
	<?php endif; ?>






	<?php endwhile; endif; ?>


<?php get_footer(); ?>
