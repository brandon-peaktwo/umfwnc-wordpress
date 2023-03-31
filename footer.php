<?php
  if(get_field('cta_display') == 'yes'):
	 $background_image = '/wp-content/themes/umfwnc/images/cta-background.jpg';
	 $cta_bg = get_field('cta_background');
	 if($cta_bg ):
		$background_image = $cta_bg;
	 endif;
?>

  <section class="cta pad--vertical width--max section--main">
	 <div class="cta_background" style="background-image:url(<?=$background_image?>);"></div>
	 <div class="cta_container width--thin color--white">
		<?php
		  set_query_var( 'section', 'cta' );
		  get_template_part( 'modules/module', 'section-header' );
		?>
	 </div>
  </section>
<?php endif; ?>

<footer class="global pad--zero">
  <div class="footer_content">
	 <div class="bg_dots"></div>
	 <p class="footer_title">United Methodist Foundation of Western North Carolina</p>

	 <p class="footer_address">13816 Professional Center Drive, Suite 100 Huntersville, NC 28078 | Phone: <a href="tel:17048173990">704-817-3990</a> | Fax: <span>980-422-0390</span></p>


	 <?php if(have_rows('social_icons', 'option')) : $loop_index = 0; ?>
		 <ul class="footer-social-icons">
			 <?php while(have_rows('social_icons', 'option')) : the_row(); ?>
				 <?php
					 $url = get_sub_field('url');
					 $icon = get_sub_field('icon');
				 ?>
					<li>
						<a href="<?php echo $url; ?>" target="_blank">
							<img src="<?php echo $icon['url']; ?>">
						</a>
					</li>
			 <?php $loop_index++; endwhile; ?>
		 </ul>
	 <?php endif; ?>



	 <div class="footer_copyright margin--top-small">© <?php echo date("Y"); ?> United Methodist Foundation of Western North Carolina, Inc. All rights reserved.</div>
  </div>
  <div id="footer_logo" href="/">
	 <?php
		$logo = get_field('logo', 'options');
		echo '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" />';
	 ?>
  </div>
</footer>

<?php wp_footer(); ?>

<script>
	// jQuery(document).ready(function($) {
		// if($("#resource-hero-slideshow").length) {
		// 	$("#resource-hero-slideshow").slick('unslick');
		// }
		//
		// setTimeout(function() {
		// 	if($("#resource-hero-slideshow").length) {
		// 		$("#resource-hero-slideshow").slick({
		// 			dots: true,
		// 			appendDots: $("#resource-hero-slideshow-nav .dots"),
		// 			arrows: true,
		// 			autoplay: true,
		// 			prevArrow: $("#resource-hero-slideshow-nav .prev"),
		// 			nextArrow: $("#resource-hero-slideshow-nav .next"),
		// 		});
		// 		$(".resource-archive-slideshow").css({
		// 			"opacity" : 1
		// 		})
		// 	}
		// }, 10);
	// });
</script>

</body>
</html>
