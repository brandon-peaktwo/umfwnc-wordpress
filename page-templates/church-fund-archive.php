<?php
	/**
	* Template Name: Church Fund Archive
	*/
	get_header();

	$terms = get_terms(
		array(
			'taxonomy' => 'church',
			'hide_empty' => false,
		)
	);
?>


	<section class="intro section--main width--max animated">

		<div id="give-to-a-fund-container">

			<h2><?php the_title(); ?></h2>


			<?php if(!empty($terms) && is_array($terms)) : ?>
				<div id="give-to-a-fund-search" class="columns">

					<div class="custom-select church-fund">
						<select id="fund-category-select" class="church-fund-select">
								<option value="">
									Fund Type
								</option>
								<option value="all">
									Show All
								</option>
								<?php foreach($terms as $term) : ?>
									<?php echo $term->parent; ?>
									<?php
									if($term->parent == 0) :
									$parent = get_term($term->parent);
									?>

										<?php echo $term->term_id; ?>
										<option value="<?php echo $term->term_id; ?>">
											<?php echo $term->name; ?>
										</option>
									<?php endif; ?>

								<?php endforeach; ?>
						</select>

						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 22h-24l12-20z"/></svg>
					</div>
				</div>
			<?php endif; ?>






			<?php if(!empty($terms) && is_array($terms)) : ?>

				<div id="give-to-a-fund-loop" class="columns">
					<?php foreach($terms as $term) : ?>
						<?php
						if($term->parent != 0) :
						$parent = get_term($term->parent);
						?>
							<div class="column col-4 col-md-6 col-sm-12 fund-block">
								<div class="fund-t"></div>
								<label class="section_label">
									<?php echo $parent->name; ?>
								</label>
								<a href="<?php echo esc_url(get_term_link($term)) ?>" class="black-link">
									<p><strong><?php echo $term->name; ?></p></strong>
								</a>
								<p><?php echo $term->description; ?></p>
								<p>
									<a href="<?php echo esc_url(get_term_link($term)) ?>">
										Learn more
									</a>
								</p>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div>

	</section>


<?php get_footer(); ?>
