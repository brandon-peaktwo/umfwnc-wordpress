<?php get_header(); ?>


<?php
	$tax_ID = get_queried_object()->term_id;
	$tax_name = get_queried_object()->name;
	$tax_description = get_queried_object()->description;
	$tax_bg = get_field("church_background_image", 'church' . '_' . $tax_ID);
?>

<section class="page_hero page_hero--image width--max pad--zero" style="background-image:url(<?php echo $tax_bg['url']; ?>);">
	<div class="hero_container">
		<div class="bg_dots parallax" style="transform: translate3d(0px, -4px, 0px);"></div>
		<div class="hero_content">
			<h1><?php echo $tax_name; ?></h1>
			<p><?php echo $tax_description; ?></p>
		</div>
	</div>
</section>



<section class="intro section--main width--max animated">
	<div id="give-to-a-fund-container">
		<div id="give-to-a-fund-loop" class="columns halfed">
			<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>

					<?php
						$fund_link = get_field("fund_link");
						$fund_image = get_field("fund_image");
					?>

					<div class="column col-4 col-md-6 col-sm-12 fund-block">
						<div>
							<div class="fund-t"></div>
							<?php if($fund_image) : ?>
								<div class="fund-t-image" style="background-image: url(<?= $fund_image['url']; ?>); "></div>
							<?php endif; ?>
						</div>
						<div>
							<p><strong><?php the_title(); ?></p></strong>
							<p><?php the_content(); ?></p>
							<p>
								<a href="<?php echo $fund_link['url']; ?>" target="_blank">
									<?php echo $fund_link['title']; ?>
								</a>
							</p>
						</div>
					</div>

				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</section>




<?php get_footer(); ?>
