<?php
	/**
	* Template Name: Give To a Fund
	*/
	get_header();
?>

<?php
$funds_count = wp_count_posts($post_type = 'funds')->publish;
$funds_per_page = 12;

$funds = new WP_Query(array(
	'post_type' => 'funds',
	'posts_per_page' => $funds_per_page,
	'orderby' => 'title',
	'order' => 'asc',
));

$fund_types = get_terms([
	'taxonomy' => 'fund_types',
	'hide_empty' => false,
]);
?>


<section class="intro section--main width--max animated">

	<div id="give-to-a-fund-container">


		<h2><?php the_title(); ?></h2>

		<div id="give-to-a-fund-search" class="columns">
			<div>
				<div class="reset-button">reset [x]</div>
				<input type="text" placeholder="SEARCH">
				<div class="glass"><svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z"/></svg></div>
			</div>
			<!-- <div class="custom-select">
				<select id="fund-category-select">
						<option value="">
							CATEGORY
						</option>
					<?php foreach ($fund_types as $fund_type) : ?>
						<option value="<?php echo $fund_type->term_id; ?>">
							<?php echo $fund_type->name; ?>
						</option>
					<?php endforeach; ?>
				</select>
				<svg class="select-arrow" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M4 .755l14.374 11.245-14.374 11.219.619.781 15.381-12-15.391-12-.609.755z"/></svg>
			</div> -->
		</div>

		<div id="give-to-a-fund-loop" class="columns">
			<?php while($funds->have_posts()) : $funds->the_post(); ?>

				<?php
					// $fund_title = get_field("fund_title");
					// $fund_description = get_field("fund_description");
					$fund_link = get_field("fund_link");
					$categories = get_the_terms(get_the_ID(), 'fund_types');

					if(!isset($categories[0])) {
						$category_name = "&nbsp;";
					}
					else {
						$category_name = $categories[0]->name;
					}
				?>

				<div class="column col-4 col-md-6 col-sm-12 fund-block">
					<div class="fund-t"></div>
					<h6><?php echo $category_name; ?></h6>
					<p><strong><?php the_title(); ?></p></strong>
					<p><?php the_content(); ?></p>
					<p>
						<a href="<?php echo $fund_link['url']; ?>" target="_blank">
							<?php echo $fund_link['title']; ?>
						</a>
					</p>
				</div>

			<?php endwhile; ?>
		</div>

		<?php if($funds_count > $funds_per_page) : ?>
			<div
				class="fund-load-more"
				per-page="<?php echo $funds_per_page; ?>"
				current=2
				data-max="<?php echo $funds_count; ?>"
			>
				<button>Load More</button>
			</div>
		<?php endif; ?>

	</div>

</section>




<?php get_footer(); ?>
