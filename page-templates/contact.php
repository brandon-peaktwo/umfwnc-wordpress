<?php
  /**
  * Template Name: Contact
  */

  get_header();
  get_template_part( 'modules/module', 'page-hero' );
?>

<section class="contact-form width--thin margin--vertical" data-aos="fade-up" data-aos-delay="750" data-aos-anchor=".page_hero">
  <div class="contact_form">
	 <div class="form margin--bottom">
		<div class="bg_dots parallax"></div>
		<div class="form_wrapper">
			<?php if(is_page("share-your-story")) : ?>
				<?php gravity_form(4, false, false, false, '', true, 12); ?>
			<?php else : ?>
				<?php gravity_form(1, false, false, false, '', true, 12); ?>
			<?php endif; ?>
		</div>
	 </div>
  </div>

  <div class="contact_items">
	 <?php while(have_rows('contact_items') ): the_row(); ?>
		<?php
		  $content = get_sub_field('content');
		  $title = get_sub_field('headline');
		?>
		<div class="contact_item">
		  <h3 class="contact_item_title section_label color--text"><?=$title;?></h3>

		  <?php if($content): ?>
			 <p><?=$content;?></p>
		  <?php endif ;?>
		</div>
	 <?php endwhile; ?>
  </div>

</section>

<?php if(get_field('quote_show') == 'yes'): ?>
  <section class="quote width--max margin--bottom pad--bottom">
	 <?php
		set_query_var( 'section', 'contact_quote' );
		get_template_part( 'modules/module', 'quote' );
	 ?>
  </section>
<?php endif; ?>


<?php get_footer(); ?>
